<?php

/**
 * BaseProduct
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property decimal $price
 * @property integer $days
 * @property integer $emails
 * @property integer $subscription
 * @property Doctrine_Collection $Quotas
 * 
 * @method integer             getId()           Returns the current record's "id" value
 * @method string              getName()         Returns the current record's "name" value
 * @method decimal             getPrice()        Returns the current record's "price" value
 * @method integer             getDays()         Returns the current record's "days" value
 * @method integer             getEmails()       Returns the current record's "emails" value
 * @method integer             getSubscription() Returns the current record's "subscription" value
 * @method Doctrine_Collection getQuotas()       Returns the current record's "Quotas" collection
 * @method Product             setId()           Sets the current record's "id" value
 * @method Product             setName()         Sets the current record's "name" value
 * @method Product             setPrice()        Sets the current record's "price" value
 * @method Product             setDays()         Sets the current record's "days" value
 * @method Product             setEmails()       Sets the current record's "emails" value
 * @method Product             setSubscription() Sets the current record's "subscription" value
 * @method Product             setQuotas()       Sets the current record's "Quotas" collection
 * 
 * @package    policat
 * @subpackage model
 * @author     Martin
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProduct extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('product');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 120, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 120,
             ));
        $this->hasColumn('price', 'decimal', 10, array(
             'type' => 'decimal',
             'notnull' => true,
             'scale' => 2,
             'length' => 10,
             ));
        $this->hasColumn('days', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             'length' => 4,
             ));
        $this->hasColumn('emails', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             'length' => 4,
             ));
        $this->hasColumn('subscription', 'integer', 1, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             'length' => 1,
             ));

        $this->option('symfony', array(
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Quota as Quotas', array(
             'local' => 'id',
             'foreign' => 'product_id'));

        $cachetaggable0 = new Doctrine_Template_Cachetaggable();
        $this->actAs($cachetaggable0);
    }
}