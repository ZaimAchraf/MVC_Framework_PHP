<?php


namespace PHPMVC\Models;


class ProductModel extends AbstractModel
{

    protected $productID;
    protected $productName;
    protected $description;
    protected $price;
    protected $subCatID;
    protected $addDate;
    protected $sale;

    protected static $pk = 'productID';
    protected static $tableName = 'products';
    protected static $tableSchema =
        array(

            'productID' => DATA_TYPE_STR,
            'productName' => DATA_TYPE_STR,
            'description' => DATA_TYPE_STR,
            'price' => DATA_TYPE_FLOAT,
            'subCatID' => DATA_TYPE_STR,
            'addDate' => DATA_TYPE_STR,
            'sale' => DATA_TYPE_FLOAT

        );

    function __construct($productID, $productName, $description, $price, $subCatID, $sale)
    {
        $this->productID   = $productID;
        $this->productName = $productName;
        $this->description = $description;
        $this->price       = $price;
        $this->subCatID    = $subCatID;
        $this->addDate     = date('Y-m-d');
        $this->sale        = $sale;
    }

    public function get_name()
    {
        return $this->productName;
    }

    public function get_id()
    {
        return $this->productID;
    }

    public function get_description()
    {
        return $this->description;
    }

    public function get_price()
    {
        return $this->price;
    }

    public function get_subCat()
    {
        return $this->subCatID;
    }

    public function get_date()
    {
        return $this->addDate;
    }

    public function get_sale()
    {
        return $this->sale;
    }

}