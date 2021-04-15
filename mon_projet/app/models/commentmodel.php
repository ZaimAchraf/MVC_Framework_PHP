<?php


namespace PHPMVC\Models;


class CommentModel extends AbstractModel
{
    protected $catID;
    protected $catName;

    protected static $pk = 'catID';
    protected static $tableName = 'categories';
    protected static $tableSchema =
        array(

            'catName' => DATA_TYPE_STR

        );
}