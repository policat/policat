<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version175 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('petition_text', 'signers_url', 'string', '200', array(
             'notnull' => '',
             ));
    }

    public function down()
    {
        $this->removeColumn('petition_text', 'signers_url');
    }
}