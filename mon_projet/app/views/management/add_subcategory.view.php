<?php
    include PUBLIC_PATH . DS . 'template' . DS . 'managementHead.php';
?>
    <div class="add_product">
        <h1>add Category</h1>
        <form method="post" action="/management/add_subcategory">

            <p class="error"><?php if (isset($errors['subCatName'])) echo '*' . $errors['subCatName']; ?></p>
            <p class="error"><?php if (isset($errors['exist'])) echo '*' . $errors['exist']; ?></p>

            <input type="text" name="subCatName" placeholder="subcategory Name" required>
            <p class="error"><?php if (isset($errors['catID'])) echo '*' . $errors['catID']; ?></p>
            <select name="catID">
                <option value="0" disabled selected>Select Category</option>
                <?php
                    foreach ($this->data as $cat)
                        echo "<option value='$cat->CatID'>$cat->CatName</option>";
                ?>
            </select><a href="/management/add_category">+</a>

            <input type="submit" name="add_subcategory" value="ADD">
        </form>
    </div>
    </div>

    </div>

<?php
include PUBLIC_PATH . DS . 'template' . DS . 'EndPage.php';
