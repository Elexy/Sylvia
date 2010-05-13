<h1>Genuser List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Uid</th>
      <th>Pwd</th>
      <th>Raccess s</th>
      <th>Raccess a</th>
      <th>Raccess v</th>
      <th>Raccess r</th>
      <th>Waccess s</th>
      <th>Waccess a</th>
      <th>Waccess v</th>
      <th>Waccess r</th>
      <th>Saccess s</th>
      <th>Saccess a</th>
      <th>Saccess v</th>
      <th>Saccess r</th>
      <th>Supervisor</th>
      <th>Email</th>
      <th>Logon attempts</th>
      <th>Active</th>
      <th>Stylesheetid</th>
      <th>Deflanguage</th>
      <th>Contactid</th>
      <th>Employee</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($genuser_list as $genuser): ?>
    <tr>
      <td><a href="<?php echo url_for('genuser/edit?id='.$genuser->getId()) ?>"><?php echo $genuser->getId() ?></a></td>
      <td><?php echo $genuser->getUid() ?></td>
      <td><?php echo $genuser->getPwd() ?></td>
      <td><?php echo $genuser->getRaccessS() ?></td>
      <td><?php echo $genuser->getRaccessA() ?></td>
      <td><?php echo $genuser->getRaccessV() ?></td>
      <td><?php echo $genuser->getRaccessR() ?></td>
      <td><?php echo $genuser->getWaccessS() ?></td>
      <td><?php echo $genuser->getWaccessA() ?></td>
      <td><?php echo $genuser->getWaccessV() ?></td>
      <td><?php echo $genuser->getWaccessR() ?></td>
      <td><?php echo $genuser->getSaccessS() ?></td>
      <td><?php echo $genuser->getSaccessA() ?></td>
      <td><?php echo $genuser->getSaccessV() ?></td>
      <td><?php echo $genuser->getSaccessR() ?></td>
      <td><?php echo $genuser->getSupervisor() ?></td>
      <td><?php echo $genuser->getEmail() ?></td>
      <td><?php echo $genuser->getLogonAttempts() ?></td>
      <td><?php echo $genuser->getActive() ?></td>
      <td><?php echo $genuser->getStylesheetid() ?></td>
      <td><?php echo $genuser->getDeflanguage() ?></td>
      <td><?php echo $genuser->getContactid() ?></td>
      <td><?php echo $genuser->getEmployeeId() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('genuser/new') ?>">New</a>
