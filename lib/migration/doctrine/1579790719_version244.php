<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version244 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('widget', 'privacy_policy_url', 'string', '', array(
             ));
    }

    public function down()
    {
        $this->removeColumn('widget', 'privacy_policy_url');
    }
}