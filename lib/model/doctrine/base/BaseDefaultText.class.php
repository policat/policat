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
 * BaseDefaultText
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property integer $id
 * @property string $language_id
 * @property string $text
 * @property string $subject
 * @property clob $body
 * @property Language $Language
 *
 * @method integer     getId()          Returns the current record's "id" value
 * @method string      getLanguageId()  Returns the current record's "language_id" value
 * @method string      getText()        Returns the current record's "text" value
 * @method string      getSubject()     Returns the current record's "subject" value
 * @method clob        getBody()        Returns the current record's "body" value
 * @method Language    getLanguage()    Returns the current record's "Language" value
 * @method DefaultText setId()          Sets the current record's "id" value
 * @method DefaultText setLanguageId()  Sets the current record's "language_id" value
 * @method DefaultText setText()        Sets the current record's "text" value
 * @method DefaultText setSubject()     Sets the current record's "subject" value
 * @method DefaultText setBody()        Sets the current record's "body" value
 * @method DefaultText setLanguage()    Sets the current record's "Language" value
 *
 * @package    policat
 * @subpackage model
 * @author     Martin
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDefaultText extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('default_text');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('language_id', 'string', 5, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 5,
             ));
        $this->hasColumn('text', 'string', 20, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 20,
             ));
        $this->hasColumn('subject', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '',
             'length' => 255,
             ));
        $this->hasColumn('body', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             ));


        $this->index('def_text_lang_text', array(
             'fields' =>
             array(
              0 => 'language_id',
              1 => 'text',
             ),
             'type' => 'unique',
             ));
        $this->option('symfony', array(
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Language', array(
             'local' => 'language_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}
