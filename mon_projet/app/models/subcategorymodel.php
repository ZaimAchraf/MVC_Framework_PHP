<?php


namespace PHPMVC\Models;


class SubcategoryModel extends AbstractModel
{
    protected $subCatID;
    protected $catID;
    protected $subCatName;

    protected static $pk = 'subCatID';
    protected static $tableName = 'subcategories';
    protected static $tableSchema =
        array(

            'catID' => DATA_TYPE_INT,
            'subCatName' => DATA_TYPE_STR

        );

    function __construct($subCatName, $catID){
        $this->subCatName = $subCatName;
        $this->catID = $catID;
    }

    public function getName(){
        return $this->subCatName;
    }

    public function getID(){
        return $this->subCatID;
    }

    public function getCatID(){
        return $this->catID;
    }
}
