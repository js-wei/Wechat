<?php
/**
 * 帐单的业务类型
 *
 * User: snake
 * Date: 14-11-1
 * Time: 下午3:22
 */




class ServiceTagType
{
    const service_tag_type_game = 0x00000000; //游戏.游戏业务的子业务就是具体游戏ID
    const service_tag_type_item = 0x00010000; //道具
    const service_tag_type_charge = 0x00020000; //游戏币充值
    const service_tag_type_exchange = 0x00030000; //游戏币回兑
    const service_tag_type_gm = 0x00040000; //gm
    const service_tag_type_service = 0x00050000; //用户服务（包括平台服务类的续费等）
    const service_tag_type_happybean = 0x00060000; //欢乐豆业务。凡是由其他业务引发的欢乐豆改变，欢乐豆账单中的service tag要使用其他业务的tag, 否则使用该service tag
    //账单里增加game id字段
    const service_tag_type_promotion = 0x00070000; //(促销)活动
    const service_tag_type_game_item = 0x00080000; //游戏内道具操作
} 