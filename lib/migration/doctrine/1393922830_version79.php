<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version79 extends Doctrine_Migration_Base {

  public function up() {
    $this->addColumn('petition_signing_wave', 'contact_num', 'integer', '4', array(
        'notnull' => '1',
        'default' => '0',
    ));
    $this->changeColumn('petition_signing_search', 'keyword', 'string', '48', array(
        'primary' => '1',
    ));
  }

  public function down() {
    $this->removeColumn('petition_signing_wave', 'contact_num');
  }

  public function postUp() {
    parent::postUp();

    $q = Doctrine_Manager::getInstance()->getCurrentConnection();
    $q->exec('UPDATE LOW_PRIORITY petition_signing_wave psw SET psw.contact_num = (SELECT count(*) FROM petition_signing_contact psc where psc.petition_signing_id = psw.petition_signing_id and psc.wave = psw.wave)');
  }

}