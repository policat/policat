<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version251 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('widget', 'show_counter', 'string', '15', array(
             'notnull' => '1',
             'default' => 'signup',
             ));
    }

    public function down()
    {
        $this->removeColumn('widget', 'show_counter');
    }
}