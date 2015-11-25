<?php
/**
 * 服务器定义参数
 * 全部的参数定义
 *
 * User: snake
 * Date: 14-8-13
 * Time: 下午8:50
 */

const MSG_TYPE_REQUEST = 0x01;
const MSG_TYPE_RESPONSE = 0x02;
const MSG_TYPE_NOTIFY = 0x03;
const MSG_TYPE_OTHER = 0x04;

const max_setted_timer_count = 16; # 每个用户最多可以设置的定时器数目
const max_url_length = 64; # URL地址的长度
const max_date_string_length = 34; # 最大的日期字符串长度
const max_describe_string_length = 128; # 最大描述字符串长度
const max_ipaddr_len = 30; # ip的地址的长度
const player_data_other_count = 32; # 玩家数据的其他计数
const max_player_id_length = 32; # 用户字符串型帐号的长度
const max_player_name_length = 32; # 最大用户名字长度
const max_identity_card_length = 19; # 身份证信息
const max_signature_length = 256; # 签名最大长度
const max_room_session_count = 8; # 一个客户端，最多同时开8个房间

const max_game_tag_length = 32; # 游戏事务长度
const max_game_para_length = 32;
const max_account_string_length = 32; # 用户account最大长度
const max_nickname_length = 64; # 昵称最大长度
const max_present_message_length = 302; # 赠言最大长度，100个汉字(注：这个不要太长，有一部分赠言是放在透明数据中的，保证不溢出透明数据)
const max_system_message_length = 4096; # 系统消息的最大长度
const max_reason_message_length = 4096; # 原因最大长度
const max_operate_description_length = 64; # 操作描述最大长度
const max_transparent_data_size = 4096; # 透明数据最大长度
const max_crypt_string_length = 128; # 加密串最大长度
const max_sub_message_size = 4096; # SubMessage的最大长度;它是序列化以后放在额外的透明数据中的
const max_qun_crypt_length = 2048; # 群组加密信息
const max_profile_crypt_length = 2048; # profile加密串最大长度
const max_web_qun_count = 32; # 网站群的个数
const max_private_chat_length = 3002; # 最多一次聊1000个汉字
const max_loudspeaker_length = 302; # 喇叭最大100个汉字
const max_time_string_length = 32; # 最大的时间串长度

# 签名认证相关
const auth_service_key_length = 16; # 与认证服务器约定的密钥长度
const crypt_key_length = 16; # 与客户端的通讯使用的加密密钥长度
const max_signature_valid_period = 43200; # (12*60*60) 12小时
const min_signature_valid_period = 3600; # 60*60	1小时
const max_encrypt_key_length = 16; # 加密密钥的长度

# typedef char TAccount[max_account_string_length];			#类型：account
# typedef char TPresent[max_present_message_length];		#类型：赠言
# typedef char TReason[max_reason_message_length];			#类型：失败原因
# typedef char TNick[max_nickname_length];					#类型：昵称
# typedef char TCrypt[max_crypt_string_length];				#类型：加密串
# typedef char TIDCard[max_identity_card_length];			#类型: 身份证号码
# typedef char TSystemMessage[max_system_message_length];	#类型：系统消息
# typedef char TChat[max_private_chat_length];				#类型：私聊信息
# typedef char TSpeaker[max_loudspeaker_length];			#类型：喇叭信息
# typedef char TServiceBitmap[16]; #服务标识位

const MESSAGE_HEAD_SIZE = 17; # (3*sizeof(int32_t) + sizeof(int16_t) + 3*sizeof(int8_t))

# SS协议  特别注意: ID范围: [0x4000 -- 0x7FFD]

