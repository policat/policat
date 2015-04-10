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
 * BasePetitionText
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property integer $id
 * @property integer $status
 * @property string $language_id
 * @property integer $petition_id
 * @property string $title
 * @property clob $target
 * @property clob $background
 * @property clob $intro
 * @property clob $body
 * @property clob $footer
 * @property string $email_subject
 * @property clob $email_body
 * @property string $email_validation_subject
 * @property clob $email_validation_body
 * @property string $email_tellyour_subject
 * @property clob $email_tellyour_body
 * @property clob $email_targets
 * @property clob $privacy_policy_body
 * @property string $landing_url
 * @property integer $widget_id
 * @property string $pledge_title
 * @property clob $pledge_comment
 * @property clob $pledge_explantory_annotation
 * @property clob $pledge_thank_you
 * @property Petition $Petition
 * @property Language $Language
 * @property Widget $DefaultWidget
 * @property Doctrine_Collection $Widget
 * @property Doctrine_Collection $PledgeTexts
 *
 * @method integer             getId()                           Returns the current record's "id" value
 * @method integer             getStatus()                       Returns the current record's "status" value
 * @method string              getLanguageId()                   Returns the current record's "language_id" value
 * @method integer             getPetitionId()                   Returns the current record's "petition_id" value
 * @method string              getTitle()                        Returns the current record's "title" value
 * @method clob                getTarget()                       Returns the current record's "target" value
 * @method clob                getBackground()                   Returns the current record's "background" value
 * @method clob                getIntro()                        Returns the current record's "intro" value
 * @method clob                getBody()                         Returns the current record's "body" value
 * @method clob                getFooter()                       Returns the current record's "footer" value
 * @method string              getEmailSubject()                 Returns the current record's "email_subject" value
 * @method clob                getEmailBody()                    Returns the current record's "email_body" value
 * @method string              getEmailValidationSubject()       Returns the current record's "email_validation_subject" value
 * @method clob                getEmailValidationBody()          Returns the current record's "email_validation_body" value
 * @method string              getEmailTellyourSubject()         Returns the current record's "email_tellyour_subject" value
 * @method clob                getEmailTellyourBody()            Returns the current record's "email_tellyour_body" value
 * @method clob                getEmailTargets()                 Returns the current record's "email_targets" value
 * @method clob                getPrivacyPolicyBody()            Returns the current record's "privacy_policy_body" value
 * @method string              getLandingUrl()                   Returns the current record's "landing_url" value
 * @method integer             getWidgetId()                     Returns the current record's "widget_id" value
 * @method string              getPledgeTitle()                  Returns the current record's "pledge_title" value
 * @method clob                getPledgeComment()                Returns the current record's "pledge_comment" value
 * @method clob                getPledgeExplantoryAnnotation()   Returns the current record's "pledge_explantory_annotation" value
 * @method clob                getPledgeThankYou()               Returns the current record's "pledge_thank_you" value
 * @method Petition            getPetition()                     Returns the current record's "Petition" value
 * @method Language            getLanguage()                     Returns the current record's "Language" value
 * @method Widget              getDefaultWidget()                Returns the current record's "DefaultWidget" value
 * @method Doctrine_Collection getWidget()                       Returns the current record's "Widget" collection
 * @method Doctrine_Collection getPledgeTexts()                  Returns the current record's "PledgeTexts" collection
 * @method PetitionText        setId()                           Sets the current record's "id" value
 * @method PetitionText        setStatus()                       Sets the current record's "status" value
 * @method PetitionText        setLanguageId()                   Sets the current record's "language_id" value
 * @method PetitionText        setPetitionId()                   Sets the current record's "petition_id" value
 * @method PetitionText        setTitle()                        Sets the current record's "title" value
 * @method PetitionText        setTarget()                       Sets the current record's "target" value
 * @method PetitionText        setBackground()                   Sets the current record's "background" value
 * @method PetitionText        setIntro()                        Sets the current record's "intro" value
 * @method PetitionText        setBody()                         Sets the current record's "body" value
 * @method PetitionText        setFooter()                       Sets the current record's "footer" value
 * @method PetitionText        setEmailSubject()                 Sets the current record's "email_subject" value
 * @method PetitionText        setEmailBody()                    Sets the current record's "email_body" value
 * @method PetitionText        setEmailValidationSubject()       Sets the current record's "email_validation_subject" value
 * @method PetitionText        setEmailValidationBody()          Sets the current record's "email_validation_body" value
 * @method PetitionText        setEmailTellyourSubject()         Sets the current record's "email_tellyour_subject" value
 * @method PetitionText        setEmailTellyourBody()            Sets the current record's "email_tellyour_body" value
 * @method PetitionText        setEmailTargets()                 Sets the current record's "email_targets" value
 * @method PetitionText        setPrivacyPolicyBody()            Sets the current record's "privacy_policy_body" value
 * @method PetitionText        setLandingUrl()                   Sets the current record's "landing_url" value
 * @method PetitionText        setWidgetId()                     Sets the current record's "widget_id" value
 * @method PetitionText        setPledgeTitle()                  Sets the current record's "pledge_title" value
 * @method PetitionText        setPledgeComment()                Sets the current record's "pledge_comment" value
 * @method PetitionText        setPledgeExplantoryAnnotation()   Sets the current record's "pledge_explantory_annotation" value
 * @method PetitionText        setPledgeThankYou()               Sets the current record's "pledge_thank_you" value
 * @method PetitionText        setPetition()                     Sets the current record's "Petition" value
 * @method PetitionText        setLanguage()                     Sets the current record's "Language" value
 * @method PetitionText        setDefaultWidget()                Sets the current record's "DefaultWidget" value
 * @method PetitionText        setWidget()                       Sets the current record's "Widget" collection
 * @method PetitionText        setPledgeTexts()                  Sets the current record's "PledgeTexts" collection
 *
 * @package    policat
 * @subpackage model
 * @author     Martin
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePetitionText extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('petition_text');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('status', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 1,
             'length' => 4,
             ));
        $this->hasColumn('language_id', 'string', 5, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 5,
             ));
        $this->hasColumn('petition_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('title', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('target', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             ));
        $this->hasColumn('background', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             ));
        $this->hasColumn('intro', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('body', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('footer', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('email_subject', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('email_body', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('email_validation_subject', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('email_validation_body', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             ));
        $this->hasColumn('email_tellyour_subject', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('email_tellyour_body', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             ));
        $this->hasColumn('email_targets', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('privacy_policy_body', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('landing_url', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('widget_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => false,
             'length' => 4,
             ));
        $this->hasColumn('pledge_title', 'string', null, array(
             'type' => 'string',
             'notnull' => false,
             ));
        $this->hasColumn('pledge_comment', 'clob', null, array(
             'type' => 'clob',
             'notnull' => false,
             ));
        $this->hasColumn('pledge_explantory as pledge_explantory_annotation', 'clob', null, array(
             'type' => 'clob',
             'notnull' => false,
             ));
        $this->hasColumn('pledge_thank_you', 'clob', null, array(
             'type' => 'clob',
             'notnull' => false,
             ));

        $this->option('symfony', array(
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Petition', array(
             'local' => 'petition_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Language', array(
             'local' => 'language_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Widget as DefaultWidget', array(
             'local' => 'widget_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasMany('Widget', array(
             'local' => 'id',
             'foreign' => 'petition_text_id'));

        $this->hasMany('PledgeText as PledgeTexts', array(
             'local' => 'id',
             'foreign' => 'petition_text_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $cachetaggable0 = new Doctrine_Template_Cachetaggable(array(
             ));
        $this->actAs($timestampable0);
        $this->actAs($cachetaggable0);
    }
}
