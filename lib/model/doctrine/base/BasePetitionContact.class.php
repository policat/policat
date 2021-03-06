<?php

/**
 * BasePetitionContact
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property int              $petition_id                       Type: integer(4), primary key
 * @property int              $contact_id                        Type: integer(4), primary key
 * @property string           $secret                            Type: string(40)
 * @property string           $password                          Type: string(255)
 * @property string           $password_reset                    Type: string(255)
 * @property string           $password_reset_until              Type: date, Date in ISO-8601 format (YYYY-MM-DD)
 * @property string           $comment                           Type: clob
 * @property Petition         $Petition                          
 * @property Contact          $Contact                           
 *  
 * @method int                getPetitionId()                    Type: integer(4), primary key
 * @method int                getContactId()                     Type: integer(4), primary key
 * @method string             getSecret()                        Type: string(40)
 * @method string             getPassword()                      Type: string(255)
 * @method string             getPasswordReset()                 Type: string(255)
 * @method string             getPasswordResetUntil()            Type: date, Date in ISO-8601 format (YYYY-MM-DD)
 * @method string             getComment()                       Type: clob
 * @method Petition           getPetition()                      
 * @method Contact            getContact()                       
 *  
 * @method PetitionContact    setPetitionId(int $val)            Type: integer(4), primary key
 * @method PetitionContact    setContactId(int $val)             Type: integer(4), primary key
 * @method PetitionContact    setSecret(string $val)             Type: string(40)
 * @method PetitionContact    setPassword(string $val)           Type: string(255)
 * @method PetitionContact    setPasswordReset(string $val)      Type: string(255)
 * @method PetitionContact    setPasswordResetUntil(string $val) Type: date, Date in ISO-8601 format (YYYY-MM-DD)
 * @method PetitionContact    setComment(string $val)            Type: clob
 * @method PetitionContact    setPetition(Petition $val)         
 * @method PetitionContact    setContact(Contact $val)           
 *  
 * @package    policat
 * @subpackage model
 * @author     Martin
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePetitionContact extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('petition_contact');
        $this->hasColumn('petition_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('contact_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('secret', 'string', 40, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 40,
             ));
        $this->hasColumn('password', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('password_reset', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('password_reset_until', 'date', null, array(
             'type' => 'date',
             'notnull' => false,
             ));
        $this->hasColumn('comment', 'clob', null, array(
             'type' => 'clob',
             'notnull' => false,
             ));

        $this->option('form', false);
        $this->option('filter', false);
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Petition', array(
             'local' => 'petition_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Contact', array(
             'local' => 'contact_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}