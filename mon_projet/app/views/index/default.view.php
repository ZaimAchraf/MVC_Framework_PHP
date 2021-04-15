<?php
include "template/headStart.php";

?>
    <link rel="stylesheet" href="/css/Home_Style.css">
        <?php

            include PUBLIC_PATH . DS . 'template' . DS . 'bodyStart.php';
            include PUBLIC_PATH . DS . 'template' . DS . 'nav.php';

        ?>

        <div class="header">
            <div class="slider1 slider active"></div>
            <div class="slider2 slider"></div>
            <div class="slider3 slider"></div>
            <div class="pagination">
                <ul>
                    <li class="active"></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
        </div>

        <div class="contact-button flex">
            <a href="" class="flex">
                <span>Contact Us!</span>
                <span><i class="far fa-comment-alt"></i></span>
            </a>

        </div>


        <script src="/js/HomeScript.js"></script>

<?php
    include PUBLIC_PATH . DS . 'template' . DS . 'EndPage.php';