# Logic server  VS Game DB server
const SS_MSG_GETGAMEDATA = 0x4000; # (must) 获得游戏数据
const SS_MSG_LOCKMONEY = 0x4001; # 消息锁住钱
const SS_MSG_UPDATEPOINT = 0x4002; # must 更新时间点
const SS_MSG_REFRESH_GAMEPOINT = 0x4003; # notify game db -> logic server，Point与Money的变化都通过此值命令来实现.(must)
const SS_MSG_NOTIFY_LOCKMONEY = 0x4004; # game db -> logic server notify 通知其他服务器游戏币加锁/解锁
const SS_MSG_UPDATE_GAME_CONFIG = 0x4005; # 更新游戏配置
const SS_MSG_LOGICSERVER_INIT = 0x4006; # notify logic server -> game db 通知gamedb logic server进行了初始化启动(must)
const SS_MSG_NOTIFY_DELETE_PLAYER_REFRENCE = 0x4007; # notify logic server -> game db 通知game db 删除玩家的游戏数据索引
const SS_MSG_REFRESH_GAMECONFIG = 0x4008; # game db -> logic server notify 通知其它服务器游戏该游戏的配置已经更新
const SS_MSG_CHANGEMONEY = 0x4009; # 更改游戏币(must)
const SS_MSG_UPDATE_PLAY_COMMON_DATA = 0x4010; # 更新player的基本数据(除了coin之外的)
const SS_MSG_REFRESH_PLAY_COMMON_DATA = 0x4011; # 通知player的基本数据变化
const SS_MSG_RECORD_SHARED_MONEY = 0x4012; # logic server --> game db. 不需要response
const SS_MSG_GET_PLAYER_ALL_GAME_DATA = 0x4013; # profile server -->game db,拉取指定玩家的游戏数据.
const SS_MSG_UPDATE_EXT_GAME_INFO = 0x4014; # service server -->game db,更新玩家的某个游戏的配置数据
const SS_MSG_REFRESH_EXT_GAME_INFO = 0x4015; # game db--->service server,通知前端游戏服务器某个玩家的游戏的配置数据的刷新
const SS_MSG_UPDATE_PLAYER_CARDID = 0x4016; # 更新用户身份证号
const SS_MSG_PLAYER_CHARGE = 0x4017; # 用户充值
const SS_MSG_PLYAER_EXCHANGE = 0x4018; # 用户回兑
const SS_MSG_GET_PLAYER_ENTHRALMENTDATA = 0x4019; # 拉取玩家的防沉迷资料.
const SS_MSG_NOTIFY_FORBIDDEN_TALK = 0x401A; # 禁止发言
const SS_MSG_PRESENT_HAPPY_BEAN = 0x401B; # 赠送欢乐豆
const SS_MSG_NOTIFY_PRESENT_HAPPY_BEAN = 0x401C; # 赠送欢乐豆的通知消息
const SS_MSG_LOCK_HAPPY_BEAN = 0x401D; # 锁欢乐豆
const SS_MSG_NOTIFY_LOCK_HAPPY_BEAN = 0x401E; # 刷新欢乐豆的锁
const SS_MSG_CHANGE_HAPPY_BEAN = 0x401F; # 变更欢乐豆
const SS_MSG_NOTIFY_REFRESH_HAPPY_BEAN = 0x4020; # 变更欢乐豆的通知.

# game adm VS GMServer
const CS_MSG_GM_PUNISH = 0x7D01;
const CS_MSG_GM_SEND_MESSAGE = 0x7D02;

const CS_MSG_GM_RELAY_SYSTEM_MESSAGE_TO_HALL = 0x7D03;
const CS_MSG_GM_RELAY_SYSTEM_MESSAGE_TO_LOGIC = 0x7D04;
const CS_MSG_GM_SUBMIT_SYSTEM_MESSAGE_TO_HALL = 0x7D05;
const CS_MSG_GM_SUBMIT_SYSTEM_MESSAGE_TO_LOGIC = 0x7D06;
const CS_MSG_GM_CANCEL_SYSTEM_MESSAGE_TO_HALL = 0x7D07;
const CS_MSG_GM_CANCEL_SYSTEM_MESSAGE_TO_LOGIC = 0x7D08;

