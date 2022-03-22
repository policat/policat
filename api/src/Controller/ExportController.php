<?php

namespace App\Controller;

use App\Service\Export\Participants;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ExportController extends AbstractController
{
  /**
   * @Route("/api/v3/campaign/{campaign}/participants/export")
   */
  public function exportCampaign(Request $request, int $campaign, Participants $participantExportService): StreamedResponse
  {
    $this->validateRequest($request, 'campaign', $campaign);
    $participantExportService->setExportSubscriptions((bool) $request->query->get('s'));
    $participants = $participantExportService->exportCampaign($campaign);

    $response = $this->buildStreamedResponse(
      $participants,
      $participantExportService->generateFileName('campaign', $campaign)
    );

    return $response;
  }

  /**
   * @Route("/api/v3/petition/{petition}/participants/export")
   */
  public function exportPetition(Request $request, int $petition, Participants $participantExportService): StreamedResponse
  {
    $this->validateRequest($request, 'petition', $petition);
    $participantExportService->setExportSubscriptions((bool) $request->query->get('s'));
    $participants = $participantExportService->exportPetition($petition);

    $response = $this->buildStreamedResponse($participants, $participantExportService->generateFileName('petition', $petition));

    return $response;
  }

  /**
   * @Route("/api/v3/widget/{widget}/participants/export")
   */
  public function exportWidget(Request $request, int $widget, Participants $participantExportService): StreamedResponse
  {
    $this->validateRequest($request, 'widget', $widget);
    $participantExportService->setExportSubscriptions((bool) $request->query->get('s'));
    $participants = $participantExportService->exportWidget($widget);

    $response = $this->buildStreamedResponse($participants, $participantExportService->generateFileName('widget', $widget));

    return $response;
  }

  private function validateRequest(Request $request, $type, $identifier)
  {
    $token = $request->query->get('token');
    $decodedToken = (array) JWT::decode($token, new Key($this->getParameter('jwtSecretKey'), 'HS256'));
    if ($decodedToken['iat'] < (new \DateTime('now - 5 minutes'))->getTimestamp()) {
      throw $this->createAccessDeniedException('The token has expired');
    }
    $audience = explode(' ', $decodedToken['aud']);
    $downloadIdentifier = $audience[0];
    $subscriptions = json_decode($audience[1], true);
    if ($downloadIdentifier !== "/$type/$identifier/") {
      throw $this->createAccessDeniedException('invalid identifier');
    }
    if ((bool) $request->query->get('s') !== $subscriptions['subscriptions'] ) {
      throw $this->createAccessDeniedException('invalid url');
    }
  }

  private function buildStreamedResponse(\Generator $participants, string $filename): StreamedResponse
  {
    $response = new StreamedResponse(
      function () use ($participants) {
        $fp = fopen('php://output', 'wb+');
        foreach ($participants as $participant) {
          fputcsv($fp, $participant);
        }
        fclose($fp);
      },
      200,
      [
        'Content-Type' => 'text/csv',
        'X-Accel-Buffering' => 'no',
      ]
    );
    $response->headers->set(
      'Content-Disposition',
      $response->headers->makeDisposition(
        ResponseHeaderBag::DISPOSITION_ATTACHMENT,
        $filename
      )
    );

    return $response;
  }
}