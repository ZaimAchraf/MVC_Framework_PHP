<?php


namespace PHPMVC\Models;


class PictureModel extends AbstractModel
{

    protected $productID;
    protected $picture;

    protected static $pk = 'picture';
    protected static $tableName = 'pictures';
    protected static $tableSchema =
        array(

            'productID' => DATA_TYPE_STR,
            'picture' => DATA_TYPE_STR

        );

    function __construct($productID, $picture)
    {
        $this->productID   = $productID;
        $this->picture = $picture;
    }

    public function get_picture()
    {
        return $this->picture;
    }
}