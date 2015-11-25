<?php
namespace WechatApi;
/**
* 
*/
class  WechatType{
	/**
	 * 消息类型常量
	 */
	static  $MSG_TYPE_TEXT       = 'text';
	static  $MSG_TYPE_IMAGE      = 'image';
	static  $MSG_TYPE_VOICE      = 'voice';
	static  $MSG_TYPE_VIDEO      = 'video';
	static  $MSG_TYPE_SHORTVIDEO = 'shortvideo';
	static  $MSG_TYPE_LOCATION   = 'location';
	static  $MSG_TYPE_LINK       = 'link';
	static  $MSG_TYPE_MUSIC      = 'music';
	static  $MSG_TYPE_NEWS       = 'news';
	static  $MSG_TYPE_EVENT      = 'event';

	/**
	 * 事件类型常量
	 */
	static $MSG_EVENT_SUBSCRIBE   = 'subscribe';
	static $MSG_EVENT_UNSUBSCRIBE = 'unsubscribe';
	static $MSG_EVENT_SCAN        = 'SCAN';
	static $MSG_EVENT_LOCATION    = 'LOCATION';
	static $MSG_EVENT_CLICK       = 'CLICK';
	static $MSG_EVENT_VIEW        = 'VIEW';

	/**
	 * 菜单类型
	 */
    static $MENU_TYPE_CLICK     = 'click';
    static $MENU_TYPE_VIEW     = 'view';
    static $MENU_TYPE_SCANCODE_PUSH     = 'scancode_push';
    static $MENU_TYPE_SCANCODE_WAITNSG     = 'scancode_waitmsg';
    static $MENU_TYPE_PIC_SYSPHOTO     = 'pic_sysphoto';
    static $MENU_TYPE_PIC_PHOTO_OR_ALBUM     = 'pic_photo_or_album';
    static $MENU_TYPE_PIC_WEIXIN     = 'pic_weixin';
    static $MENU_TYPE_LOCATION_SELECT     = 'location_select';
    static $MENU_TYPE_MEDIA_ID     = 'media_id';
    static $MENU_TYPE_VIEW_LIMITED     = 'view_limited';

   	/**
   	 * 二维码类型常量
   	 */
    static $QR_SCENE       = 'QR_SCENE';
    static $QR_LIMIT_SCENE = 'QR_LIMIT_SCENE';
}