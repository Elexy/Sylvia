<td colspan="4">
  <?php echo __('%%categoryid%% - %%parentid%% - %%public%% - %%categoryname%%', array('%%categoryid%%' => link_to($categories->getCategoryid(), 'categories_edit', $categories), '%%parentid%%' => $categories->getParentid(), '%%public%%' => $categories->getPublic(), '%%categoryname%%' => $categories->getCategoryname()), 'messages') ?>
</td>
