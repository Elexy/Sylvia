<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<form action="<?php echo url_for('genuser/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields() ?>
          &nbsp;<a href="<?php echo url_for('genuser/index') ?>">Cancel</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'genuser/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
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
        <th><?php echo $form['raccess_s']->renderLabel() ?></th>
        <td>
          <?php echo $form['raccess_s']->renderError() ?>
          <?php echo $form['raccess_s'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['raccess_a']->renderLabel() ?></th>
        <td>
          <?php echo $form['raccess_a']->renderError() ?>
          <?php echo $form['raccess_a'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['raccess_v']->renderLabel() ?></th>
        <td>
          <?php echo $form['raccess_v']->renderError() ?>
          <?php echo $form['raccess_v'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['raccess_r']->renderLabel() ?></th>
        <td>
          <?php echo $form['raccess_r']->renderError() ?>
          <?php echo $form['raccess_r'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['waccess_s']->renderLabel() ?></th>
        <td>
          <?php echo $form['waccess_s']->renderError() ?>
          <?php echo $form['waccess_s'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['waccess_a']->renderLabel() ?></th>
        <td>
          <?php echo $form['waccess_a']->renderError() ?>
          <?php echo $form['waccess_a'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['waccess_v']->renderLabel() ?></th>
        <td>
          <?php echo $form['waccess_v']->renderError() ?>
          <?php echo $form['waccess_v'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['waccess_r']->renderLabel() ?></th>
        <td>
          <?php echo $form['waccess_r']->renderError() ?>
          <?php echo $form['waccess_r'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['saccess_s']->renderLabel() ?></th>
        <td>
          <?php echo $form['saccess_s']->renderError() ?>
          <?php echo $form['saccess_s'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['saccess_a']->renderLabel() ?></th>
        <td>
          <?php echo $form['saccess_a']->renderError() ?>
          <?php echo $form['saccess_a'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['saccess_v']->renderLabel() ?></th>
        <td>
          <?php echo $form['saccess_v']->renderError() ?>
          <?php echo $form['saccess_v'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['saccess_r']->renderLabel() ?></th>
        <td>
          <?php echo $form['saccess_r']->renderError() ?>
          <?php echo $form['saccess_r'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['supervisor']->renderLabel() ?></th>
        <td>
          <?php echo $form['supervisor']->renderError() ?>
          <?php echo $form['supervisor'] ?>
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
        <th><?php echo $form['logon_attempts']->renderLabel() ?></th>
        <td>
          <?php echo $form['logon_attempts']->renderError() ?>
          <?php echo $form['logon_attempts'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['active']->renderLabel() ?></th>
        <td>
          <?php echo $form['active']->renderError() ?>
          <?php echo $form['active'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['stylesheetid']->renderLabel() ?></th>
        <td>
          <?php echo $form['stylesheetid']->renderError() ?>
          <?php echo $form['stylesheetid'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['deflanguage']->renderLabel() ?></th>
        <td>
          <?php echo $form['deflanguage']->renderError() ?>
          <?php echo $form['deflanguage'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['contactid']->renderLabel() ?></th>
        <td>
          <?php echo $form['contactid']->renderError() ?>
          <?php echo $form['contactid'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['employee_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['employee_id']->renderError() ?>
          <?php echo $form['employee_id'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
