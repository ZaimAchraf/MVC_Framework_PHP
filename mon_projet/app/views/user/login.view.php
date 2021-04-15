<?php
    include PUBLIC_PATH . DS . 'template' . DS . 'headStart.php';
    global $errors;
?>

    <link rel="stylesheet" href="/css/Login_SignIn_Style.css">

<?php
    include PUBLIC_PATH . DS . 'template' . DS . 'bodyStart.php';
    include PUBLIC_PATH . DS . 'template' . DS . 'nav.php';
?>

    <div class="login">
        <h1>LogIn</h1>
        <div class="login_form">
            <form method="post" action="/user/login">
                <p class="error"><?php if (isset($errors['not_exist'])) echo '*' . $errors['not_exist']; ?></p>
                <p class="error"><?php if (isset($errors['email'])) echo '*' . $errors['email']; ?></p>
                <input name="email" type="email" placeholder="E-mail">
                <p class="error"><?php if (isset($errors['password'])) echo '*' . $errors['password']; ?></p>
                <input name="password" type="password" placeholder="Password">
                <input type="submit" value="LogIn" name="login">
                <a href="">Forgot password ?</a></br>
                <a href="/user/signin">Create new account...</a>
            </form>
        </div>
    </div>

<?php
    include PUBLIC_PATH . DS . 'template' . DS . 'EndPage.php';
