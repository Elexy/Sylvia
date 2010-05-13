<h1>User List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Contactid</th>
      <th>Companyname</th>
      <th>Uid</th>
      <th>Pwd</th>
      <th>Email</th>
      <th>Languageid</th>
      <th>Rma</th>
      <th>Purchase</th>
      <th>Stock</th>
      <th>Logins</th>
      <th>Login attempts</th>
      <th>Passw change attempts</th>
      <th>Last online</th>
      <th>Total logins</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users_list as $users): ?>
    <tr>
      <td><a href="<?php echo url_for('user/edit?id='.$users->getId()) ?>"><?php echo $users->getId() ?></a></td>
      <td><?php echo $users->getContactid() ?></td>
      <td><?php echo $users->getCompanyname() ?></td>
      <td><?php echo $users->getUid() ?></td>
      <td><?php echo $users->getPwd() ?></td>
      <td><?php echo $users->getEmail() ?></td>
      <td><?php echo $users->getLanguageid() ?></td>
      <td><?php echo $users->getRma() ?></td>
      <td><?php echo $users->getPurchase() ?></td>
      <td><?php echo $users->getStock() ?></td>
      <td><?php echo $users->getLogins() ?></td>
      <td><?php echo $users->getLoginAttempts() ?></td>
      <td><?php echo $users->getPasswChangeAttempts() ?></td>
      <td><?php echo $users->getLastOnline() ?></td>
      <td><?php echo $users->getTotalLogins() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('user/new') ?>">New</a>
