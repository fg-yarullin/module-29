<?php $title = 'Пользователи'?>

<div class="users">
<h1><?=$title?></h1>
<p>
<table>
<thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Email</th>
        <th>Password</th>
    </tr>
</thead>
    <tbody>
        <?php foreach($data as $row): ?>
            <tr><td><?=$row['id']?></td><td><?=$row['name']?></td><td><?=$row['email']?></td><td><?=$row['password']?></td></tr>
        <?php endforeach ?>
    </tbody>
</table>
</p>
</div>