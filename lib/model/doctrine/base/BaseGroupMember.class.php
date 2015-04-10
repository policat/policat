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
 * BaseGroupMember
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property integer $group_id
 * @property integer $member_id
 * @property Member $Member
 * @property Group $Group
 *
 * @method integer     getGroupId()   Returns the current record's "group_id" value
 * @method integer     getMemberId()  Returns the current record's "member_id" value
 * @method Member      getMember()    Returns the current record's "Member" value
 * @method Group       getGroup()     Returns the current record's "Group" value
 * @method GroupMember setGroupId()   Sets the current record's "group_id" value
 * @method GroupMember setMemberId()  Sets the current record's "member_id" value
 * @method GroupMember setMember()    Sets the current record's "Member" value
 * @method GroupMember setGroup()     Sets the current record's "Group" value
 *
 * @package    policat
 * @subpackage model
 * @author     Martin
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseGroupMember extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('group_member');
        $this->hasColumn('group_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('member_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Member', array(
             'local' => 'member_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Group', array(
             'local' => 'group_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}
