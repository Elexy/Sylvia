<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_categoryid">
  <?php if ('categoryid' == $sort[0]): ?>
    <?php echo link_to(__('Categoryid', array(), 'messages'), '@categories', array('query_string' => 'sort=categoryid&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Categoryid', array(), 'messages'), '@categories', array('query_string' => 'sort=categoryid&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_parentid">
  <?php if ('parentid' == $sort[0]): ?>
    <?php echo link_to(__('Parentid', array(), 'messages'), '@categories', array('query_string' => 'sort=parentid&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Parentid', array(), 'messages'), '@categories', array('query_string' => 'sort=parentid&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_public">
  <?php if ('public' == $sort[0]): ?>
    <?php echo link_to(__('Public', array(), 'messages'), '@categories', array('query_string' => 'sort=public&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Public', array(), 'messages'), '@categories', array('query_string' => 'sort=public&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_categoryname">
  <?php if ('categoryname' == $sort[0]): ?>
    <?php echo link_to(__('Categoryname', array(), 'messages'), '@categories', array('query_string' => 'sort=categoryname&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Categoryname', array(), 'messages'), '@categories', array('query_string' => 'sort=categoryname&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>