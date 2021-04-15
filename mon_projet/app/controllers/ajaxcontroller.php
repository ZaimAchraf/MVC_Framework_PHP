<?php


namespace PHPMVC\Controllers;


use PHPMVC\Lib\Helper;
use PHPMVC\Lib\InputsFilter;
use PHPMVC\Models\SubcategoryModel;

class AjaxController extends AbstractController
{
    use InputsFilter;
    use Helper;

//    function __construct($cont, $act, $pars)
//    {
//        parent::__construct($cont, $act, $pars);
//        if (!isset($_POST['ajax']))
//            $this->redirect('/notfound');
//    }

    public function getSubcategoriesOptionsAction()
    {
        echo 'hey';

        if (!isset($_POST['CatID']))
            $this->redirect('/notfound');


        echo '<option value="" disabled selected>Select subCategory</option>';
        if ($subcategories = SubcategoryModel::getByAllColumns(array(
            'catID' => $_POST['CatID']
        )))
            foreach ($subcategories as $subcategory)
            {
                echo '
                    <option value="' . $subcategory->getID() .'"> ' . $subcategory->getName() . '</option>
                ';
            }

    }
}