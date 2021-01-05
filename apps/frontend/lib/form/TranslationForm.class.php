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
 * PetitionText form.
 *
 * @package    policat
 * @subpackage form
 */
class TranslationForm extends BasePetitionTextForm {

  use FormTargetSelectorPreselect;

  protected $state_count = true;

  public function getStateCount() {
    return $this->state_count;
  }

  public function configure() {
    $this->widgetSchema->setFormFormatterName('bootstrap');
    $this->widgetSchema->setNameFormat('translation[%s]');

    $petition_text = $this->getObject();
    $petition = $petition_text->getPetition();

    unset(
      $this['created_at'], $this['updated_at'], $this['petition_id'], $this['object_version'], $this['email_targets'], $this['widget_id'], $this['donate_url'], $this['donate_text'],
      $this['digest_subject'], $this['digest_body_intro'], $this['digest_body_outro'], $this['landing2_url']
    );

    $this->setWidget('form_title', new sfWidgetFormInput(array('label' => 'Widget heading'), array('size' => 90, 'class' => 'large', 'placeholder' => 'Leave this field empty to use standard texts.')));
    $this->getWidgetSchema()->setHelp('form_title', 'You may customise the widget heading above the sign-up form (optional). Leave this field empty to use standard texts. Note that not all widget layouts (themes) display this heading.');

    $mediaMarkupSet = MediaFileTable::getInstance()->dataMarkupSet($petition);

    $this->setWidget('title', new sfWidgetFormInput(array(), array('size' => 90, 'class' => 'large', 'placeholder' => 'Optional (you may leave this field empty). Add here a short and movtivating action title.')));
    $this->setWidget('target', new sfWidgetFormTextarea(array('label' => 'Subtitle'), array(
        'cols' => 90,
        'rows' => 3,
        'class' => 'markdown',
        'placeholder' => 'Optional (you may leave this field empty). Add here a short contextual introduction, or name the targets of your action (e.g. "To the heads of states of the European Union". Keep it very short!',
        'data-markup-set-1' => $mediaMarkupSet
    )));
    $this->getValidator('target')->setOption('required', false)->setOption('trim', true);
    $this->setWidget('background', new sfWidgetFormTextarea(array(), array(
        'cols' => 90,
        'rows' => 5,
        'class' => 'markdown',
        'placeholder' => 'Optional (you may leave this field empty). Add here further contextual information about this action. You may add external media files (make sure they are hosted on a server with an encrypted SSL connection).',
        'data-markup-set-1' => $mediaMarkupSet
    )));

    $this->setWidget('read_more_url', new sfWidgetFormInput(array('label' => '"Read more" link'), array(
        'size' => 90,
        'class' => 'add_popover large',
        'data-content' => 'Enter the URL of your campaign site for this language, including "https://" or https://www. ". A "Read more" link will appear underneath your e-action. Leave empty for standard "Read more" page.',
        'placeholder' => $petition->getReadMoreUrl() ?: 'https://www.example.com/-language-/info'
    )));
    $this->setValidator('read_more_url', new ValidatorUrl(array('required' => false)));

    $this->setWidget('landing_url', new sfWidgetFormInput(array('label' => 'E-mail Validation Landingpage - auto forwarding to external page'), array(
        'size' => 90,
        'class' => 'add_popover large',
        'data-content' => 'Enter URL of external landing page, including \'http://\'. Leave empty for standard landing page',
        'placeholder' => $petition->getLandingUrl() ?: 'https://www.example.com/-language-/thank-you'
    )));
    $this->setValidator('landing_url', new ValidatorUrl(array('required' => false, 'trim' => true)));

    if ($this->getObject()->getPetition()->getKind() == Petition::KIND_OPENECI) {
        $this->setWidget('landing2_url', new sfWidgetFormInput(array('label' => 'Alternative opt-in landing page, if OpenECI form was not submitted'), array(
            'size' => 90,
            'class' => 'add_popover large',
            'data-content' => 'Provide an alternative landing page, containing the ECI form and a prompt to "support the ECI, if you haven\'t done yet"',
            'placeholder' => 'https://www.example.com/-language-/thank-you'
        )));
        $this->setValidator('landing2_url', new ValidatorUrl(array('required' => false, 'trim' => true)));
    }

    if (!$petition->isEmailKind()) {
      $this->setWidget('intro', new sfWidgetFormTextarea(array('label' => 'Introductory part'), array(
          'cols' => 90,
          'rows' => 5,
          'class' => 'markdown',
          'placeholder' => 'The petition text will be split into 3 parts. This part (the intro) and the last part (the footer) should contain contextual information, e. g. references to the political addressee or to a specific event. Your partners and supporters will be able to modify this text for their own widgets. Put the relevant parts of your message into the 2. part of the petition (the body).',
          'data-markup-set-1' => $mediaMarkupSet
      )));
      $this->setWidget('body', new sfWidgetFormTextarea(array('label' => 'Main part'), array(
          'cols' => 90,
          'rows' => 30,
          'class' => 'markdown',
          'placeholder' => 'Put the relevant parts of your message into this part of the petition (the body). This text will remain the same throughout all widgets created for this campaign. Choose this text carefully. It should be as brief as possible.',
          'data-markup-set-1' => $mediaMarkupSet
      )));
      $this->setWidget('footer', new sfWidgetFormTextarea(array('label' => 'Closing part'), array(
          'cols' => 90,
          'rows' => 5,
          'class' => 'markdown',
          'placeholder' => 'Insert a closing rate here, e. g. a reference to a specific event, your petition hand-over action or simply a complimentary close.',
          'data-markup-set-1' => $mediaMarkupSet
      )));
      $this->getValidator('intro')->setOption('required', false);
      $this->getValidator('body')->setOption('required', true);
      $this->getValidator('footer')->setOption('required', false);
      unset($this['email_subject'], $this['email_body']);
    } else {
      $this->setWidget('email_subject', new sfWidgetFormInput(array(), array('size' => 90, 'class' => 'large')));
      $this->setWidget('email_body', new sfWidgetFormTextarea(array(), array('cols' => 90, 'rows' => 30, 'class' => 'large elastic highlight')));
      $this->getValidator('email_subject')->setOption('required', true);
      $this->getValidator('email_body')->setOption('required', true);
      unset($this['intro'], $this['body'], $this['footer']);
      if ($petition->isGeoKind()) {
        $subst_fields = $petition->getGeoSubstFields();
        $keywords = array();
        foreach ($subst_fields as $keyword => $subst_field) {
          if ($subst_field['id'] != MailingList::FIX_GENDER) {
            $keywords[] = '<b>' . $keyword . '</b> (' . $subst_field['name'] . ')';
          }
        }
        if ($this->getObject()->getPetition()->getKind() == Petition::KIND_PLEDGE) {
          $this->setWidget('email_body', new sfWidgetFormTextarea(array(), array(
              'cols' => 90,
              'rows' => 3,
              'class' => 'markdown highlight email-template markItUp-higher',
              'data-markup-set-1' => UtilEmailLinks::dataMarkupSet(array(UtilEmailLinks::PLEDGE)),
              'data-markup-set-2' => $mediaMarkupSet
          )));
          $keywords[] = '<b>' . htmlentities('[Pledge now](#PLEDGE-URL#)')  . '</b> (Link for the candidate)';
          $this->setValidator('email_body', new sfValidatorRegex(array(
              'required' => true,
              'pattern' => '/#PLEDGE-URL#/'
            ), array(
              'invalid' => 'Missing the following keywords: #PLEDGE-URL#'
          )));
        }
        foreach (PetitionSigningTable::$KEYWORDS as $keyword) {
          $keywords[] = $keyword;
        }

        $keywords[] = PetitionTable::KEYWORD_PERSONAL_SALUTATION;
      } else {
        $keywords = PetitionSigningTable::$KEYWORDS;
      }

      $this->getWidgetSchema()->setHelp('email_body', 'You can use the following keywords: ' . implode(', ', $keywords) . '.');
    }

    $email_keywords = '#REFERER-URL#, #READMORE-URL#, #TITLE#, #TARGET#, #BACKGROUND#, #ACTION-TEXT#, #INTRO#,'
      . ' #FOOTER#, #EMAIL-SUBJECT#, #EMAIL-BODY#, #BODY#, #DATA-OFFICER-NAME#, #DATA-OFFICER-ORGA#, #DATA-OFFICER-EMAIL#, #DATA-OFFICER-WEBSITE#, #DATA-OFFICER-PHONE#, '
      . '#DATA-OFFICER-MOBILE#, #DATA-OFFICER-STREET#, #DATA-OFFICER-POST-CODE#, #DATA-OFFICER-CITY#, #DATA-OFFICER-COUNTRY#, #DATA-OFFICER-ADDRESS#, ' . implode(', ', PetitionSigningTable::$KEYWORDS);

    $this->setWidget('email_validation_subject', new sfWidgetFormInput(array('label' => 'Opt-In Confirmation Email Subject'), array('size' => 90, 'class' => 'large')));
    $this->setWidget('email_validation_body', new sfWidgetFormTextarea(array('label' => 'Opt-In Confirmation Email Body'), array(
        'cols' => 90,
        'rows' => 16,
        'class' => 'markdown highlight email-template markItUp-higher',
        'data-markup-set-1' => UtilEmailLinks::dataMarkupSet(array(UtilEmailLinks::VALIDATION, UtilEmailLinks::DISCONFIRMATION, UtilEmailLinks::REFERER, UtilEmailLinks::READMORE)),
        'data-markup-set-2' => $mediaMarkupSet
    )));
    $this->setValidator('email_validation_body', new ValidatorKeywords(array('required' => true, 'keywords' => array('#VALIDATION-URL#'))));
    $this->getWidgetSchema()->setHelp('email_validation_body', '#VALIDATION-URL#, #DISCONFIRMATION-URL#,' . $email_keywords);
    $this->setWidget('email_tellyour_subject', new sfWidgetFormInput(array(), array('size' => 90, 'class' => 'large')));
    $this->setWidget('email_tellyour_body', new sfWidgetFormTextarea(array(), array('cols' => 90, 'rows' => 8, 'class' => 'large elastic highlight')));
    $this->getWidgetSchema()->setHelp('email_tellyour_body', '#REFERER-URL#, #READMORE-URL#, #TITLE#, #TARGET#, #BACKGROUND#, #INTRO#, #FOOTER#, #EMAIL-SUBJECT#, #EMAIL-BODY#, #BODY#');
    $this->setValidator('email_tellyour_body', new sfValidatorString(array('max_length' => 1800)));
    $this->getWidgetSchema()->setLabel('email_tellyour_subject', 'Tell-Your-Friend Email Subject');
    $this->getWidgetSchema()->setLabel('email_tellyour_body', 'Tell-Your-Friend Email Body');

    $possible_statuses = array_keys(PetitionText::$STATUS_SHOW);
    $this->state_count = count($possible_statuses);

    $possible_statuses_show = PetitionText::calcStatusShow($possible_statuses);

    $this->setWidget('status', new sfWidgetFormChoice(array('choices' => $possible_statuses_show), array('class' => 'no-chosen form-control')));
    $this->setValidator('status', new sfValidatorChoice(array('choices' => $possible_statuses, 'required' => true)));

    if ($petition_text->getLanguageId() === null) {
      $this->setWidget('language_id', new sfWidgetFormDoctrineChoice(array(
          'model' => $this->getRelatedModelName('Language'),
          'add_empty' => false,
          'query' => Doctrine_Core::getTable('Language')
            ->createQuery('l')
            ->where('l.id NOT IN (SELECT pt.language_id FROM PetitionText pt WHERE pt.petition_id = ?)', $petition_text->getPetitionId())
        ), array(
          'class' => 'ajax_change',
          'data-action' => sfContext::getInstance()->getRouting()->generate('translation_default', array('id' => $petition->getCampaign()->getId()))
      )));
      $this->setValidator('language_id', new sfValidatorDoctrineChoice(array(
          'model' => $this->getRelatedModelName('Language'),
          'query' => Doctrine_Core::getTable('Language')
            ->createQuery('l')
            ->where('l.id NOT IN (SELECT pt.language_id FROM PetitionText pt WHERE pt.petition_id = ?)', $petition_text->getPetitionId())
      )));
    } else {
      unset($this['language_id']);
    }

    $this->setWidget('privacy_policy_body', new sfWidgetFormTextarea(array('label' => 'Text (if not linked by URL)'), array('cols' => 90, 'rows' => 30, 'class' => 'markdown highlight')));
    $this->getWidgetSchema()->setHelp('privacy_policy_body', '#DATA-OFFICER-NAME#, #DATA-OFFICER-ORGA#, #DATA-OFFICER-EMAIL#, #DATA-OFFICER-WEBSITE#, #DATA-OFFICER-PHONE#, #DATA-OFFICER-MOBILE#, #DATA-OFFICER-STREET#, #DATA-OFFICER-POST-CODE#, #DATA-OFFICER-CITY#, #DATA-OFFICER-COUNTRY#, #DATA-OFFICER-ADDRESS#');

    $this->setWidget('privacy_policy_url', new sfWidgetFormInput(array('label' => 'URL'), array(
      'size' => 90,
      'placeholder' => 'https://www.example.com/privacy_policy' . ($petition_text->getLanguageId() ? '/' . $petition_text->getLanguageId() : '' )
    )));
    $this->setValidator('privacy_policy_url', new ValidatorUrl(array('required' => false)));
    $this->getWidgetSchema()->setHelp('privacy_policy_url', 'Leave this empty to show the privacy policy text as below within the widget (recommended). If a click on "privacy policy" should open your own privacy policy page instead, enter its URL here, including "https://".');

    $this->setWidget('privacy_policy_link_text', new sfWidgetFormInput(['label' => 'Privacy policy link'], ['size' => 90, 'placeholder' => 'I accept the _privacy policy_']));
    $this->setValidator('privacy_policy_link_text', new sfValidatorRegex(['required' => false, 'pattern' => '/^[^_]*_[^_]+_[^_]*$/i'], ['invalid' => 'Missing enclosing underscores.']));
    $this->getWidgetSchema()->setHelp('privacy_policy_link_text', 'Please mark the link part with two enclosing underscores. ex "I accept the _privacy policy_"');

    if (!$petition_text->isNew()) {
      $this->setWidget('updated_at', new sfWidgetFormInputHidden());
      $this->setValidator('updated_at', new ValidatorUnchanged(array('fix' => $petition_text->getUpdatedAt())));
    }

    if ($petition->getKind() == Petition::KIND_PLEDGE) {
      $this->setWidget('pledge_title', new sfWidgetFormInput(array('label' => 'Title'), array('size' => 90, 'class' => 'large')));
      $this->setWidget('intro', new sfWidgetFormTextarea(array('label' => 'Introduction'), array('cols' => 90, 'rows' => 5, 'class' => 'markdown')));
      $this->getWidgetSchema()->moveField('intro', sfWidgetFormSchema::AFTER, 'pledge_title');
      $this->setValidator('intro', new sfValidatorString(array('required' => false)));
      unset($this['pledge_comment']);
      $this->setWidget('pledge_explantory_annotation', new sfWidgetFormTextarea(array(), array('cols' => 90, 'rows' => 5, 'class' => 'markdown')));
      $this->getWidgetSchema()->setLabel('pledge_explantory_annotation', 'Explantory annotation and contact information');
      $this->setWidget('pledge_thank_you', new sfWidgetFormTextarea(array(), array('cols' => 90, 'rows' => 5, 'class' => 'markdown')));
      $this->getWidgetSchema()->setLabel('pledge_thank_you', '"Thank you" dialog');

      $pledge_items = $petition->getPledgeItems();

      foreach ($pledge_items as $pledge_item) {
        /* @var $pledge_item PledgeItem */
        if ($petition_text->isNew()) {
          $pledge_text = new PledgeText();
          $pledge_text->setPetitionText($petition_text);
          $pledge_text->setPledgeItem($pledge_item);
        } else {
          $pledge_text = PledgeTextTable::getInstance()->findOneByItemAndText($pledge_item, $petition_text);
          if (!$pledge_text) {
            $pledge_text = new PledgeText();
            $pledge_text->setPetitionText($petition_text);
            $pledge_text->setPledgeItem($pledge_item);
          }
        }
        $this->embedForm('pledge_' . $pledge_item->getId(), new PledgeTextForm($pledge_text), '%content%');
        $this->getWidgetSchema()->setLabel('pledge_' . $pledge_item->getId(), $pledge_item->getName() . ' (' . $pledge_item->getStatusName() . ')');
      }
    } else {
      unset($this['pledge_title'], $this['pledge_comment'], $this['pledge_explantory_annotation'], $this['pledge_thank_you']);
    }

    $this->configureTargetSelectors();

    // copy defaults from existing text
    $copy = $this->getOption('copy', null);
    if ($copy) {
      foreach (array('title', 'target', 'background', 'intro', 'body', 'footer', 'privacy_policy_body',
        'email_validation_subject', 'email_validation_body', 'email_tellyour_subject', 'email_tellyour_body', 'email_subject', 'email_body',
        'landing_url', 'pledge_title', 'pledge_comment', 'pledge_explantory_annotation', 'pledge_thank_you'
      ) as $field) {
        if (isset($this[$field]) && $this[$field]) {
          $this->setDefault($field, $copy[$field]);
        }
      }
    }

    // donate_url on petition enables/disabled donate_url and donate_text feature
    if ($petition->getDonateUrl()) {

      $this->setWidget('donate_url', new sfWidgetFormInput(array('label' => 'Optional: Link to language-specific donation page'
          . ''), array(
          'size' => 90,
          'class' => 'add_popover large',
          'data-content' => 'Enter the link (URL) to your language-specific donation page (e.g. "https://" or "http://"). Optional: leave this field empty to use the standard URL for this action (see above).',
          'placeholder' => 'https://www.example.com/donate/' . $this->getObject()->getLanguageId(),
          'label' => 'Donate link'
      )));
      $this->setValidator('donate_url', new ValidatorUrl(array('required' => false)));

      $this->setWidget('donate_text', new sfWidgetFormTextarea(array(), array('cols' => 90, 'rows' => 3, 'class' => 'markdown')));
      $this->setValidator('donate_text', new sfValidatorString(array('max_length' => 1800, 'required' => false)));
      $this->getWidgetSchema()->setHelp('donate_text', 'This may contain explanatory text and will be displayed in the widget, on click of the \'Donate\' button. It necessitates two clicks to open the donation page in a new browser tab. For a single click workflow, leave this field empty.');
    }

    if ($petition->getWithExtra1() != Petition::WITH_EXTRA_NO) {
      $this->getWidgetSchema()->setLabel('label_extra1', 'Extra input field 1 label (title text)');
      unset($this['placeholder_extra1']);
    } else {
      unset($this['label_extra1'], $this['placeholder_extra1']);
    }

    if ($petition->getWithExtra2() != Petition::WITH_EXTRA_NO) {
      $this->getWidgetSchema()->setLabel('label_extra2', 'Extra input field 2 label (title text)');
      unset($this['placeholder_extra2']);
    } else {
    unset($this['label_extra2'], $this['placeholder_extra2']);
    }

    if ($petition->getWithExtra3() != Petition::WITH_EXTRA_NO) {
      $this->getWidgetSchema()->setLabel('label_extra3', 'Extra input field 3 label (title text)');
      unset($this['placeholder_extra3']);
    } else {
    unset($this['label_extra3'], $this['placeholder_extra3']);
    }

    $this->setWidget('subscribe_text', new sfWidgetFormInput(array('label' => 'Keep-me-posted checkbox'), array('size' => 90, 'class' => 'large', 'placeholder' => 'Leave this field empty to use standard texts.')));
    $this->getWidgetSchema()->setHelp('subscribe_text', 'You may customise the text of the keep-me-posted checkbox. Leave this field empty to use standard texts. You may use the following keywords to include the name or email of the respective data owner: #DATA-OFFICER-NAME#, #DATA-OFFICER-ORGA#, #DATA-OFFICER-EMAIL#');

    $this->setWidget('tyf_title', new sfWidgetFormInput(
      ['label' => 'Tell your friends heading on thank-you-page'],
      ['size' => 90, 'class' => 'large', 'placeholder' => 'Leave this field empty to use standard texts.']
    ));
    $this->getWidgetSchema()->setHelp('tyf_title', 'You may customise the "Tell your friends" heading above the social media buttons (optional). Leave this field empty to use standard texts. Note that not all widget layouts (themes) display this heading.');

    if ($petition->getThankYouEmail() == Petition::THANK_YOU_EMAIL_YES) {
      $this->setWidget('thank_you_email_subject', new sfWidgetFormInput(array('label' => 'Thank-You Email Subject'), array('size' => 90, 'class' => 'large')));
      $this->setWidget('thank_you_email_body', new sfWidgetFormTextarea(array('label' => 'Thank-You Email Body'), array(
          'cols' => 90,
          'rows' => 16,
          'class' => 'markdown highlight email-template markItUp-higher',
          'data-markup-set-1' => UtilEmailLinks::dataMarkupSet(array(UtilEmailLinks::UNSUBSCRIBE, UtilEmailLinks::REFERER, UtilEmailLinks::READMORE)),
          'data-markup-set-2' => $mediaMarkupSet
      )));
      $this->getWidgetSchema()->setHelp('thank_you_email_body', '#UNSUBSCRIBE-URL#, ' . $email_keywords);
    } else {
      unset($this['thank_you_email_subject'], $this['thank_you_email_body']);
    }

    if ($petition->getLastSignings() != PetitionTable::LAST_SIGNINGS_NO) {
      $this->setWidget('signers_page', new sfWidgetFormTextarea(array('label' => 'Header/context for all signers list (optional)'), array('cols' => 90, 'rows' => 5, 'class' => 'markdown', 'placeholder' => '(optional)')));

      $this->setWidget('signers_url', new sfWidgetFormInput(array('label' => 'Link to external signers page (optional)'
          . ''), array(
          'size' => 90,
          'class' => 'large',
          'placeholder' => 'https://www.example.com/signers/' . $this->getObject()->getLanguageId(),
      )));

      $this->getWidgetSchema()->setHelp('signers_url', 'Optional (you may leave this field empty). As a standard, the "All signers" button in the widget opens a new tab with just the list. This option allows you to link the button to your own website. Make sure to embed the correct language version of the "All signers" on this page. For this, simply add an iframe with the above link as source.');

      $this->setValidator('signers_url', new ValidatorUrl(array('required' => false)));
    } else {
      unset($this['signers_page'], $this['signers_url']);
    }

    if (($petition->getKind() == Petition::KIND_PLEDGE) && $petition->getDigestEnabled()) {
      $this->setWidget('digest_subject', new sfWidgetFormInput(array('label' => 'subject'), array('size' => 90, 'class' => 'large', 'placeholder' => 'Digest e-mail subject line. If left empty the title is used.')));
      $this->setWidget('digest_body_intro', new sfWidgetFormTextarea(array('label' => 'Intro'), array(
          'cols' => 90,
          'rows' => 3,
          'class' => 'markdown highlight email-template markItUp-higher',
          'data-markup-set-1' => UtilEmailLinks::dataMarkupSet(array(UtilEmailLinks::PLEDGE)),
          'data-markup-set-2' => $mediaMarkupSet
      )));
      $this->setWidget('digest_body_outro', new sfWidgetFormTextarea(array('label' => 'Footer'), array(
          'cols' => 90,
          'rows' => 3,
          'class' => 'markdown highlight email-template',
          'data-markup-set-1' => UtilEmailLinks::dataMarkupSet(array(UtilEmailLinks::PLEDGE)),
          'data-markup-set-2' => $mediaMarkupSet
      )));
      $subst_fields = implode(', ', array_merge(array(PetitionTable::KEYWORD_PERSONAL_SALUTATION, '#PLEDGE-URL#', '#DIGEST-COUNTER#', '#DIGEST-TOTAL#'), array_keys($petition->getGeoSubstFields())));
      $help = '<strong>Note:</strong> If "Digest email" is selected in the Action Settings or set by the target, this email will be sent <strong>instead</strong> of the pledge mail every once in a while and every time a certain number of people sent a pledge-request to a target. You may want to copy and paste the text from your standard pledge email, though make sure to add a short explanation that this is a "digest email". Use the keywords to show how many people have asked the target to pledge yet in total and since the last digest email. If you leave this field empty a generic text will be used (if available in the selected language).';
      $this->getWidgetSchema()->setHelp('digest_body_intro', $help . "<br /><br /><strong>Keywords:</strong> " . $subst_fields);
      $this->getWidgetSchema()->setHelp('digest_body_outro', $subst_fields);
      $this->setValidator('digest_subject', new sfValidatorString(array('required' => false, 'max_length' => 120)));
      $this->setValidator('digest_body_intro', new sfValidatorString(array('required' => false, 'max_length' => 100000)));
      $this->setValidator('digest_body_outro', new sfValidatorString(array('required' => false, 'max_length' => 100000)));
    }

    $this->setWidget('social_share_text', new sfWidgetFormInput(array('label' => 'Twitter message'), array('size' => 90, 'class' => 'large', 'placeholder' => 'Leave this field empty to use standard texts.')));
    $this->getWidgetSchema()->setHelp('social_share_text', 'Optional keywords: #TITLE#, #WIDGET-HEADING#. Keep the text short. URL is appended automatically.');
  }

  public function processValues($values) {
    $values = parent::processValues($values);
    $values = $this->processTargetSelectorValues($values);

    return $values;
  }

}
