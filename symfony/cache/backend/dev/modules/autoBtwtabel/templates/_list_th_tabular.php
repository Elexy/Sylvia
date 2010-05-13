<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_btw_class">
  <?php if ('btw_class' == $sort[0]): ?>
    <?php echo link_to(__('Btw class', array(), 'messages'), 'btwtabel', array(), array('query_string' => 'sort=btw_class&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Btw class', array(), 'messages'), 'btwtabel', array(), array('query_string' => 'sort=btw_class&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_btwpercentage">
  <?php if ('btwpercentage' == $sort[0]): ?>
    <?php echo link_to(__('Btwpercentage', array(), 'messages'), 'btwtabel', array(), array('query_string' => 'sort=btwpercentage&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Btwpercentage', array(), 'messages'), 'btwtabel', array(), array('query_string' => 'sort=btwpercentage&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>