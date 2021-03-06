<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version239 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->removeIndex('petition_signing', 'signing_mailexport', array(
             'fields' => 
             array(
              0 => 'petition_id',
              1 => 'mailexport_pending',
             ),
             ));
        $this->addIndex('petition_signing', 'signing_mailexport2', array(
             'fields' => 
             array(
              0 => 'petition_id',
              1 => 'mailexport_pending',
              2 => 'subscribe',
              3 => 'widget_id',
             ),
             ));
    }

    public function down()
    {
        $this->addIndex('petition_signing', 'signing_mailexport', array(
             'fields' => 
             array(
              0 => 'petition_id',
              1 => 'mailexport_pending',
             ),
             ));
        $this->removeIndex('petition_signing', 'signing_mailexport2', array(
             'fields' => 
             array(
              0 => 'petition_id',
              1 => 'mailexport_pending',
              2 => 'subscribe',
              3 => 'widget_id',
             ),
             ));
    }
}