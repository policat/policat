<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version252 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('petition', 'openeci_skip_first_step', 'integer', '1', array(
             'notnull' => '1',
             'default' => '0',
             ));
    }

    public function down()
    {
        $this->removeColumn('petition', 'openeci_skip_first_step');
    }
}