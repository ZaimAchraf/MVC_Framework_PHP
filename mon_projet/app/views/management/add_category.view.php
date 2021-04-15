<?php
    include PUBLIC_PATH . DS . 'template' . DS . 'managementHead.php';
?>
            <div class="add_product">
                <h1>add Category</h1>
                <form method="post" action="/management/add_category">

                    <p class="error"><?php if (isset($errors['catName'])) echo '*' . $errors['catName']; ?></p>
                    <p class="error"><?php if (isset($errors['exist'])) echo '*' . $errors['exist']; ?></p>
                    <input type="text" name="catName" placeholder="category Name" required>


                    <input type="submit" name="add_category" value="ADD">
                </form>
            </div>
        </div>

    </div>

<?php
include PUBLIC_PATH . DS . 'template' . DS . 'EndPage.php';
