<?php use_helper('I18N', 'Date') ?>
<?php include_partial('categories/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Categories', array(), 'messages') ?></h1>

  <?php include_partial('categories/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('categories/form_header', array('categories' => $categories, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('categories/form', array('categories' => $categories, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('categories/form_footer', array('categories' => $categories, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
