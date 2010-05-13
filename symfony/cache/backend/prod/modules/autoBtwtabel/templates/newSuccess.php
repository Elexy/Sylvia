<?php use_helper('I18N', 'Date') ?>
<?php include_partial('btwtabel/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Btwtabel', array(), 'messages') ?></h1>

  <?php include_partial('btwtabel/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('btwtabel/form_header', array('btwtabel' => $btwtabel, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('btwtabel/form', array('btwtabel' => $btwtabel, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('btwtabel/form_footer', array('btwtabel' => $btwtabel, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
