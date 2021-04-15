<?php


namespace PHPMVC\Models;


class CategoryModel extends AbstractModel
{
    protected $CatID;
    protected $CatName;

    protected static $pk = 'catID';
    protected static $tableName = 'categories';
    protected static $tableSchema =
        array(

            'catName' => DATA_TYPE_STR

        );

    function __construct($catName){
        $this->CatName = $catName;
    }

    public function getName(){
        return $this->CatName;
    }

    public function getID(){
        return $this->CatID;
    }

}