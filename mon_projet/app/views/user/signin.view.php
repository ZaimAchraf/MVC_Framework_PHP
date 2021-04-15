<?php
    include PUBLIC_PATH . DS . 'template' . DS . 'headStart.php';
    global $errors;
?>

    <link rel="stylesheet" href="/css/Login_SignIn_Style.css">

<?php
    include PUBLIC_PATH . DS . 'template' . DS . 'bodyStart.php';
    include PUBLIC_PATH . DS . 'template' . DS . 'nav.php';
?>

    <div class="signIn">
        <h1>Sign In</h1>
        <form method="post" action="/user/signin">

            <fieldset>

                <legend>Personal infos</legend>

                <?php if (isset($errors['exist'])) echo '<p class="error">*' . $errors['exist'] . '</p>'; ?>
                <p class="error"><?php if (isset($errors['fullname'])) echo '*' . $errors['fullname']; ?></p>
                <p class="error"> <?php if (isset($errors['username'])) echo '*' . $errors['username']; ?></p>
                <input type="text" name="fullname" placeholder="Full name" required>
                <input type="text" name="username" placeholder="Username" required>

                <p class="error"> <?php if (isset($errors['email'])) echo '*' . $errors['email']; ?></p>
                <p class="error"> <?php if (isset($errors['password'])) echo '*' . $errors['password']; ?></p>
                <input type="text" name="email" placeholder="E-mail" required>
                <input type="password" name="password1" placeholder="Password" required>

                <p class="error">
                    <?php
                        if (isset($errors['confirm_password'])) echo '*' . $errors['confirm_password'];
                        if (isset($errors['verify'])) echo '*' . $errors['verify']; ?>
                </p>
                <p class="error"> <?php if (isset($errors['sex'])) echo '*' . $errors['sex']; ?></p>
                <input type="password" name="password2" placeholder="Confirm password" required>
                <select name="sex" id="sex" required>
                    <option value="" disabled selected>Select your sex</option>
                    <option value="1">male</option>
                    <option value="0">female</option>
                </select>

                <input type="date" name="birthDay" required>
            </fieldset>

            <fieldset>
                <legend>Contact infos <span>(optional)</span></legend>
                <input type="number" name="phone" placeholder="Phone number">
                <input type="text" name="city" placeholder="Ville">
                <input type="number" name="postal" placeholder="Postal code">
                <input type="text" name="adress" placeholder="Adress">
            </fieldset>

            <input type="submit" name="sign_in" value="Sign In">


        </form>
    </div>


<?php
    include PUBLIC_PATH . DS . 'template' . DS . 'EndPage.php';

