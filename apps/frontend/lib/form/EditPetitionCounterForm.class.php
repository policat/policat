<?php
/*
 * Copyright (c) 2016, webvariants GmbH <?php Co. KG, http://www.webvariants.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

class EditPetitionCounterForm extends BasePetitionForm {

  public function configure() {
    $this->widgetSchema->setFormFormatterName('bootstrap');
    $this->widgetSchema->setNameFormat('edit_petition[%s]');

    $this->useFields(array('addnum', 'target_num', 'addnum_email_counter', 'target_num_email_counter'));

    $this->getWidgetSchema()->setLabel('addnum', 'Participant counter, manual tweak (add to counter)');
    $this->getWidget('addnum')->setAttribute('class', 'add_popover form-control');
    $this->getWidget('addnum')->setAttribute('data-content', 'Add the number of activists that have signed-on to your action in the streets or via another e-action tool. The number will be added to the live counter in all widgets of your e-action. Be honest :-)');

    $this->getWidgetSchema()->setLabel('target_num', 'Participant counter, target (instead of automatic)');
    $this->getWidget('target_num')->setAttribute('class', 'add_popover');
    $this->getWidget('target_num')->setAttribute('data-content', 'Add your action target as the number of sign-ons that you want to achieve. If you keep "0" in this field, the counter in all widgets will automatically set a motivating target – not too low, not too high – and increase the target automatically to the next level, once a level is met. We recommend keeping "0"in this field to use the automatic target setting. It\'s a fun feature :-) ');

    if (in_array($this->getObject()->getKind(), [Petition::KIND_EMAIL_TO_LIST, Petition::KIND_PLEDGE]) && $this->getObject()->getShowEmailCounter() == Petition::SHOW_EMAIL_COUNTER_YES) {
        $this->getWidgetSchema()->setLabel('addnum_email_counter', 'Email counter, manual tweak (add to counter)');
        $this->getWidget('addnum_email_counter')->setAttribute('class', 'add_popover');
        $this->getWidget('addnum_email_counter')->setAttribute('data-content', 'Add the number of sent emails to your action via another e-action tool. The number will be added to the live counter in all widgets of your e-action. Be honest :-)');

        $this->getWidgetSchema()->setLabel('target_num_email_counter', 'Email counter, target (instead of automatic)');
        $this->getWidget('target_num_email_counter')->setAttribute('class', 'add_popover');
        $this->getWidget('target_num_email_counter')->setAttribute('data-content', 'Add your email counter target as the number of sent emails that you want to achieve. If you keep "0" in this field, the counter in all widgets will automatically set a motivating target – not too low, not too high – and increase the target automatically to the next level, once a level is met. We recommend keeping "0"in this field to use the automatic target setting. It\'s a fun feature :-) ');
    } else {
        unset($this['addnum_email_counter'], $this['target_num_email_counter']);
    }
  }

}
