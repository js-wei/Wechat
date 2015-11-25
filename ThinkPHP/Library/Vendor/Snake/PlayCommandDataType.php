<?php
/**
 * 玩家通用数据格式
 *
 * User: snake
 * Date: 14-8-21
 * Time: 下午8:56
 */




class PlayCommandDataType
{
    const PCD_Type_Begin = 0;
    const PCD_Charming = self::PCD_Type_Begin; //魅力值
    const PCD_Achievement = 1; //成就值
    const PCD_PunishMethod = 2; //惩罚
    const PCD_OtherData = 3; //保留字段
    const PCD_LoginCount = 4; //平台登录次数;
    const PCD_LastLoginTime = 5; //上一次的登录时间
    const PCD_LastLoginIP = 6; //上一次的登录IP
    const PCD_WebQunData = 7; //群的信息
    const PCD_VipData = 8; //VIP信息
    const PCD_IdCard = 9; //身份证信息
    const PCD_Sex = 10; //性别
    const PCD_Birthday = 11; //出生年月

    const PCD_Type_End = 12;
    const PCD_MAX_DATA_NUMBER = 50;
} 