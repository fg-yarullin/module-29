<?php extract($data); ?>

<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger mx-5 px-5 py-3">
        <p>Your account can not be created,
        please check the following:</p>
        <ul class="m-0">
            <?php foreach($errors as $error):?>
                <li><?=$error?></li>
            <?php endforeach?>
        </ul>
    </div>
<?php endif ?>


<div class="row justify-content-center my-2">
    <div class="col-md-8" align-item-center>
        <div class="card w-100">
            <div class="card-header">
                Регистрация
            </div>  
            <div class="card-body">
                <form action="" method="post">
                    <label for="name">Your name</label>
                    <input
                        class="form-control mb-2"
                        id="name" type="text" name="user[name]"
                        value="<?=$user['name'] ?? ''?>"
                        required autocomplete="name" autofocus
                    >
                    <label for="email">Your email address</label>
                    <input
                        class="form-control mb-2"
                        id="email" type="text" name="user[email]"
                        value="<?=$user['email'] ?? $_SESSION['username'] ?? ''?>"
                        required autocomplete="email"   
                    >
                    <label for="password">Your password</label>
                    <input
                        class="form-control mb-2"
                        id="password" type="password" name="user[password]"
                        value="<?=$user['password'] ?? ''?>"
                        required autocomplete="password"
                    >
                    <label for="password_verify">Retype your password</label>
                    <input
                        class="form-control mb-4"
                        id="password_verify" type="password" name="password_verify"
                    >
                    <input class="btn btn-outline-secondary" type="submit" name="submit" value="Register account">
                </form>
            </div>
        </div>
    </div>
</div>