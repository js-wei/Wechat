<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/1
 * Time: 13:03
 */
class UnifiedOrder{
    public  $body;
    public function setBody($body){
        $this->body=$body;
    }
    public  $attach;
    public function setAttach($attach){
        $this->attach=$attach;
    }
    public  $out_trade_no;
    public function SetOut_trade_no($out_trade_no){
        $this->out_trade_no=$out_trade_no;
    }
    public  $total_fee;
    public function SetTotal_fee($total_fee){
        $this->total_fee=$total_fee;
    }
    public  $time_start;
    public function SetTime_start($time_start){
        $this->time_start=$time_start;
    }
    public  $time_expire;
    public function SetTime_expire($time_expire){
        $this->time_expire=$time_expire;
    }
    public  $goods_tag;
    public function SetGoods_tag($goods_tag){
        $this->goods_tag=$goods_tag;
    }
    public  $notify_url;
    public function SetNotify_url($notify_url){
        $this->notify_url=$notify_url;
    }
    public  $trade_type;
    public function SetTrade_type($trade_type){
        $this->trade_type=$trade_type;
    }
    public  $product_id;
    public function SetProduct_id($product_id){
        $this->product_id=$product_id;
    }
    public  $appid;
    public function SetAppid($appid){
        $this->$appid=$appid;
    }
    public function IsOut_trade_noSet(){
        return !empty($this->out_trade_no)?1:0;
    }

    public function IsBodySet(){
        return !empty($this->body)?1:0;
    }

    public function IsTotal_feeSet(){
        return !empty($this->total_fee)?1:0;
    }

    public function IsTrade_typeSet(){
        return !empty($this->trade_type)?1:0;
    }
    public  function  IsProduct_idSet(){
        return !empty($this->product_id)?1:0;
    }
    public  function  IsNotify_urlSet(){
        return !empty($this->notify_url)?1:0;
    }

    public function GetTrade_type(){
        return $this->trade_type;
    }



}