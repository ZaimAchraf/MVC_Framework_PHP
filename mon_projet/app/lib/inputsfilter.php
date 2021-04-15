<?php


namespace PHPMVC\Lib;


trait InputsFilter
{

    public function filterInt($data){
        return filter_var($data, FILTER_SANITIZE_NUMBER_INT);
    }

    public function filterFloat($data){
        return filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    public function filterStr($data){
        $data = filter_var($data, FILTER_SANITIZE_STRING);
        return htmlspecialchars($data);
    }

    public function filterEmail($data){
        $data = filter_var($data, FILTER_SANITIZE_EMAIL);
        return htmlspecialchars($data);
    }

}