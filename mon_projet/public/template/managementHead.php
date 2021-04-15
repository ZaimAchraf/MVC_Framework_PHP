<?php
    include PUBLIC_PATH . DS . 'template' . DS . 'headStart.php';
    global $errors;
?>

    <link rel="stylesheet" href="/css/management.css">

<?php
    include PUBLIC_PATH . DS . 'template' . DS . 'bodyStart.php';
    include PUBLIC_PATH . DS . 'template' . DS . 'nav.php';
?>

<div class="management flex">

    <div class="sideBar">
        <h3>welcome <span><?php echo $_SESSION['userName']; ?></span></h3>
        <ul>

            <li class="mg-links active">Users        </li>
            <li class="mg-links">Products     </li>
            <li class="mg-links">Comments     </li>
            <li class="mg-links">Categories   </li>
            <li class="mg-links">SubCategories</li>

        </ul>
    </div>

    <div class="principal">
