<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version243 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('petition_text', 'privacy_policy_url', 'string', '', array(
             ));
    }

    public function down()
    {
        $this->removeColumn('petition_text', 'privacy_policy_url');
    }
}