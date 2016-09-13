<?php

/**
 * MediaFileTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class MediaFileTable extends Doctrine_Table {

  /**
   * Returns an instance of this class.
   *
   * @return MediaFileTable The table instance
   */
  public static function getInstance() {
    return Doctrine_Core::getTable('MediaFile');
  }

  /**
   *
   * @return Doctrine_Query
   */
  public function queryAll() {
    return $this->createQuery('m')->orderBy('m.id ASC');
  }

  /**
   *
   * @param int $petitionId
   * @return Doctrine_Query
   */
  public function queryByPetitionId($petitionId) {
    return $this->queryAll()->where('m.petition_id = ?', $petitionId);
  }

  public function dataMarkupSet(Petition $petition) {
    $files = $this->createQuery()
      ->where('petition_id = ?', $petition->getId())
      ->orderBy('title asc')
      ->execute();

    $menu = array();
    foreach ($files as $file) { /* @var $file MediaFile */
      $menu[] = array(
          'name' => $file->getTitle(),
          'openWith' => '![',
          'placeHolder' => '',
          'closeWith' => '](/media/' . $petition->getId() . '/' . $file->getTitle() . ')'
      );
    }

    return json_encode(array(
        array('name' => 'Images', 'className' => 'policat-media', 'dropMenu' => $menu
        )
    ));
  }

  public function substInternalToExternal(Petition $petition, $subst = array()) {
    $files = $this->createQuery()
      ->where('petition_id = ?', $petition->getId())
      ->execute();

    $home = rtrim(sfContext::getInstance()->getRouting()->generate('homepage', array(), true), '/');

    foreach ($files as $file) { /* @var $file MediaFile */
      $subst['/media/' . $petition->getId() . '/' . $file->getTitle()] = $home . $file->getUrl();
    }

    return $subst;
  }

}
