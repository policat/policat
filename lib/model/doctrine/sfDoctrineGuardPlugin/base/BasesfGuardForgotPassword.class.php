<?php

/**
 * BasesfGuardForgotPassword
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property int                    $user_id                  Type: integer(4)
 * @property string                 $unique_key               Type: string(255)
 * @property string                 $expires_at               Type: timestamp, Timestamp in ISO-8601 format (YYYY-MM-DD HH:MI:SS)
 * @property sfGuardUser            $User                     
 *  
 * @method int                      getUserId()               Type: integer(4)
 * @method string                   getUniqueKey()            Type: string(255)
 * @method string                   getExpiresAt()            Type: timestamp, Timestamp in ISO-8601 format (YYYY-MM-DD HH:MI:SS)
 * @method sfGuardUser              getUser()                 
 *  
 * @method sfGuardForgotPassword    setUserId(int $val)       Type: integer(4)
 * @method sfGuardForgotPassword    setUniqueKey(string $val) Type: string(255)
 * @method sfGuardForgotPassword    setExpiresAt(string $val) Type: timestamp, Timestamp in ISO-8601 format (YYYY-MM-DD HH:MI:SS)
 * @method sfGuardForgotPassword    setUser(sfGuardUser $val) 
 *  
 * @package    policat
 * @subpackage model
 * @author     Martin
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasesfGuardForgotPassword extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_guard_forgot_password');
        $this->hasColumn('user_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('unique_key', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('expires_at', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
        $this->option('options', NULL);
        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_general_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}