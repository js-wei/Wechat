<?php
/**
 * Created by PhpStorm.
 * User: 魏巍
 * Date: 2015/9/1
 * Time: 11:34
 */
class WxPayException extends Exception {
    public function errorMessage()
    {
        return $this->getMessage();
    }
}
