<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version116 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('petition', 'label_mode', 'integer', '1', array(
             'notnull' => '1',
             'default' => '1',
             ));
    }

    public function down()
    {
        $this->removeColumn('petition', 'label_mode');
    }
}