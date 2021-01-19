<?php $petition = $form->getObject() ?>
<form id="petition_edit_form" class="ajax_form form-horizontal" action="<?php echo url_for('petition_edit_', array('id' => $form->getObject()->getId())) ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" href="#sec1" data-toggle="tab">Basic settings</a>
                <?php if ($petition->getKind() == Petition::KIND_OPENECI): ?>
                <a class="nav-link" href="#openeci" data-toggle="tab">openECI</a>
                <?php endif ?>
                <a class="nav-link" href="#sec2" data-toggle="tab">Sign-up data</a>
                <a class="nav-link" href="#sec3" data-toggle="tab">Emails</a>
                <a class="nav-link" href="#sec4" data-toggle="tab">Donations (optional)</a>
                <a class="nav-link" href="#sec5" data-toggle="tab">Promote your e-action</a>
                <a class="nav-link" href="#sec6" data-toggle="tab">Widgets</a>
                <?php if ($petition->getKind() == Petition::KIND_PLEDGE): ?>
                  <a class="nav-link" href="#sec7" data-toggle="tab">Pledge Settings</a>
                <?php endif ?>
                <?php if (isset($form['privacy_policy_by_widget_data_owner'])): ?>
                  <a class="nav-link" href="#sec8" data-toggle="tab">DPO settings</a>
                <?php endif ?>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content popovers_left" id="v-pills-tabContent">
                <fieldset class="tab-pane fade show active tab-pane active show-before-chosen-init" id="sec1">
                    <legend>Basic settings</legend>
                    <div class="control-group">
                        <label class="control-label">
                            E-action type
                        </label>
                        <div class="controls">
                            <span class="widget_text"><?php echo $petition->getKindName() ?></span>
                        </div>
                    </div>
                    <?php echo $form->renderRows('status', 'start_at', 'end_at', 'name', '*editable') ?>
                    <fieldset>
                        <?php if ($petition->isEmailKind() && !$petition->isGeoKind()): ?><legend>Recipient(s) of the email action (your campaign targets)</legend><?php endif ?>
                        <?php echo $form->renderRows('*email_target_name_1', '*email_target_email_1', '*email_target_name_2', '*email_target_email_2', '*email_target_name_3', '*email_target_email_3') ?>
                    </fieldset>
                    <?php echo $form->renderRows('*label_mode', 'read_more_url') ?>
                </fieldset>
                <?php if ($petition->getKind() == Petition::KIND_OPENECI): ?>
                <fieldset class="tab-pane show-before-chosen-init" id="openeci">
                    <legend>openECI</legend>
                    <?php echo $form->renderRows('openeci_url', 'openeci_channel', 'openeci_counter_override', 'openeci_skip_first_step') ?>
                </fieldset>
                <?php endif ?>
                <fieldset class="tab-pane show-before-chosen-init" id="sec2">
                    <legend>Sign-up data</legend>
                    <p class="alert alert-danger">If you make changes here for a running action you may lose data if you remove fields.</p>
                    <div class="global_error">
                        <span id="new_petition_customise"></span>
                    </div>
                    <?php echo $form->renderRows('titletype', 'nametype', 'with_address', 'with_country', 'default_country', 'country_collection_id', 'with_comments', 'with_extra1', 'with_extra2', 'with_extra3', 'policy_checkbox', 'subscribe_default') ?>
                </fieldset>
                <fieldset class="tab-pane show-before-chosen-init" id="sec3">
                    <legend>Emails</legend>
                    <?php echo $form->renderRows('from_name', 'from_email') ?>
                    <?php echo $form->renderRows('*validation_required', 'landing_url', 'thank_you_email', 'email_button_color') ?>
                </fieldset>
                <fieldset class="tab-pane show-before-chosen-init" id="sec4">
                    <legend>Donations (optional)</legend>
                    <?php echo $form->renderRows('*paypal_email', 'donate_url', 'donate_widget_edit') ?>
                </fieldset>
                <fieldset class="tab-pane show-before-chosen-init" id="sec5">
                    <legend>Promote your e-action</legend>
                    <?php echo $form->renderRows('homepage', 'twitter_tags') ?>
                </fieldset>
                <fieldset class="tab-pane show-before-chosen-init" id="sec6">
                    <legend>Widgets</legend>
                    <?php echo $form->renderRows('widget_individualise', 'themeId', 'style_font_family') ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $form->renderRows('style_bg_right_color', 'style_bg_left_color', 'style_button_primary_color', 'style_button_color') ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $form->renderRows('style_title_color', 'style_form_title_color', 'style_body_color', 'style_label_color') ?>
                        </div>
                    </div>
                    <?php echo $form->renderRows('share', 'show_embed', 'key_visual', 'show_target', 'show_email_counter*', 'show_keyvisual', 'last_signings') ?>
                    <div id="last-signings-options" class="show-before-chosen-init">
                        <?php echo $form->renderRows('last_signings_city', 'last_signings_country') ?>
                    </div>
                </fieldset>
                <?php if ($petition->getKind() == Petition::KIND_PLEDGE): ?>
                  <fieldset class="tab-pane show-before-chosen-init" id="sec7">
                      <legend>Pledge Settings</legend>
                      <?php echo $form->renderRows('pledge_with_comments', 'pledge_header_visual', 'pledge_key_visual', 'pledge_background_color', 'pledge_color', 'pledge_head_color', 'pledge_font', 'pledge_info_columns_comma', 'pledge_sort_column', 'digest_enabled') ?>
                  </fieldset>
                <?php endif ?>
                <?php if (isset($form['privacy_policy_by_widget_data_owner'])): ?>
                  <fieldset class="tab-pane show-before-chosen-init" id="sec8">
                      <legend>Data protection officer settings</legend>
                      <?php echo $form->renderRows('*privacy_policy_by_widget_data_owner') ?>
                  </fieldset>
                <?php endif ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            &nbsp;
            <?php echo $form->renderHiddenFields() ?>
        </div>
        <div class="col-md-9">
            <div class="form-actions">
                <button accesskey="s" title="[Accesskey] + S" class="btn btn-primary" type="submit">Save</button>
                <?php if ($petition->isGeoKind()): ?>
                  <a class="btn submit btn-secondary" data-submit='{"go_target":1}'>Save &amp; select target list</a>
                <?php elseif ($petition->getKind() == Petition::KIND_PLEDGE): ?>
                  <a class="btn submit btn-secondary" data-submit='{"go_pledge":1}'>Save &amp; define pledges</a>
                <?php else: ?>
                  <a class="btn submit btn-secondary" data-submit='{"go_translation":1}'>Save &amp; go to actions texts and translations</a>
                <?php endif ?>
            </div>
        </div>
    </div>
</form>
