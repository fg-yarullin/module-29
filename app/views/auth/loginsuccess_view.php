<h2>Login Successful</h2>
<p>You are now logged in.</p>

<?php if(1 == 1):?>
    <div class="my-3">
        <img class="main_view_img" src="/images/butterfly.jpg">
        <?php var_dump($_POST); ?>
        <?php var_dump($_SESSION); ?>
    </div>
<?php endif?>