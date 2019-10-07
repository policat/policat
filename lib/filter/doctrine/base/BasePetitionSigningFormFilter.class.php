<?php

/**
 * PetitionSigning filter form base class.
 *
 * @package    policat
 * @subpackage filter
 * @author     Martin
 * @version    SVN: $Id$
 */
abstract class BasePetitionSigningFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'petition_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Petition'), 'add_empty' => true)),
      'campaign_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Campaign'), 'add_empty' => true)),
      'petition_text_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PetitionText'), 'add_empty' => true)),
      'language_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Language'), 'add_empty' => true)),
      'fields'                 => new sfWidgetFormFilterInput(),
      'status'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'petition_status'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'petition_enabled'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'verified'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'                  => new sfWidgetFormFilterInput(),
      'country'                => new sfWidgetFormFilterInput(),
      'validation_kind'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'validation_data'        => new sfWidgetFormFilterInput(),
      'delete_code'            => new sfWidgetFormFilterInput(),
      'widget_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Widget'), 'add_empty' => true)),
      'wave_sent'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'wave_pending'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'wave_cron'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'subscribe'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email_hash'             => new sfWidgetFormFilterInput(),
      'mailed_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fullname'               => new sfWidgetFormFilterInput(),
      'title'                  => new sfWidgetFormFilterInput(),
      'firstname'              => new sfWidgetFormFilterInput(),
      'lastname'               => new sfWidgetFormFilterInput(),
      'address'                => new sfWidgetFormFilterInput(),
      'city'                   => new sfWidgetFormFilterInput(),
      'post_code'              => new sfWidgetFormFilterInput(),
      'comment'                => new sfWidgetFormFilterInput(),
      'extra1'                 => new sfWidgetFormFilterInput(),
      'extra2'                 => new sfWidgetFormFilterInput(),
      'extra3'                 => new sfWidgetFormFilterInput(),
      'privacy'                => new sfWidgetFormFilterInput(),
      'email_subject'          => new sfWidgetFormFilterInput(),
      'email_body'             => new sfWidgetFormFilterInput(),
      'ref'                    => new sfWidgetFormFilterInput(),
      'quota_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Quota'), 'add_empty' => true)),
      'quota_emails'           => new sfWidgetFormFilterInput(),
      'thank_sent'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ref_shown'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ref_hash'               => new sfWidgetFormFilterInput(),
      'quota_thank_you_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('QuotaThankYou'), 'add_empty' => true)),
      'bounce'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'bounce_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'bounce_blocked'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'bounce_hard'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'bounce_related_to'      => new sfWidgetFormFilterInput(),
      'bounce_error'           => new sfWidgetFormFilterInput(),
      'download_subscriber_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DownloadSubscriber'), 'add_empty' => true)),
      'download_data_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DownloadData'), 'add_empty' => true)),
      'mailexportPending'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'contact_list'           => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Contact')),
    ));

    $this->setValidators(array(
      'petition_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Petition'), 'column' => 'id')),
      'campaign_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Campaign'), 'column' => 'id')),
      'petition_text_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PetitionText'), 'column' => 'id')),
      'language_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Language'), 'column' => 'id')),
      'fields'                 => new sfValidatorPass(array('required' => false)),
      'status'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'petition_status'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'petition_enabled'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'verified'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'email'                  => new sfValidatorPass(array('required' => false)),
      'country'                => new sfValidatorPass(array('required' => false)),
      'validation_kind'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'validation_data'        => new sfValidatorPass(array('required' => false)),
      'delete_code'            => new sfValidatorPass(array('required' => false)),
      'widget_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Widget'), 'column' => 'id')),
      'wave_sent'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'wave_pending'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'wave_cron'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'subscribe'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'email_hash'             => new sfValidatorPass(array('required' => false)),
      'mailed_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fullname'               => new sfValidatorPass(array('required' => false)),
      'title'                  => new sfValidatorPass(array('required' => false)),
      'firstname'              => new sfValidatorPass(array('required' => false)),
      'lastname'               => new sfValidatorPass(array('required' => false)),
      'address'                => new sfValidatorPass(array('required' => false)),
      'city'                   => new sfValidatorPass(array('required' => false)),
      'post_code'              => new sfValidatorPass(array('required' => false)),
      'comment'                => new sfValidatorPass(array('required' => false)),
      'extra1'                 => new sfValidatorPass(array('required' => false)),
      'extra2'                 => new sfValidatorPass(array('required' => false)),
      'extra3'                 => new sfValidatorPass(array('required' => false)),
      'privacy'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'email_subject'          => new sfValidatorPass(array('required' => false)),
      'email_body'             => new sfValidatorPass(array('required' => false)),
      'ref'                    => new sfValidatorPass(array('required' => false)),
      'quota_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Quota'), 'column' => 'id')),
      'quota_emails'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'thank_sent'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ref_shown'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ref_hash'               => new sfValidatorPass(array('required' => false)),
      'quota_thank_you_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('QuotaThankYou'), 'column' => 'id')),
      'bounce'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'bounce_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'bounce_blocked'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'bounce_hard'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'bounce_related_to'      => new sfValidatorPass(array('required' => false)),
      'bounce_error'           => new sfValidatorPass(array('required' => false)),
      'download_subscriber_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DownloadSubscriber'), 'column' => 'id')),
      'download_data_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DownloadData'), 'column' => 'id')),
      'mailexportPending'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'contact_list'           => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Contact', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('petition_signing_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addContactListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.PetitionSigningContact PetitionSigningContact')
      ->andWhereIn('PetitionSigningContact.contact_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'PetitionSigning';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'petition_id'            => 'ForeignKey',
      'campaign_id'            => 'ForeignKey',
      'petition_text_id'       => 'ForeignKey',
      'language_id'            => 'ForeignKey',
      'fields'                 => 'Text',
      'status'                 => 'Number',
      'petition_status'        => 'Number',
      'petition_enabled'       => 'Number',
      'verified'               => 'Number',
      'email'                  => 'Text',
      'country'                => 'Text',
      'validation_kind'        => 'Number',
      'validation_data'        => 'Text',
      'delete_code'            => 'Text',
      'widget_id'              => 'ForeignKey',
      'wave_sent'              => 'Number',
      'wave_pending'           => 'Number',
      'wave_cron'              => 'Number',
      'subscribe'              => 'Number',
      'email_hash'             => 'Text',
      'mailed_at'              => 'Date',
      'fullname'               => 'Text',
      'title'                  => 'Text',
      'firstname'              => 'Text',
      'lastname'               => 'Text',
      'address'                => 'Text',
      'city'                   => 'Text',
      'post_code'              => 'Text',
      'comment'                => 'Text',
      'extra1'                 => 'Text',
      'extra2'                 => 'Text',
      'extra3'                 => 'Text',
      'privacy'                => 'Number',
      'email_subject'          => 'Text',
      'email_body'             => 'Text',
      'ref'                    => 'Text',
      'quota_id'               => 'ForeignKey',
      'quota_emails'           => 'Number',
      'thank_sent'             => 'Number',
      'ref_shown'              => 'Number',
      'ref_hash'               => 'Text',
      'quota_thank_you_id'     => 'ForeignKey',
      'bounce'                 => 'Number',
      'bounce_at'              => 'Date',
      'bounce_blocked'         => 'Number',
      'bounce_hard'            => 'Number',
      'bounce_related_to'      => 'Text',
      'bounce_error'           => 'Text',
      'download_subscriber_id' => 'ForeignKey',
      'download_data_id'       => 'ForeignKey',
      'mailexportPending'      => 'Number',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
      'contact_list'           => 'ManyKey',
    );
  }
}
