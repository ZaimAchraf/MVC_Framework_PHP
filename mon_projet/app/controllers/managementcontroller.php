<?php


namespace PHPMVC\Controllers;


use PHPMVC\Lib\Helper;
use PHPMVC\Models\CategoryModel;
use PHPMVC\Lib\inputsfilter;
use PHPMVC\Models\CommentModel;
use PHPMVC\Models\PictureModel;
use PHPMVC\Models\ProductModel;
use PHPMVC\Models\SubcategoryModel;
use PHPMVC\Models\UserModel;

class ManagementController extends AbstractController
{
    use InputsFilter;
    use Helper;

    function __construct($cont, $act, $pars)
    {
        parent::__construct($cont, $act, $pars);
        if (!isset($_SESSION['userID']) || !isset($_SESSION['groupID']) || $_SESSION['groupID'] < 1 || $_SESSION['groupID'] > 2){
            $this->redirect('/notfound');
        }
    }

    public function defaultAction()
    {
        if (!isset($_SESSION['userID']) || $_SESSION['groupID'] < 1 || $_SESSION['groupID'] > 2)
            $this->redirect('/notfound');

        $data['categories']    = CategoryModel::getAll();
        $data['users']         = UserModel::getAll();
        $data['products']      = ProductModel::getAll();
//        $data['comments']      = CommentModel::getAll();
        $data['subcategories'] = SubcategoryModel::getAll();
//        $data['pictures']      = PictureModel::getAll();


        if (!empty($data['products']))
            foreach ($data['products'] as $product){
                $data['pictures'][$product->get_id()] =  PictureModel::getByAllColumns(array(
                    'productID' => $product->get_id()
                )) ;
            }

        $this->setData($data);
        $this->view();
    }

    public function add_productAction()
    {
        global $errors;

        if (!isset($_SESSION['userID']) || $_SESSION['groupID'] < 1 || $_SESSION['groupID'] > 2)
            $this->redirect('/notfound');

        if (isset($_POST['add_product'])){

            $requiredData['productName'] = $productName = $this->filterStr($_POST['productName']);
            $requiredData['price']       = $price       = $this->filterFloat($_POST['price']);
            $requiredData['subCatID']    = $subCatID    = isset($_POST['subCatID']) ? $this->filterInt($_POST['subCatID']) : '';
            $requiredData['CatID']       = $subCatID    = isset($_POST['CatID'])    ? $this->filterInt($_POST['CatID'])    : '';

            $errors = $this->checkRequiredInputs($requiredData);

            $files = $this->UploadFile('Products', $productName);

            if (empty($errors) && !empty($files['uploaded'])){
                $description = $this->filterInt($_POST['description']);
                $sale       = $this->filterInt($_POST['sale']);
                $productID = uniqid($productName);
                $product = new ProductModel($productID, $productName, $description, $price, $subCatID, $sale);
                $product->register();

                foreach ($files['uploaded'] as $file){
                    $picture = new PictureModel($productID, $file);
                    $picture->register();
                }

            }
        }

        $categories = CategoryModel::getAll();
        $this->setData($categories);
        $this->view();
    }

    public function delete_productAction()
    {
        if (!isset($_SESSION['userID']) || $_SESSION['groupID'] < 1 || $_SESSION['groupID'] > 2)
            $this->redirect('/notfound');

        if (isset($_SERVER['HTTP_REFERER']) && parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) == 'www.exemple.com' && isset($this->params[0])){

            $id = $this->filterStr($this->params[0]);
            PictureModel::deleteByPk($id);
            $this->redirect('/management');
        }

    }

    public function add_categoryAction()
    {
        global $errors;
        if (!isset($_SESSION['userID']) || $_SESSION['groupID'] < 1 || $_SESSION['groupID'] > 2)
            $this->redirect('/notfound');

        if (isset($_POST['add_category'])){

            $catName = $this->filterStr($_POST['catName']);

            $requiredData['catName'] = $catName;
            $errors = $this->checkRequiredInputs($requiredData);

            if (CategoryModel::getByColumns($requiredData))
                $errors['exist'] = 'this category already exists';

            if (empty($errors)){
                $catName = $this->filterStr($_POST['catName']);
                $cat     = new CategoryModel($catName);
                $cat->register();
            }
        }
        $this->view();
    }

    public function add_subcategoryAction()
    {
        global $errors;

        if (!isset($_SESSION['userID']) || $_SESSION['groupID'] < 1 || $_SESSION['groupID'] > 2)
            $this->redirect('/notfound');

        if (isset($_POST['add_subcategory'])){

            $subCatName = $this->filterStr($_POST['subCatName']);
            $catID = $this->filterInt($_POST['catID']);

            $requiredData['subCatName'] = $subCatName;
            $requireData['catID']       = $catID;

            $errors = $this->checkRequiredInputs($requiredData);

            if (SubcategoryModel::getByAllColumns($requireData))
                $errors['exist'] = 'this subcategory already exists in the category specified';

            if (empty($errors)){
                $cat = new SubcategoryModel($subCatName, $catID);
                $cat->register();
            }
        }
        $categories = CategoryModel::getAll();
        $this->setData($categories);
        $this->view();
    }
}