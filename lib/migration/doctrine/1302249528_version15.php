<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version15 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('petition_signing', 'wave_sent', 'integer', '2', array(
             'notnull' => '1',
             'default' => '0',
             ));
        $this->addColumn('petition_signing', 'wave_pending', 'integer', '2', array(
             'notnull' => '1',
             'default' => '0',
             ));
        $this->addColumn('petition_signing_contact', 'wave', 'integer', '2', array(
             'notnull' => '1',
             'default' => '1',
             ));
    }

    public function down()
    {
        $this->removeColumn('petition_signing', 'wave_sent');
        $this->removeColumn('petition_signing', 'wave_pending');
        $this->removeColumn('petition_signing_contact', 'wave');
    }
}