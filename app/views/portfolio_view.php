<?php $title = 'Портфолио'?>

<div class="protfolio_view">
<h1><?=$title?></h1>
<p>
<table>
<caption>Все проекты в следующей таблице являются вымышленными.</caption>
<thead>
    <tr>
        <th>Год</th>
        <th>Проект</th>
        <th>Описание</th>
    </tr>
</thead>
    <tbody>
        <?php foreach($data as $row): ?>
            <tr><td><?=$row['Year']?></td><td><?=$row['Site']?></td><td><?=$row['Description']?></td></tr>
        <?php endforeach ?>
    </tbody>
</table>
</p>
</div>