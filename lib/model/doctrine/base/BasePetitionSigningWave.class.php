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
 * BasePetitionSigningWave
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property integer $id
 * @property integer $petition_signing_id
 * @property integer $wave
 * @property clob $fields
 * @property integer $status
 * @property string $email
 * @property string $country
 * @property string $validation_data
 * @property string $language_id
 * @property integer $widget_id
 * @property integer $contact_num
 * @property PetitionSigning $PetitionSigning
 * @property Widget $Widget
 * @property Language $Language
 *
 * @method integer             getId()                  Returns the current record's "id" value
 * @method integer             getPetitionSigningId()   Returns the current record's "petition_signing_id" value
 * @method integer             getWave()                Returns the current record's "wave" value
 * @method clob                getFields()              Returns the current record's "fields" value
 * @method integer             getStatus()              Returns the current record's "status" value
 * @method string              getEmail()               Returns the current record's "email" value
 * @method string              getCountry()             Returns the current record's "country" value
 * @method string              getValidationData()      Returns the current record's "validation_data" value
 * @method string              getLanguageId()          Returns the current record's "language_id" value
 * @method integer             getWidgetId()            Returns the current record's "widget_id" value
 * @method integer             getContactNum()          Returns the current record's "contact_num" value
 * @method PetitionSigning     getPetitionSigning()     Returns the current record's "PetitionSigning" value
 * @method Widget              getWidget()              Returns the current record's "Widget" value
 * @method Language            getLanguage()            Returns the current record's "Language" value
 * @method PetitionSigningWave setId()                  Sets the current record's "id" value
 * @method PetitionSigningWave setPetitionSigningId()   Sets the current record's "petition_signing_id" value
 * @method PetitionSigningWave setWave()                Sets the current record's "wave" value
 * @method PetitionSigningWave setFields()              Sets the current record's "fields" value
 * @method PetitionSigningWave setStatus()              Sets the current record's "status" value
 * @method PetitionSigningWave setEmail()               Sets the current record's "email" value
 * @method PetitionSigningWave setCountry()             Sets the current record's "country" value
 * @method PetitionSigningWave setValidationData()      Sets the current record's "validation_data" value
 * @method PetitionSigningWave setLanguageId()          Sets the current record's "language_id" value
 * @method PetitionSigningWave setWidgetId()            Sets the current record's "widget_id" value
 * @method PetitionSigningWave setContactNum()          Sets the current record's "contact_num" value
 * @method PetitionSigningWave setPetitionSigning()     Sets the current record's "PetitionSigning" value
 * @method PetitionSigningWave setWidget()              Sets the current record's "Widget" value
 * @method PetitionSigningWave setLanguage()            Sets the current record's "Language" value
 *
 * @package    policat
 * @subpackage model
 * @author     Martin
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePetitionSigningWave extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('petition_signing_wave');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('petition_signing_id', 'integer', 8, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 8,
             ));
        $this->hasColumn('wave', 'integer', 2, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 1,
             'length' => 2,
             ));
        $this->hasColumn('fields', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             ));
        $this->hasColumn('status', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 1,
             'length' => 4,
             ));
        $this->hasColumn('email', 'string', 80, array(
             'type' => 'string',
             'length' => 80,
             ));
        $this->hasColumn('country', 'string', 5, array(
             'type' => 'string',
             'length' => 5,
             ));
        $this->hasColumn('validation_data', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('language_id', 'string', 5, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 5,
             ));
        $this->hasColumn('widget_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => false,
             'length' => 4,
             ));
        $this->hasColumn('contact_num', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             'length' => 4,
             ));


        $this->index('psw_wave', array(
             'fields' =>
             array(
              0 => 'wave',
             ),
             ));
        $this->index('psw_status', array(
             'fields' =>
             array(
              0 => 'status',
             ),
             ));
        $this->index('psw_p_status', array(
             'fields' =>
             array(
              0 => 'petition_signing_id',
              1 => 'status',
             ),
             ));
        $this->index('psw_p_w_status', array(
             'fields' =>
             array(
              0 => 'petition_signing_id',
              1 => 'wave',
              2 => 'status',
             ),
             ));
        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
        $this->option('non_json_fields', array(
             'fields' =>
             array(
              0 => 'email',
              1 => 'country',
             ),
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('PetitionSigning', array(
             'local' => 'petition_signing_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Widget', array(
             'local' => 'widget_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('Language', array(
             'local' => 'language_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));
    }
}
