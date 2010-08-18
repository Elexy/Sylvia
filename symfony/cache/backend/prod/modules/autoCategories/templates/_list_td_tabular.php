<td class="sf_admin_text sf_admin_list_td_categoryid">
  <?php echo link_to($categories->getCategoryid(), 'categories_edit', $categories) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_parentid">
  <?php echo $categories->getParentid() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_public">
  <?php echo $categories->getPublic() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_categoryname">
  <?php echo $categories->getCategoryname() ?>
</td>
