<?php use_helper('I18N', 'Date') ?>
<?php include_partial('brand/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Edit Brand', array(), 'messages') ?></h1>

  <?php include_partial('brand/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('brand/form_header', array('brand' => $brand, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('brand/form', array('brand' => $brand, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('brand/form_footer', array('brand' => $brand, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
