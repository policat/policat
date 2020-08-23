<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo url_for('dashboard') ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?php echo url_for('campaign_edit_', array('id' => $campaign->getId())) ?>"><?php echo $campaign->getName() ?></a></li>
    <li class="breadcrumb-item active">Order</li>
  </ol>
</nav>
<h2>Order for Campaign <?php echo $campaign->getName() ?></h2>
<form class="ajax_form form-horizontal" action="<?php echo url_for('order_new', array('id' => $campaign->getId())) ?>" method="post">
    <legend>Select a package</legend>
    <?php echo $form->renderRows(array('product')) ?>
    <div class="neworder__block--autorenew">
      <?php echo $form->renderRows(array('autorenewal')) ?>
      <p>
        Buy your package with auto-renewal to ensure that your actions continue if your package expires or if you run out of credit. You will get a notification a few days before your package expires or runs out of credit and a new package order (of the same size) will be created. Make sure to pay online or let us know if your bank transfer is delayed.
      </p>
    </div>
    <legend>Billing address</legend>
    <?php echo $form->renderOtherRows(); echo $form->renderHiddenFields() ?>
    <div class="form-actions">
        <button class="btn btn-primary">Order now</button>
        <a class="btn btn-secondary submit" data-submit='<?php echo json_encode(array('offer' => 1)) ?>'>Print offer</a>
        <a class="btn btn-secondary" href="<?php echo url_for('quota_list', array('id' => $campaign->getId())) ?>" >Cancel</a>
    </div>
</form>
