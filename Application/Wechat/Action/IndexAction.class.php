<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Wechat\Action;
use Think\Action;
use WechatApi\Wechat;
use WechatApi\WechatType;
use Service\BaiduVoice;

class IndexAction extends Action{
    /**
     * 微信消息接口入口
     * 所有发送到微信的消息都会推送到该操作
     * 所以，微信公众平台后台填写的api地址则为该操作的访问地址
     */
    public function index($id = ''){
        header('Content-Type:text/html;charset=utf-8;');
        $wechat = new Wechat();


       /*$buttons=array(
            'button'=>array(
                    array(
                        'type'=>WechatType::$MENU_TYPE_CLICK,
                        'name'=>'今日歌曲',
                        'key'=>'V1001_TODAY_MUSIC'
                    ),
                    array(
                        'type'=>WechatType::$MENU_TYPE_VIEW,
                        'name'=>'搜索',
                        'url'=>'http://www.sogou.com/'
                    ),
                    array(
                        'type'=>WechatType::$MENU_TYPE_VIEW,
                        'name'=>'视频',
                        'url'=>'http://v.qq.com'
                    ),
                    array(
                        'type'=>WechatType::$MENU_TYPE_SCANCODE_WAITNSG,
                        'name'=>'扫码带提示',
                        'key'=>'rselfmenu_0_0', 
                        'sub_button'=>array()
                    ),
                    array(
                        'type'=>WechatType::$MENU_TYPE_SCANCODE_PUSH,
                        'name'=>'扫码推事件',
                        'key'=>'rselfmenu_0_1', 
                        'sub_button'=>array()
                    )
                ),
            );*/
      //$logHandler= new CLogHandler("./logs/".date('Y-m-d').'.log');
      //Logs::Init($logHandler, 15);
      //Logs::INFO('文本信息:'.json_encode($buttons));
    }
}