const CS_MSG_GM_GET_USER_DETAIL_INFO = 0x7D09; # 查看用户状态，禁言，封号，解锁&加锁游戏币
const CS_MSG_CHANGE_MONEY = 0x7D0A; # 修改玩家游戏币
const CS_MSG_LOCKMONEY = 0x7D0B; # 解锁&加锁玩家游戏币
const CS_MSG_QUERY_PLATFORM_MONEYLOCK_TO_GAMEDB = 0x7D0C; # 查看gamedb平台游戏币状态
const CS_MSG_UPDATE_PLATFORM_MONEYLOCK_TO_GAMEDB = 0x7D0D; # 更新gamedb平台游戏币状态
const CS_MSG_GM_UPDATE_GAME_PROP = 0x7D0E; # 更新用户游戏道具
const CS_MSG_GM_UPDATE_GAME_POINT = 0x7D0F; # 更新用户游戏积分
const CS_MSG_GM_UPDATE_Withery_Value = 0x7D10; # 更新用户魅力值
const CS_MSG_GM_UPDATE_Achievement_Value = 0x7D11; # 更新用户成就值
const CS_MSG_GM_DELETE_ITEM = 0x7D12; # 删除指定道具
const CS_MSG_GM_CLEAN_EXPIRED_ITEM = 0x7D13; # 清除过期道具
const CS_MSG_QUERY_PLATFORM_MONEYLOCK_TO_ITEMDB = 0x7D14; # 查看itemdb平台游戏币状态
const CS_MSG_UPDATE_PLATFORM_MONEYLOCK_TO_ITEMDB = 0x7D15; # 更新itemdb平台游戏币状态
const CS_MSG_GM_CHANGE_HAPPY_BEAN = 0x7D16; # 修改玩家快乐豆
const CS_MSG_GM_LOCK_HAPPY_BEAN = 0x7D17; # 解锁&加锁玩家快乐豆
const CS_MSG_GET_PLAYER_ALL_GAME_DATA = 0x7D18; # 获取玩家所有游戏信息
const CS_MSG_GET_PLAYER_ITEM_DATA = 0x7D19; # 获取玩家所有道具信息
const CS_MSG_GET_PLAYER_STATE_FROM_STATE_SERVER = 0x7D20; # 从StateServer获取玩家所有状态信息
const CS_MSG_GET_ALL_PLAYER_STATE = 0x7D21; # 获取所有玩家状态信息
const CS_MSG_GM_CANCEL_MESSAGE = 0x7D22; # 删除系统消息
const CS_MSG_GM_SEND_SYSTEM_MESSAGE_TO_PLAYER = 0x7D23; # 发送系统消息给指定用户
const CS_MSG_GM_REGISTER_GAME_SERVICE = 0x7D24; # Register游戏服务
const CS_MSG_GM_UPDATE_VIP_DATA = 0x7D25; # 更新用户VIP相关信息
const CS_MSG_GM_REGISTER_SERVICE = 0x7D26; # 给用户加服务，包括VIP服务
const CS_MSG_GM_PUBLISH_AD = 0x7D27; # GM发布广告信息
const CS_MSG_GM_DELETE_AD = 0x7D28; # GM取消广告
const CS_MSG_GM_GET_AD_LIST = 0x7D29; # GM拉取广告列表
const CS_MSG_GM_SEND_MAC_LIST = 0x7D30; # GM发送MAC地址列表

const max_service_type_count = 32;
const max_ss_shared_money_entry_count = 16;


//充值...
const    enum_StatLastHourChargeRMB = 0;
const    enum_StatLastDayChargeRMB = 100;

const    enum_StatLastHourCharge51 = 1;
const    enum_StatLastDayCharge51 = 101;
//回兑...
const    enum_StatLastHourExchange51 = 2;
const    enum_StatLastDayExchange51 = 102;


//全局支出:不包含充值与回兑的所有支出....
const    enum_StatLastDayOutgo2 = 103;

//支出分支:游戏
const    enum_StatLastHourGameOutgo = 104;
const    enum_StatLastDayGameOutgo = 105;

