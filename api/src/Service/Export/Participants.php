<?php

namespace App\Service\Export;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;

class Participants
{
  private $entityManager;
  private $exportSubscriptions = false;

  const PAGE_SIZE = 1000;

  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->entityManager = $entityManager;
  }

  public function generateFileName($type, $identifier)
  {
    $date = (new \DateTime())->format('Y-m-d_His');

    return "{$type}_{$identifier}_{$date}.csv";
  }

  public function exportCampaign($campaignId): \Generator
  {
    return $this->fetchData('campaign', $campaignId);
  }

  public function exportPetition($petitionId): \Generator
  {
    /**
     * TODO:
     * - validate user (add token)
     * - find correct export fields
     * -
     */
    return $this->fetchData('petition', $petitionId);
  }

  public function exportWidget($widgetId)
  {
    return $this->fetchData('widget', $widgetId);
  }

  /**
   * @return mixed
   */
  public function getExportSubscriptions(): bool
  {
    return $this->exportSubscriptions;
  }

  /**
   * @param mixed $exportSubscriptions
   */
  public function setExportSubscriptions(bool $exportSubscriptions): void
  {
    $this->exportSubscriptions = $exportSubscriptions;
  }

  private function fetchData($type, $identifier): \Generator
  {

    $resultSetMapping = new ResultSetMapping();
    foreach ($this->getFields($type) as $field) {
      $resultSetMapping->addScalarResult($field, $field);
    }

    $sql = $this->getSqlforType($type);

    // write header
    yield array_keys($this->getFields($type));

    $offset = 0;
    do {
      $query = $this->entityManager
        ->createNativeQuery($sql, $resultSetMapping)
        ->setParameter('identifier', $identifier)
        ->setParameter('limit', self::PAGE_SIZE)
        ->setParameter('offset', $offset);
      $result = $query->getArrayResult();
      foreach ($result as $item) {
        yield $this->mapResult($item);
      }
      $offset += self::PAGE_SIZE;

    } while (count($result) > 0);
  }

  private function getSqlforType($type)
  {
    $selectFields = join(',', $this->getFields($type));

    $whereSubscriptions = $this->getExportSubscriptions() ? ' AND subscribe=1 AND verified=1': '';

    switch ($type) {
      case 'campaign':
        return "SELECT $selectFields FROM petition_signing WHERE campaign_id = :identifier {$whereSubscriptions} ORDER BY id ASC LIMIT :limit OFFSET :offset";
      case 'petition':
        return "SELECT $selectFields FROM petition_signing WHERE petition_id = :identifier {$whereSubscriptions} ORDER BY id ASC LIMIT :limit OFFSET :offset";
      case 'widget':
        return "SELECT $selectFields FROM petition_signing WHERE widget_id = :identifier {$whereSubscriptions} ORDER BY id ASC LIMIT :limit OFFSET :offset";
    }

    return '';
  }

  private function mapResult($row): array
  {
    $status = [
      1 => 'pending',
      2 => 'counted',
      3 => 'blocked',
      4 => 'duplicate',
    ];
    $row['status'] = $status[$row['status']] ?? '';

    return $row;
  }

  private function getFields(string $type): array
  {
    $allExportFields = [
      'action_id' => 'petition_id',
      'widget_id' => 'widget_id',
      'created_at' => 'created_at',
      'updated_at' => 'updated_at',
      'status' => 'status',
      'verified' => 'verified',
      'title' => 'title',
      'fullname' => 'fullname',
      'firstname' => 'firstname',
      'lastname' => 'lastname',
      'email' => 'email',
      'email_hash' => 'email_hash',
      'address' => 'address',
      'city' => 'city',
      'post_code' => 'post_code',
      'country' => 'country',
      'extra1' => 'extra1',
      'extra2' => 'extra2',
      'extra3' => 'extra3',
      'comment' => 'comment',
      'subscribe' => 'subscribe',
      'thank you page shown' => 'ref_shown',
      'ref' => 'ref',
    ];

    if ($type !== 'campaign') {
      unset ($allExportFields['action_id']);
    }
    if ($this->getExportSubscriptions()) {
      unset ($allExportFields['subscribe']);
    } else {
      unset($allExportFields['email']);
      unset($allExportFields['address']);
    }

    return $allExportFields;
  }
}