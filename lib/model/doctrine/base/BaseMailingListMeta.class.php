<?php

/**
 * BaseMailingListMeta
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property int                                          $id                                                Type: integer(4), primary key
 * @property int                                          $mailing_list_id                                   Type: integer(4)
 * @property int                                          $kind                                              Type: integer(1)
 * @property string                                       $name                                              Type: string
 * @property string                                       $subst                                             Type: string
 * @property string                                       $data_json                                         Type: clob
 * @property MailingList                                  $MailingList                                       
 * @property Doctrine_Collection|MailingListMetaChoice[]  $MailingListMetaChoice                             
 * @property Doctrine_Collection|ContactMeta[]            $ContactMeta                                       
 *  
 * @method int                                            getId()                                            Type: integer(4), primary key
 * @method int                                            getMailingListId()                                 Type: integer(4)
 * @method int                                            getKind()                                          Type: integer(1)
 * @method string                                         getName()                                          Type: string
 * @method string                                         getSubst()                                         Type: string
 * @method string                                         getDataJson()                                      Type: clob
 * @method MailingList                                    getMailingList()                                   
 * @method Doctrine_Collection|MailingListMetaChoice[]    getMailingListMetaChoice()                         
 * @method Doctrine_Collection|ContactMeta[]              getContactMeta()                                   
 *  
 * @method MailingListMeta                                setId(int $val)                                    Type: integer(4), primary key
 * @method MailingListMeta                                setMailingListId(int $val)                         Type: integer(4)
 * @method MailingListMeta                                setKind(int $val)                                  Type: integer(1)
 * @method MailingListMeta                                setName(string $val)                               Type: string
 * @method MailingListMeta                                setSubst(string $val)                              Type: string
 * @method MailingListMeta                                setDataJson(string $val)                           Type: clob
 * @method MailingListMeta                                setMailingList(MailingList $val)                   
 * @method MailingListMeta                                setMailingListMetaChoice(Doctrine_Collection $val) 
 * @method MailingListMeta                                setContactMeta(Doctrine_Collection $val)           
 *  
 * @package    policat
 * @subpackage model
 * @author     Martin
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMailingListMeta extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('mailing_list_meta');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('mailing_list_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('kind', 'integer', 1, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('name', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('subst', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('data_json', 'clob', null, array(
             'type' => 'clob',
             'notnull' => false,
             ));

        $this->option('symfony', array(
             'form' => true,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('MailingList', array(
             'local' => 'mailing_list_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('MailingListMetaChoice', array(
             'local' => 'id',
             'foreign' => 'mailing_list_meta_id'));

        $this->hasMany('ContactMeta', array(
             'local' => 'id',
             'foreign' => 'mailing_list_meta_id'));
    }
}