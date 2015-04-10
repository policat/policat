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
 * BaseTicket
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property integer $from_id
 * @property integer $to_id
 * @property integer $campaign_id
 * @property integer $petition_id
 * @property integer $widget_id
 * @property integer $target_list_id
 * @property integer $kind
 * @property integer $status
 * @property clob $text
 * @property clob $data_json
 * @property sfGuardUser $From
 * @property sfGuardUser $To
 * @property Campaign $Campaign
 * @property Petition $Petition
 * @property Widget $Widget
 * @property MailingList $TargetList
 *
 * @method integer     getFromId()         Returns the current record's "from_id" value
 * @method integer     getToId()           Returns the current record's "to_id" value
 * @method integer     getCampaignId()     Returns the current record's "campaign_id" value
 * @method integer     getPetitionId()     Returns the current record's "petition_id" value
 * @method integer     getWidgetId()       Returns the current record's "widget_id" value
 * @method integer     getTargetListId()   Returns the current record's "target_list_id" value
 * @method integer     getKind()           Returns the current record's "kind" value
 * @method integer     getStatus()         Returns the current record's "status" value
 * @method clob        getText()           Returns the current record's "text" value
 * @method clob        getDataJson()       Returns the current record's "data_json" value
 * @method sfGuardUser getFrom()           Returns the current record's "From" value
 * @method sfGuardUser getTo()             Returns the current record's "To" value
 * @method Campaign    getCampaign()       Returns the current record's "Campaign" value
 * @method Petition    getPetition()       Returns the current record's "Petition" value
 * @method Widget      getWidget()         Returns the current record's "Widget" value
 * @method MailingList getTargetList()     Returns the current record's "TargetList" value
 * @method Ticket      setFromId()         Sets the current record's "from_id" value
 * @method Ticket      setToId()           Sets the current record's "to_id" value
 * @method Ticket      setCampaignId()     Sets the current record's "campaign_id" value
 * @method Ticket      setPetitionId()     Sets the current record's "petition_id" value
 * @method Ticket      setWidgetId()       Sets the current record's "widget_id" value
 * @method Ticket      setTargetListId()   Sets the current record's "target_list_id" value
 * @method Ticket      setKind()           Sets the current record's "kind" value
 * @method Ticket      setStatus()         Sets the current record's "status" value
 * @method Ticket      setText()           Sets the current record's "text" value
 * @method Ticket      setDataJson()       Sets the current record's "data_json" value
 * @method Ticket      setFrom()           Sets the current record's "From" value
 * @method Ticket      setTo()             Sets the current record's "To" value
 * @method Ticket      setCampaign()       Sets the current record's "Campaign" value
 * @method Ticket      setPetition()       Sets the current record's "Petition" value
 * @method Ticket      setWidget()         Sets the current record's "Widget" value
 * @method Ticket      setTargetList()     Sets the current record's "TargetList" value
 *
 * @package    policat
 * @subpackage model
 * @author     Martin
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTicket extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ticket');
        $this->hasColumn('from_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => false,
             'length' => 4,
             ));
        $this->hasColumn('to_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => false,
             'length' => 4,
             ));
        $this->hasColumn('campaign_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => false,
             'length' => 4,
             ));
        $this->hasColumn('petition_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => false,
             'length' => 4,
             ));
        $this->hasColumn('widget_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => false,
             'length' => 4,
             ));
        $this->hasColumn('target_list_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => false,
             'length' => 4,
             ));
        $this->hasColumn('kind', 'integer', 2, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 1,
             'length' => 2,
             ));
        $this->hasColumn('status', 'integer', 1, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 1,
             'length' => 1,
             ));
        $this->hasColumn('text', 'clob', null, array(
             'type' => 'clob',
             'notnull' => false,
             ));
        $this->hasColumn('data_json', 'clob', null, array(
             'type' => 'clob',
             'notnull' => false,
             ));


        $this->index('ticket_kind_idx', array(
             'fields' =>
             array(
              0 => 'kind',
             ),
             ));
        $this->index('ticket_status_idx', array(
             'fields' =>
             array(
              0 => 'status',
             ),
             ));
        $this->option('options', NULL);
        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_general_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as From', array(
             'local' => 'from_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('sfGuardUser as To', array(
             'local' => 'to_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('Campaign', array(
             'local' => 'campaign_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Petition', array(
             'local' => 'petition_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Widget', array(
             'local' => 'widget_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('MailingList as TargetList', array(
             'local' => 'target_list_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}