//支出分支:购卖平台道具
const    enum_StatLast5MinBuyPlatformItem = 106;
const    enum_StatLastHourBuyPlatformItem = 107;
const    enum_StatLastDayBuyPlatformItem = 108;

//支出分支:购卖魅力道具
const    enum_StatLast5MinBuyCharmItem = 109;
const    enum_StatLastHourBuyCharmItem = 110;
const    enum_StatLastDayBuyCharmItem = 111;

//全局收入:
const    enum_StatLastDayIncome2 = 114; //不包括充值的收入....
//收入分支:game
const    enum_StatLastHourGameIncome = 115;
const    enum_StatLastDayGameIncome = 116;

//收入分支:兑换魅力物品的收入.....
const    enum_StatLast5MinCharmItemExchange = 112;
const    enum_StatLastHourCharmItemExchange = 113;
const    enum_StatLastDayCharmItemExchange = 6;

//欢乐豆部份
const    enum_StatLast5MinHappyBeanPresentBuy = 200;
const    enum_StatLastDayHappyBeanPresentSystem = 201; //用户1天内通过系统赠送收入超出50;000欢乐豆
const    enum_StatLastDayHappyBeanOutgo = 202;

/*
const 	enum_StatLastHourIncome =3;
const 	enum_StatLastHourOutgo =4;
const 	enum_StatLastDayCharmItemConsume =5;
const 	enum_StatLastIncomeTimeStamp =7;
const 	enum_StatLastOutgoTimeStamp = 8;
*/


const    enum_StatMaxSize = 10;
const    enum_StatOneTimeChargeRMB = 20;
const     enum_StatOneTimeCharge51 = 21;
const     enum_StatOneTimeExchange51 = 22;
const     enum_StatOneTimeIncome = 23;
const     enum_StatOneTimeOutgo = 24;
const     enum_StatOneTimeGameIncome = 25;
const     enum_StatOneTimeGameOutgo = 26;
const     enum_StatServerHourCharge = 30;
const     enum_StatServerHourExchange = 31;
const     enum_StatServerHourShared = 32;
const     enum_StatServerHourGame = 33;
const     enum_StatServerHourItemConsume = 34;
const     enum_StatServerHourItemExchange = 35;
const     enum_StatServerDayCharge = 40;
const     enum_StatServerDayExchange = 41;
const     enum_StatServerDayShared = 42;
const     enum_StatServerDayGame = 43;
const     enum_StatServerDayItemConsume = 44;
const     enum_StatServerDayItemExchange = 45;
const     enum_StatServer5MinCharge = 50;
const     enum_StatServer5MinExchange = 51;
const     enum_StatServer5MinShared = 52;
const     enum_StatServer5MinGame = 53;
const     enum_StatServer5MinItemConsume = 54;
const     enum_StatServer5MinItemExchange = 55;

const TimeType_Relative = 1;
const TimeType_Absolute = 2;
const TimeType_Subscribe = 3; //定购包月(手机,荣誉)
const TimeType_UnSubscribe = 4; //取消包月(手机,荣誉)

const max_request_register_service_number = 10;
const MAX_REQUEST_PLAYER_COUNT = 100;
const MAX_RESPONSE_PLAYER_COUNT = 10;

const MAX_ROOM_SESSION_COUNT = 8;

const max_adinfo_count = 256;
const max_mac_list_count = 30000;

const cycle_one_time_forever = 1; //只发一次
const cycle_one_time_for_one_month = 2; //每月一次
const    cycle_one_time_for_one_week = 3; //每周一次
const    cycle_one_time_for_one_day = 4; //每天一次

const query_publishing_and_will_publish_ad = -1; //查询正在发送和将要发送的广告列表
const    query_publishing_ad = 1; //查询正在发送的广告列表
const    query_will_publish_ad = 2; //查询将要发送的广告列表

const MAX_GOODS_UPDATE_COUNT = 15;
const MAX_ITEM_COUNT = 512;
const MAX_EQUIPMENT_COUNT = 16; //用户能装备的(魔法)表情的最大的个数

const MAX_QUERY_COUNT = 8;