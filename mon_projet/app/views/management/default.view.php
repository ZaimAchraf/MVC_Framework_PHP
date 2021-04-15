<?php
    include PUBLIC_PATH . DS . 'template' . DS . 'managementHead.php';
    $data = $this->getData();
?>

<!----------------------------------------clients Table---------------------------------------------------------------->
            <div class="add-button"></div>
            <table class="active">
                <tr class="not"><th class="table-title" colspan="6">Users</th></tr>
                <tr class="not">
                    <th>Username</th>
                    <th>Email</th>
                    <th>Sex</th>
                    <th>Confirmed</th>
                    <th>Rank</th>
                    <th>Action</th>
                </tr>
                <?php

                    foreach ($data['users'] as $user):

                        $Rank = $user->get_groupID() == 0 ? "client" : $user->get_groupID() == 1 ? "manager" : $user->get_groupID() == 2 ? "Admin" : "";
                        $confirmed = $user->get_confirmed() == 0 ? 'No' : 'Yes';
                        $sex = $user->get_sex() == 1 ? 'Male' : 'Female';
                        echo '
                            <tr>
                                <td>' . $user->get_userName() . '</td>
                                <td>' . $user->get_email() . '</td>
                                <td>' . $sex . '</td>
                                <td>' . $confirmed . '</td>
                                <td>' . $Rank . '</td>
                                <td>
                                    <a class="delete-button" href="">Delete</a>
                                    <a class="show-button" href="">More Details</a>
                                    <a class="set-manager-button" href="">Set as manager</a>
                                </td>
                            </tr>
                        ';

                    endforeach;

                ?>


            </table>

<!----------------------------------------products table -------------------------------------------------------------->
            <div class="add-button"><a href="/management/add_product">Add Product</a></div>
            <table class="product">
                <tr class="not"><th class="table-title" colspan="7">Products</th></tr>
                <tr class="not">
                    <th>Picture    </th>
                    <th>ProductName</th>
                    <th>Price      </th>
                    <th>AddDate    </th>
                    <th>Sale       </th>
                    <th>Action     </th>
                </tr>

                <?php
                    if (!empty($data['products']))
                        foreach ($data['products'] as $product):
                            echo '
                                    <tr>
                                        <td><img src="/Uploads/Products/' . $data['pictures'][$product->get_id()][0]->get_picture() . '" alt=""></td>
                                        <td>'                             . $product->get_name()                  .          '</td>
                                        <td>'                             . $product->get_price()                 .          '</td>
                                        <td>'                             . $product->get_date()                  .          '</td>
                                        <td>'                             . $product->get_sale()                  .          '</td>
                                        <td>
                                            <a class="delete-button" href="">Delete     </a>
                                            <a class="show-button" href="">More Details </a>
                                            <a class="set-manager-button" href="">Update</a>
                                        </td>
                                    </tr>
                                ';
                        endforeach;
                ?>

            </table>

<!----------------------------------------comments table--------------------------------------------------------------->
            <div class="add-button"></div>
            <table>

            </table>

<!----------------------------------------categories table------------------------------------------------------------->
            <div class="add-button"><a href="">Add Category</a></div>
            <table>
                <tr class="not"><th class="table-title" colspan="7">Categories</th></tr>
                <tr class="not">
                    <th>Category ID    </th>
                    <th>CategoryName   </th>
                    <th>Action   </th>
                </tr>

                <?php
                if (!empty($data['categories']))
                    foreach ($data['categories'] as $category):
                        echo '
                                    <tr>
                                        <td>'                             . $category->getID()                   .          '</td>
                                        <td>'                             . $category->getName()                 .          '</td>
                                        <td>
                                            <a style="margin-left: 30px" class="delete-button" href="">Delete     </a>
                                            <a class="show-button" href="">Explore Products </a>
                                            <a class="set-manager-button" href="">Update</a>
                                        </td>
                                    </tr>
                                ';
                    endforeach;
                ?>
            </table>

<!----------------------------------------subCategories table---------------------------------------------------------->
            <div class="add-button"><a href="">Add Subcategory</a></div>
            <table>
                <tr class="not"><th class="table-title" colspan="7">Subcategories</th></tr>
                <tr class="not">
                    <th>SubCatID     </th>
                    <th>SubCatName   </th>
                    <th>Category     </th>
                    <th>Action       </th>
                </tr>

                <?php
                if (!empty($data['subcategories']))
                    foreach ($data['subcategories'] as $subcategory):
                        echo '
                                    <tr>
                                        <td>'                             . $subcategory->getID()                   .          '</td>
                                        <td>'                             . $subcategory->getName()                 .          '</td>
                                        <td>'                             . $subcategory->getCatID()                 .          '</td>
                                        <td>
                                            <a style="margin-left: 30px" class="delete-button" href="">Delete     </a>
                                            <a class="show-button" href="">Explore Products </a>
                                            <a class="set-manager-button" href="">Update</a>
                                        </td>
                                    </tr>
                                ';
                    endforeach;
                ?>
            </table>
        </div>

    </div>

    <script src="/js/ManagementScript.js"></script>

<?php
    include PUBLIC_PATH . DS . 'template' . DS . 'EndPage.php';
