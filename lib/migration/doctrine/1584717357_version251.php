<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version251 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('petition', 'list_emails_sent', 'integer', '4', array(
             'notnull' => '1',
             'default' => '0',
             ));
    }

    public function down()
    {
        $this->removeColumn('petition', 'list_emails_sent');
    }
}