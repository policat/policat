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
 * BasePledgeText
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property integer $pledge_item_id
 * @property integer $petition_text_id
 * @property clob $text
 * @property PledgeItem $PledgeItem
 * @property PetitionText $PetitionText
 *
 * @method integer      getPledgeItemId()     Returns the current record's "pledge_item_id" value
 * @method integer      getPetitionTextId()   Returns the current record's "petition_text_id" value
 * @method clob         getText()             Returns the current record's "text" value
 * @method PledgeItem   getPledgeItem()       Returns the current record's "PledgeItem" value
 * @method PetitionText getPetitionText()     Returns the current record's "PetitionText" value
 * @method PledgeText   setPledgeItemId()     Sets the current record's "pledge_item_id" value
 * @method PledgeText   setPetitionTextId()   Sets the current record's "petition_text_id" value
 * @method PledgeText   setText()             Sets the current record's "text" value
 * @method PledgeText   setPledgeItem()       Sets the current record's "PledgeItem" value
 * @method PledgeText   setPetitionText()     Sets the current record's "PetitionText" value
 *
 * @package    policat
 * @subpackage model
 * @author     Martin
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePledgeText extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('pledge_text');
        $this->hasColumn('pledge_item_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('petition_text_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('text', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             'default' => '',
             ));

        $this->option('form', true);
        $this->option('filter', false);
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('PledgeItem', array(
             'local' => 'pledge_item_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('PetitionText', array(
             'local' => 'petition_text_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}
