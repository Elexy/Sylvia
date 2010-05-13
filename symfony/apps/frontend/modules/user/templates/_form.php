<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<form action="<?php echo url_for('user/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields() ?>
          &nbsp;<a href="<?php echo url_for('user/index') ?>">Cancel</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'user/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['contactid']->renderLabel() ?></th>
        <td>
          <?php echo $form['contactid']->renderError() ?>
          <?php echo $form['contactid'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['companyname']->renderLabel() ?></th>
        <td>
          <?php echo $form['companyname']->renderError() ?>
          <?php echo $form['companyname'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['uid']->renderLabel() ?></th>
        <td>
          <?php echo $form['uid']->renderError() ?>
          <?php echo $form['uid'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['pwd']->renderLabel() ?></th>
        <td>
          <?php echo $form['pwd']->renderError() ?>
          <?php echo $form['pwd'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['email']->renderLabel() ?></th>
        <td>
          <?php echo $form['email']->renderError() ?>
          <?php echo $form['email'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['languageid']->renderLabel() ?></th>
        <td>
          <?php echo $form['languageid']->renderError() ?>
          <?php echo $form['languageid'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['rma']->renderLabel() ?></th>
        <td>
          <?php echo $form['rma']->renderError() ?>
          <?php echo $form['rma'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['purchase']->renderLabel() ?></th>
        <td>
          <?php echo $form['purchase']->renderError() ?>
          <?php echo $form['purchase'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['stock']->renderLabel() ?></th>
        <td>
          <?php echo $form['stock']->renderError() ?>
          <?php echo $form['stock'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['logins']->renderLabel() ?></th>
        <td>
          <?php echo $form['logins']->renderError() ?>
          <?php echo $form['logins'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['login_attempts']->renderLabel() ?></th>
        <td>
          <?php echo $form['login_attempts']->renderError() ?>
          <?php echo $form['login_attempts'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['passw_change_attempts']->renderLabel() ?></th>
        <td>
          <?php echo $form['passw_change_attempts']->renderError() ?>
          <?php echo $form['passw_change_attempts'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['last_online']->renderLabel() ?></th>
        <td>
          <?php echo $form['last_online']->renderError() ?>
          <?php echo $form['last_online'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['total_logins']->renderLabel() ?></th>
        <td>
          <?php echo $form['total_logins']->renderError() ?>
          <?php echo $form['total_logins'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
