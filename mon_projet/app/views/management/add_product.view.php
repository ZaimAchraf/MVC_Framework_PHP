<?php
    include PUBLIC_PATH . DS . 'template' . DS . 'managementHead.php';
?>

        <div class="principal">
            <div class="add_product">
                <h1>add Product</h1>
                <form method="post" action="/management/add_product" enctype="multipart/form-data">

                    <p class="error"><?php if (isset($errors['productName'])) echo '*' . $errors['productName']; ?></p>
                    <input type="text" name="productName" placeholder="Product Name" required>
                    <p class="error"> <?php if (isset($errors['price'])) echo '*' . $errors['price']; ?></p>
                    <input type="number" name="price" placeholder="price" required>

                    <textarea name="description" id="" cols="30" rows="6">product description...</textarea>

                    <p class="error" id="noCat"></p>
                    <p class="error"> <?php if (isset($errors['CatID'])) echo '*' . $errors['CatID']; ?></p>
                    <select name="CatID" id="CatID" required>
                        <option value="" disabled selected>Select Category</option>
                        <?php
                            foreach ($this->data as $cat)
                                echo "<option value='$cat->CatID'>$cat->CatName</option>";
                        ?>
                    </select><a title="add new category" href="/management/add_category">+</a>

                    <p class="error"> <?php if (isset($errors['subCatID'])) echo '*' . $errors['subCatID']; ?></p>
                    <select name="subCatID" id="subCatID" required>
                        <option value="" disabled selected>Select subCategory</option>
                    </select><a title="add new subcategory" href="/management/add_subcategory">+</a>

                    <input type="number" name="sale" placeholder="sale:0 (optional)">

                    <p class="error">
                        <?php
                            if (isset($file['errors']))
                                foreach ($errors['file'] as $error)
                                    echo '*' . $error . '</br>';
                        ?>
                    </p>
                    <label class="upload" for="product_picture"><i class="fas fa-cloud-upload-alt upload-icon"></i>Upload Pictures</label>
                    <input type="file" name="pictures[]" id="product_picture" multiple>

                    <input type="submit" name="add_product" value="ADD">
                </form>
            </div>
        </div>

    </div>

    <script src="/js/AjaxScript.js"></script>
    <script src="/js/ManagementScript.js"></script>
<?php
    include PUBLIC_PATH . DS . 'template' . DS . 'EndPage.php';
