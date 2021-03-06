<?php

/**
 * BaseInvitation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property int                                       $id                                             Type: integer(4), primary key
 * @property string                                    $email_address                                  Type: string(80), unique
 * @property string                                    $validation_code                                Type: string(40)
 * @property int                                       $register_user_id                               Type: integer(4)
 * @property string                                    $expires_at                                     Type: timestamp, Timestamp in ISO-8601 format (YYYY-MM-DD HH:MI:SS)
 * @property sfGuardUser                               $RegisterUser                                   
 * @property Doctrine_Collection|InvitationCampaign[]  $InvitationCampaign                             
 *  
 * @method int                                         getId()                                         Type: integer(4), primary key
 * @method string                                      getEmailAddress()                               Type: string(80), unique
 * @method string                                      getValidationCode()                             Type: string(40)
 * @method int                                         getRegisterUserId()                             Type: integer(4)
 * @method string                                      getExpiresAt()                                  Type: timestamp, Timestamp in ISO-8601 format (YYYY-MM-DD HH:MI:SS)
 * @method sfGuardUser                                 getRegisterUser()                               
 * @method Doctrine_Collection|InvitationCampaign[]    getInvitationCampaign()                         
 *  
 * @method Invitation                                  setId(int $val)                                 Type: integer(4), primary key
 * @method Invitation                                  setEmailAddress(string $val)                    Type: string(80), unique
 * @method Invitation                                  setValidationCode(string $val)                  Type: string(40)
 * @method Invitation                                  setRegisterUserId(int $val)                     Type: integer(4)
 * @method Invitation                                  setExpiresAt(string $val)                       Type: timestamp, Timestamp in ISO-8601 format (YYYY-MM-DD HH:MI:SS)
 * @method Invitation                                  setRegisterUser(sfGuardUser $val)               
 * @method Invitation                                  setInvitationCampaign(Doctrine_Collection $val) 
 *  
 * @package    policat
 * @subpackage model
 * @author     Martin
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseInvitation extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('invitation');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('email_address', 'string', 80, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 80,
             ));
        $this->hasColumn('validation_code', 'string', 40, array(
             'type' => 'string',
             'length' => 40,
             ));
        $this->hasColumn('register_user_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => false,
             'length' => 4,
             ));
        $this->hasColumn('expires_at', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as RegisterUser', array(
             'local' => 'register_user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('InvitationCampaign', array(
             'local' => 'id',
             'foreign' => 'invitation_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}