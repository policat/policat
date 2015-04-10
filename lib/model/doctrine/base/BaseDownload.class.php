<?php
/*
 * Copyright (c) 2015, webvariants GmbH & Co. KG, http://www.webvariants.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

/**
 * BaseDownload
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $widget_id
 * @property integer $petition_id
 * @property integer $campaign_id
 * @property string $filename
 * @property clob $filter
 * @property string $type
 * @property integer $subscriber
 * @property integer $count
 * @property integer $pages
 * @property integer $pages_processed
 * @property sfGuardUser $User
 * @property Widget $Widget
 * @property Petition $Petition
 * @property Campaign $Campaign
 *
 * @method integer     getId()              Returns the current record's "id" value
 * @method integer     getUserId()          Returns the current record's "user_id" value
 * @method integer     getWidgetId()        Returns the current record's "widget_id" value
 * @method integer     getPetitionId()      Returns the current record's "petition_id" value
 * @method integer     getCampaignId()      Returns the current record's "campaign_id" value
 * @method string      getFilename()        Returns the current record's "filename" value
 * @method clob        getFilter()          Returns the current record's "filter" value
 * @method string      getType()            Returns the current record's "type" value
 * @method integer     getSubscriber()      Returns the current record's "subscriber" value
 * @method integer     getCount()           Returns the current record's "count" value
 * @method integer     getPages()           Returns the current record's "pages" value
 * @method integer     getPagesProcessed()  Returns the current record's "pages_processed" value
 * @method sfGuardUser getUser()            Returns the current record's "User" value
 * @method Widget      getWidget()          Returns the current record's "Widget" value
 * @method Petition    getPetition()        Returns the current record's "Petition" value
 * @method Campaign    getCampaign()        Returns the current record's "Campaign" value
 * @method Download    setId()              Sets the current record's "id" value
 * @method Download    setUserId()          Sets the current record's "user_id" value
 * @method Download    setWidgetId()        Sets the current record's "widget_id" value
 * @method Download    setPetitionId()      Sets the current record's "petition_id" value
 * @method Download    setCampaignId()      Sets the current record's "campaign_id" value
 * @method Download    setFilename()        Sets the current record's "filename" value
 * @method Download    setFilter()          Sets the current record's "filter" value
 * @method Download    setType()            Sets the current record's "type" value
 * @method Download    setSubscriber()      Sets the current record's "subscriber" value
 * @method Download    setCount()           Sets the current record's "count" value
 * @method Download    setPages()           Sets the current record's "pages" value
 * @method Download    setPagesProcessed()  Sets the current record's "pages_processed" value
 * @method Download    setUser()            Sets the current record's "User" value
 * @method Download    setWidget()          Sets the current record's "Widget" value
 * @method Download    setPetition()        Sets the current record's "Petition" value
 * @method Download    setCampaign()        Sets the current record's "Campaign" value
 *
 * @package    policat
 * @subpackage model
 * @author     Martin
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDownload extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('download');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('user_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('widget_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => false,
             'length' => 4,
             ));
        $this->hasColumn('petition_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => false,
             'length' => 4,
             ));
        $this->hasColumn('campaign_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => false,
             'length' => 4,
             ));
        $this->hasColumn('filename', 'string', 80, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 80,
             ));
        $this->hasColumn('filter', 'clob', null, array(
             'type' => 'clob',
             'default' => '',
             ));
        $this->hasColumn('type', 'string', 40, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 40,
             ));
        $this->hasColumn('subscriber', 'integer', 1, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             'length' => 1,
             ));
        $this->hasColumn('count', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             'length' => 4,
             ));
        $this->hasColumn('pages', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             'length' => 4,
             ));
        $this->hasColumn('pages_processed', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             'length' => 4,
             ));

        $this->option('form', false);
        $this->option('filter', false);
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Widget', array(
             'local' => 'widget_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Petition', array(
             'local' => 'petition_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Campaign', array(
             'local' => 'campaign_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}
