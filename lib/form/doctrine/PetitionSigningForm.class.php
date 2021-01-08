<?php
/*
 * Copyright (c) 2016, webvariants GmbH <?php Co. KG, http://www.webvariants.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

/**
 * PetitionSigning form.
 *
 * @package    policat
 * @subpackage form
 * @author     Martin
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PetitionSigningForm extends BasePetitionSigningForm {

  protected $no_mails = false;
  private $contact_num = 0;
  protected $skip_validation = false;
  protected $ref_code = false;

  public function getNoMails() {
    return $this->no_mails;
  }

  public function getSkipValidation() {
    return $this->skip_validation;
  }

  public function getRefCode() {
    return $this->ref_code;
  }

  public function configure() {
    $this->useFields(array('id', 'email', 'subscribe'));
    $this->disableLocalCSRFProtection();
    $widget_object = $this->getObject()->getWidget();
    $petition = $this->getObject()->getPetition();

    $this->formfields = $this->getObject()->getPetition()->getFormfields();

    $this->setValidator(Petition::FIELD_REF, new sfValidatorString(array('required' => false)));

    $this->mergePostValidator(new ValidatorUniqueEmail([], [
      'petition_id' => $petition['id'],
      ValidatorUniqueEmail::OPTION_IS_GEO => $petition->isGeoKind()
    ]));

    foreach ($this->formfields as $formfield) {
      if (isset($this[$formfield])) {
        unset($this[$formfield]);
      }
      $widget = null;
      $validator = null;
      $label = true;
      switch ($formfield) {
        case Petition::FIELD_EMAIL:
          $label = 'Email address';
          $widget = new sfWidgetFormInputText([], ['placeholder' => $label]);
          $validator = new ValidatorEmail(array('max_length' => 80));
          break;
        case Petition::FIELD_COUNTRY:
          $culture_info = $widget_object->getPetitionText()->utilCultureInfo();
          if ($petition->getCountryCollectionId()) {
            $countries = $petition->getCountryCollection()->getCountriesList();
          } else {
            $countries = $widget_object->getPetitionText()->utilCountries();
          }

          $widget = new WidgetFormI18nChoiceCountry(array('countries' => $countries, 'culture' => $culture_info->getName(), 'add_empty' => 'Country'));
          $validator = new sfValidatorI18nChoiceCountry(array('countries' => $countries));

          if ($widget_object->getDefaultCountry()) {
            $widget->setDefault($widget_object->getDefaultCountry());
          } elseif ($petition->getDefaultCountry()) {
            $widget->setDefault($petition->getDefaultCountry());
          }

          $label = 'Country';
          break;
        case Petition::FIELD_PRIVACY:
          if ($petition->getPolicyCheckbox() == PetitionTable::POLICY_CHECKBOX_YES) {
            $widget = new WidgetFormInputCheckbox(array('value_attribute_value' => 1));
            $validator = new sfValidatorChoice(array('choices' => array('1'), 'required' => true));
            $label = $widget_object->computePrivacyPolicyLinkText() ?: 'I accept the _privacy policy_';
          } else {
            $this->getObject()->setPrivacy(0);
          }
          break;
        case Petition::FIELD_SUBSCRIBE:
          $subscribe_default = $petition->getSubscribeDefault();
          if ($widget_object->isInDataOwnerMode() && $widget_object->getSubscribeDefault() != PetitionTable::SUBSCRIBE_CHECKBOX_INHERIT) {
            $subscribe_default = $widget_object->getSubscribeDefault();
          }
          if ($subscribe_default == PetitionTable::SUBSCRIBE_CHECKBOX_RADIO) {
            $this->getObject()->setSubscribe('unset'); // workaround to uncheck radio
            $widget = new sfWidgetFormChoice(array('choices' => array('1' => 'Yes, please', '0' => 'No, thank you'), 'expanded' => true, 'renderer_class' => 'FormatterRadio', 'renderer_options' => array('label_separator' => '')), array('class' => 'required', 'data-row-class' => 'subscribe-radio'));
            $validator = new sfValidatorChoice(array('choices' => array('1', '0')));
          } else {
            $widget = new WidgetFormInputCheckbox(array('value_attribute_value' => 1), $subscribe_default == PetitionTable::SUBSCRIBE_CHECKBOX_DEFAULT_YES ? array('checked' => 'checked') : array('class' => $subscribe_default == PetitionTable::SUBSCRIBE_CHECKBOX_REQUIRED ? 'required' : ''));
            $validator = new sfValidatorChoice(array('choices' => array('1'), 'required' => $subscribe_default == PetitionTable::SUBSCRIBE_CHECKBOX_REQUIRED));
          }
          $label = 'Keep me posted on this and similar campaigns.';
          $subscribe_text = trim($this->getOption('subscribe_text'));
          if ($subscribe_text) {
            $label = Util::enc($subscribe_text);
          }
          break;
        case Petition::FIELD_TITLE:
          if ($petition->getTitletype() == Petition::TITLETYPE_FM) {
            $widget = new sfWidgetFormChoice(array('choices' => array('' => '', 'female' => 'Mrs', 'male' => 'Mr')));
          } else {
            $widget = new sfWidgetFormChoice(array('choices' => array('' => '', 'female' => 'Mrs', 'male' => 'Mr', 'nogender' => 'Hello')));
          }
          $validator = new sfValidatorChoice(array('choices' => array('male', 'female', 'nogender')));
          $label = 'Mrs/Mr';
          break;
        case Petition::FIELD_COMMENT:
          $label = 'Personal comment';
          $widget = new sfWidgetFormTextarea([],  ['placeholder' => $label]);
          $validator = new sfValidatorString(array('required' => false));
          break;
        case Petition::FIELD_FIRSTNAME:
          $label = 'First name';
          $widget = new sfWidgetFormInputText([], ['placeholder' => $label]);
          $validator = new sfValidatorString();
          break;
        case Petition::FIELD_LASTNAME:
          $label = 'Last name';
          $widget = new sfWidgetFormInputText([], ['placeholder' => $label]);
          $validator = new sfValidatorString();
          break;
        case Petition::FIELD_FULLNAME:
          $label = 'Full name';
          $widget = new sfWidgetFormInputText([], ['placeholder' => $label]);
          $validator = new sfValidatorString();
          break;
        case Petition::FIELD_EXTRA1:
          $text = $this->getObject()->getWidget()->getPetitionText();
          $label = $text->getLabelExtra1() ? : 'Extra 1';
          $widget = new sfWidgetFormInputText(array(), array('class' => ($petition->getWithExtra1() == Petition::WITH_EXTRA_YES_REQUIRED ? '' : 'not_required'), 'placeholder' => $text->getPlaceholderExtra1() ?: $label));
          $validator = new sfValidatorString(array('required' => false));
          break;
        case Petition::FIELD_EXTRA2:
          $text = $this->getObject()->getWidget()->getPetitionText();
          $label = $text->getLabelExtra2() ? : 'Extra 2';
          $widget = new sfWidgetFormInputText(array(), array('class' => ($petition->getWithExtra2() == Petition::WITH_EXTRA_YES_REQUIRED ? '' : 'not_required'), 'placeholder' => $text->getPlaceholderExtra2() ?: $label));
          $validator = new sfValidatorString(array('required' => false));
          break;
        case Petition::FIELD_EXTRA3:
          $text = $this->getObject()->getWidget()->getPetitionText();
          $label = $text->getLabelExtra3() ? : 'Extra 3';
          $widget = new sfWidgetFormInputText(array(), array('class' => ($petition->getWithExtra3() == Petition::WITH_EXTRA_YES_REQUIRED ? '' : 'not_required'), 'placeholder' => $text->getPlaceholderExtra3() ?: $label));
          $validator = new sfValidatorString(array('required' => false));
          break;
        default:
          $label = str_replace('_', ' ', ucfirst('_id' == substr($formfield, -3) ? substr($formfield, 0, -3) : $formfield));
          $label = $this->getWidgetSchema()->getFormFormatter()->translate($label);
          $widget = new sfWidgetFormInputText([], ['placeholder' => $label]);
          $validator = new sfValidatorString();
      }
      if (isset($widget)) {
        $this->setWidget($formfield, $widget);
      }
      if (isset($widget)) {
        $this->setValidator($formfield, $validator);
      }
      if ($label !== true) {
        $this->getWidgetSchema()->setLabel($formfield, $label);
      }
    }

    if ($petition->isEmailKind()) {
      if ($petition->getKind() != Petition::KIND_PLEDGE) {
        $this->setWidget(Petition::FIELD_EMAIL_SUBJECT, new sfWidgetFormInputHidden(array(), array('class' => 'original')));
        $this->setValidator(Petition::FIELD_EMAIL_SUBJECT, new sfValidatorString(array('required' => true)));
        $this->setDefault(Petition::FIELD_EMAIL_SUBJECT, $this->buildEmailSubject($widget_object, $petition));

        $this->setWidget(Petition::FIELD_EMAIL_BODY, new sfWidgetFormTextarea(array('is_hidden' => true), array('class' => 'original')));
        $this->setValidator(Petition::FIELD_EMAIL_BODY, new sfValidatorString(array('required' => true)));
        $this->setDefault(Petition::FIELD_EMAIL_BODY, $this->buildEmailBody($widget_object, $petition));
      } else {
        $this->setWidget('pledges', new sfWidgetFormInputHidden());
        $this->setValidator('pledges', new sfValidatorString(array('required' => false)));
      }

      if ($petition->isGeoKind() && $petition->getKind() != Petition::KIND_PLEDGE) {
        $this->setWidget('ts_1', new sfWidgetFormInputHidden(array(), array('class' => 'original')));
        $this->setValidator('ts_1', new sfValidatorString(array('required' => false)));
        $this->setWidget('ts_2', new sfWidgetFormInputHidden(array(), array('class' => 'original')));
        $this->setValidator('ts_2', new sfValidatorString(array('required' => false)));
      }
    }

    if ($petition->getKind() == Petition::KIND_OPENECI) {
      $this->setWidget('ref_shown', new sfWidgetFormInputHidden(array(), array()));
      $this->setValidator('ref_shown', new sfValidatorChoice(array('choices' => array('0', '1'), 'required' => false)));
      $this->setDefault('ref_shown', '0');
    }

    $this->widgetSchema->setFormFormatterName('policatWidget');
  }

  private function buildEmailSubject(Widget $widget, Petition $petition) {
    return ($petition->getWidgetIndividualiseText() && trim($widget->getEmailSubject())) ? $widget->getEmailSubject() : $widget->getPetitionText()->getEmailSubject();
  }

  private function buildEmailBody(Widget $widget, Petition $petition) {
    return ($petition->getWidgetIndividualiseText() && trim($widget->getEmailBody())) ? $widget->getEmailBody() : $widget->getPetitionText()->getEmailBody();
  }

  public function selectFormatter($widget, $inputs) {
    $rows = array();
    foreach ($inputs as $input) {
      $rows[] = sprintf('<div class="input-checkbox">%s</div>%s%s', $input['input'], $widget->getOption('label_separator'), $input['label']);
    }

    return join('', $rows);
  }

  public static function utilPosition($array, $key1, $key2) {
    if (in_array($key1, $array) && in_array($key1, $array)) {
      foreach ($array as $key) {
        if ($key === $key1)
          return 2;
        if ($key === $key2)
          return true;
      }
      return true;
    }
    return false;
  }

  public function isGroupedField($name) {
    if (in_array($name, $this->fieldNames)) {
      switch ($name) {
        case Petition::FIELD_CITY: return self::utilPosition($this->fieldNames, Petition::FIELD_CITY, Petition::FIELD_POSTCODE);
        case Petition::FIELD_POSTCODE: return self::utilPosition($this->fieldNames, Petition::FIELD_POSTCODE, Petition::FIELD_CITY);
        case Petition::FIELD_TITLE:
          $petition = $this->getObject()->getPetition();
          if ($petition->getNametype() == Petition::NAMETYPE_SPLIT) {
            return self::utilPosition($this->fieldNames, Petition::FIELD_TITLE, Petition::FIELD_FIRSTNAME);
          } else {
            return false;
          }
        case Petition::FIELD_FIRSTNAME:
          $petition = $this->getObject()->getPetition();
          if ($petition->getTitletype() != Petition::TITLETYPE_NO) {
            return self::utilPosition($this->fieldNames, Petition::FIELD_FIRSTNAME, Petition::FIELD_TITLE);
          } else {
            return false;
          }
      }
    }
    return false;
  }

  protected function doUpdateObject($values) {
    $code = PetitionSigning::genCode();
    $petition = $this->getObject()->getPetition();

    if ($petition->isGeoKind()) {
        // EMAIL-TO-LIST ACTION (AND PLEDGE)
      $fields = array();
      $formFields = array();
      foreach ($this->formfields as $fieldname) {
        $formFields[] = $fieldname;
      }
      if ($petition->isEmailKind()) {
        $formFields[] = Petition::FIELD_EMAIL_SUBJECT;
        $formFields[] = Petition::FIELD_EMAIL_BODY;
      }
      $non_json_fields = array('email', 'country', 'subscribe');
      foreach ($formFields as $fieldname) {
        if (!in_array($fieldname, $non_json_fields)) {
          if (array_key_exists($fieldname, $values)) {
            $fields[$fieldname] = $values[$fieldname];
          }
        }
      }

      if ($petition->isEmailKind() && $petition->getEditable() == Petition::EDITABLE_NO) {
        $widget = $this->getObject()->getWidget();
        $fields[Petition::FIELD_EMAIL_SUBJECT] = $this->buildEmailSubject($widget, $petition);
        $fields[Petition::FIELD_EMAIL_BODY] = $this->buildEmailBody($widget, $petition);
      }

      $fields[Petition::FIELD_REF] = $values[Petition::FIELD_REF];

      $wave = new PetitionSigningWave();
      $wave->setWave($this->getObject()->getWavePending());
      $wave->setFields(json_encode($fields));
      $wave->setEmail($this->getValue(Petition::FIELD_EMAIL));
      $wave->setCountry($petition->getWithCountry() ? $this->getValue(Petition::FIELD_COUNTRY) : $petition->getDefaultCountry());
      $wave->setValidationData($code);
      $wave->setLanguageId($this->getObject()->getWidget()->getPetitionText()->getLanguageId());
      $wave->setWidgetId($this->getObject()->getWidgetId());
      $wave->setContactNum($this->contact_num);
      $object = $this->getObject();
      $object['PetitionSigningWave'][] = $wave;

    }

    if (!$this->getObject()->isNew()) {
      unset($values[Petition::FIELD_EMAIL_SUBJECT], $values[Petition::FIELD_EMAIL_BODY]);
    }

    if (!$petition->getWithCountry()) {
      $values['country'] = $petition->getDefaultCountry();
    }

    $validation_kind = $this->getOption('validation_kind', PetitionSigning::VALIDATION_KIND_NONE);
    if ($validation_kind == PetitionSigning::VALIDATION_KIND_EMAIL &&
        $petition->getValidationRequired() == Petition::VALIDATION_REQUIRED_YES_IF_SUBSCRIBE &&
        (!array_key_exists(Petition::FIELD_SUBSCRIBE, $values) || !$values[Petition::FIELD_SUBSCRIBE])) {
      $validation_kind = PetitionSigning::VALIDATION_KIND_NONE;
      $this->skip_validation = true;
    }

    switch ($validation_kind) {
      case PetitionSigning::VALIDATION_KIND_EMAIL:
        $values['validation_data'] = $code;
        $values['validation_kind'] = PetitionSigning::VALIDATION_KIND_EMAIL;
        $values['delete_code'] = PetitionSigning::genCode();
        break;
      case PetitionSigning::VALIDATION_KIND_NONE:
      default:
        $values['validation_kind'] = PetitionSigning::VALIDATION_KIND_NONE;
        break;
    }

    $email = $values[Petition::FIELD_EMAIL];
    if ($email) {
      $values['email_hash'] = UtilEmailHash::hash($email);
    }

    if ($petition->getKind() == Petition::KIND_OPENECI && (!array_key_exists('ref_shown', $values) || $values['ref_shown'] != '1'))  {
      $this->ref_code = bin2hex(random_bytes(8));
      $values['ref_hash'] = password_hash($this->ref_code, PASSWORD_DEFAULT);
    }

    unset($values['id']);
    parent::doUpdateObject($values);
  }

  protected function doSave($con = null) {
    if (null === $con) {
      $con = $this->getConnection();
    }

    $signing = $this->getObject();
    $petition = $signing->getPetition();

    if ($petition->getValidationRequired() == Petition::VALIDATION_REQUIRED_NO) {
      $signing->setStatus(PetitionSigning::STATUS_COUNTED);
    }

    if ($petition->getValidationRequired() == Petition::VALIDATION_REQUIRED_YES_IF_SUBSCRIBE) {
      $signing->setStatus(PetitionSigning::STATUS_COUNTED);
    }

    $geo_existing = false;
    if ($petition->isGeoKind()) {
      // EMAIL-TO-LIST ACTION (AND PLEDGE)
      $existing_signing = PetitionSigningTable::getInstance()->findByPetitionIdAndEmail($petition->getId(), $this->getValue('email'));
      if ($existing_signing) {
        $geo_existing = true;
        $existing_signing->setPetition($petition);
        $this->object = $existing_signing;
        $signing = $existing_signing;
        $this->isNew = false;
        $signing->setWavePending($signing->getWavePending() + 1);
      } else {
        $signing->setWavePending(1);
      }

      $this->contact_num = 0;

      if ($petition->getKind() == Petition::KIND_PLEDGE) {
        $targets = ContactTable::getInstance()->fetchIdsByContactIds($petition, $this->getValue('pledges'), $existing_signing);
      } else {
        $targets = ContactTable::getInstance()->fetchIdsByTargetSelector($petition, $this->getValue('ts_1'), $this->getValue('ts_2'), $existing_signing);
      }

      if ($targets) {
        foreach (((array) $targets) as $target) {
          $signing_contact = new PetitionSigningContact();
          $signing['PetitionSigningContact'][] = $signing_contact;
          $signing_contact->setContactId($target['id']);
          $signing_contact->setWave($signing->getWavePending());
          $this->contact_num++;
        }
        parent::doSave($con);
      } else {
        $this->no_mails = true;
      }
    } else {
      parent::doSave($con);
    }

    // cleanup old pending signings with same email address
    $existing_signing = PetitionSigningTable::getInstance()->findByPetitionIdAndEmail($petition->getId(), $signing->getEmail(), $signing->getId());
    if ($existing_signing) {
      if (($existing_signing->getStatus() == PetitionSigning::STATUS_PENDING && !$geo_existing)
        ||($existing_signing->getStatus() == PetitionSigning::STATUS_COUNTED && !$geo_existing && !$existing_signing->getSubscribe() && $signing->getSubscribe())) // see 4eb47883-b48f-43b0-af1f-0726857213cf
      {
        $existing_signing->delete();
      } else {
        // geo sticks to first signing
        $signing->delete();
        $this->object = $existing_signing;
        $signing = $existing_signing;
        return;
      }
    }

    switch ($signing->getValidationKind()) {
      case PetitionSigning::VALIDATION_KIND_EMAIL:
        UtilEmailValidation::send($signing);
        break;
      case PetitionSigning::VALIDATION_KIND_NONE:
      default:
        break;
    }
  }

}
