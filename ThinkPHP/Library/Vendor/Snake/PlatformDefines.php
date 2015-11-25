<?php
/**
 *
 *User:snake
 *Date:14-6-9
 *Time:下午10:39
 */


//////////////////////////////////////////////////////////////////////////
//SS协议特别注意:ID范围:[',0x4000--0x7FFD]
//////////////////////////////////////////////////////////////////////////

//LogicserverVSGameDBserver
define('SS_MSG_GETGAMEDATA', 0x4000); //(must)
define('SS_MSG_LOCKMONEY', 0x4001);
define('SS_MSG_UPDATEPOINT', 0x4002); //must
define('SS_MSG_REFRESH_GAMEPOINT', 0x4003); //notifygamedb->logicserver，Point与Money的变化都通过此值命令来实现.(must)
define('SS_MSG_NOTIFY_LOCKMONEY', 0x4004); //gamedb->logicservernotify通知其他服务器游戏币加锁/解锁
define('SS_MSG_UPDATE_GAME_CONFIG', 0x4005); //
define('SS_MSG_LOGICSERVER_INIT', 0x4006); //notifylogicserver->gamedb通知gamedblogicserver进行了初始化启动(must)
define('SS_MSG_NOTIFY_DELETE_PLAYER_REFRENCE', 0x4007); //notifylogicserver->gamedb通知gamedb删除玩家的游戏数据索引
define('SS_MSG_REFRESH_GAMECONFIG', 0x4008); //gamedb->logicservernotify通知其它服务器游戏该游戏的配置已经更新addbylz2008.04.08
define('SS_MSG_CHANGEMONEY', 0x4009); //更改游戏币(must)
define('SS_MSG_UPDATE_PLAY_COMMON_DATA', 0x4010); //更新player的基本数据(除了coin之外的)addbylz2008.08.16
define('SS_MSG_REFRESH_PLAY_COMMON_DATA', 0x4011); //通知player的基本数据变化addbylz2008.08.16
define('SS_MSG_RECORD_SHARED_MONEY', 0x4012); //logicserver-->gamedb.不需要response
define('SS_MSG_GET_PLAYER_ALL_GAME_DATA', 0x4013); //profileserver-->gamedb,拉取指定玩家的游戏数据.
define('SS_MSG_UPDATE_EXT_GAME_INFO', 0x4014); //serviceserver-->gamedb,更新玩家的某个游戏的配置数据
define('SS_MSG_REFRESH_EXT_GAME_INFO', 0x4015); //gamedb--->serviceserver,通知前端游戏服务器某个玩家的游戏的配置数据的刷新
define('SS_MSG_UPDATE_PLAYER_CARDID', 0x4016); //更新用户身份证号
define('SS_MSG_PLAYER_CHARGE', 0x4017); //用户充值
define('SS_MSG_PLYAER_EXCHANGE', 0x4018); //用户回兑
define('SS_MSG_GET_PLAYER_ENTHRALMENTDATA', 0x4019); //拉取玩家的防沉迷资料.
define('SS_MSG_NOTIFY_FORBIDDEN_TALK', 0x401A); //禁止发言
define('SS_MSG_PRESENT_HAPPY_BEAN', 0x401B); //赠送欢乐豆
define('SS_MSG_NOTIFY_PRESENT_HAPPY_BEAN', 0x401C); //赠送欢乐豆的通知消息
define('SS_MSG_LOCK_HAPPY_BEAN', 0x401D); //锁欢乐豆
define('SS_MSG_NOTIFY_LOCK_HAPPY_BEAN', 0x401E); //刷新欢乐豆的锁
define('SS_MSG_CHANGE_HAPPY_BEAN', 0x401F); //变更欢乐豆
define('SS_MSG_NOTIFY_REFRESH_HAPPY_BEAN', 0x4020); //变更欢乐豆的通知.

define('SS_MSG_SET_PLAYER_ACCOUNT', 0x4020); //设置某人帐户
define('SS_MSG_UPDATE_PLAYER_ENTHRALMENTDATA', 0x4021); //更新玩家的防沉迷资料
define('SS_MSG_NOTIFY_PLAYER_CONSUME_DATA', 0x4022); //通知玩家的消费情况(GameDB-->监控服务器)
define('SS_MSG_QUERY_PLATFORM_MONEY_LOCK', 0x4023); //查询平台的金币锁...
define('SS_MSG_UPDATE_PLATFORM_MONEY_LOCK', 0x4024); //更新平台的金币锁...
define('SS_MSG_REFRESH_PLATFORM_MONEY_LOCK', 0x4025); //反向通知游戏逻辑服务器,平台金币锁的变化....
define('SS_MSG_REGISTER_SERVICE', 0x4026); //注册服务
define('SS_MSG_REFRESH_SERVICE', 0x4027); //反向服务刷新通知....
define('SS_MSG_RENEW_SERVICE', 0x4030); //服务续费
define('SS_MSG_GET_USER_DETAIL_INFO', 0x4028); //拉取用户的详细信息...(目前仅供后台管理平台使用,如gm)
define('SS_MSG_CHECK_USER_IS_EXIST', 0x4029); //检查用户存在(目前仅供hallserver使用)
define('SS_MSG_NOTIFY_GAME_RESULT', 0x4030); //通知游戏结果(目前仅供ActionServer使用)
define('SS_MSG_NOTIFY_QUN_PLAYER_DATA', 0x4031); //群用户的数据变更通知
define('SS_MSG_NOTIFY_GAMEDATA_HEARTBEAT', 0x4032); //通知GameDB游戏数据心跳包
define('SS_MSG_NOTIFY_PLAYER_ACTIONDATA', 0x4033); //通知玩家活动消息包.
define('SS_MSG_GET_PLAY_COMMON_DATA', 0x4034); //拉取玩家基本资料
define('SS_MSG_NOTIFY_PLAYER_COMMON_DATA', 0x4035); //用户上线通知hallserver该用户的commondata数据
define('SS_MSG_GET_USER_PROFILE', 0x4036); //拉取用户的个人资料(profile专用)
define('SS_MSG_KICK_PLAYER', 0x4100); //踢人
define('SS_MSG_BROADCAST_SYSTEM_MESSAGE', 0x4101); //广播系统消息
define('SS_MSG_NOTIFY_BROADCAST_NOTICE_INFO', 0x4102); //发布公告消息

define('SS_MSG_REFRESH_VIP_DATA', 0x4201); //刷新用户的VIP数据vipserver-->gamedbserver
define('SS_MSG_VIP_NOTIFY_MESSAGE', 0x4202); //通知用户的VIP相关的消息
define('SS_MSG_UPDATE_VIP_DATA', 0x4203); //(GM)手动更新用户的VIP数据.


//logicservervsantibotserver

define('SS_MSG_ANTIBOT_DATA', 0x4151); //反外挂数据
define('SS_MSG_ANTIBOT_PUNISH', 0x4152); //反外挂惩罚

//logicservervscompetedb
define('SS_MSG_GET_COMPETE_GAME_DATA', 0x4300); //获取比赛积分
define('SS_MSG_UPDATE_COMPETE_GAME_POINT', 0x4301); //更新比赛积分
define('SS_MSG_REFRESH_COMPETE_GAME_POINT', 0x4302); //通知更新比赛积分
define('SS_MSG_NOTIFY_PLAYER_LEAVE_COMPETE', 0x4303); //通知玩家离开游戏

//其他服务器与hotnewsserver之间的协议
define('SS_MSG_NOTIFY_HOTNEWS', 0x4E00); //好友动态

//其他服务器与routerserver之间的协议
define('SS_MSG_ROUTER_HEARTBEAT', 0x4F00); //与routerserver之间的heartbeat
define('SS_MSG_ROUTER_REGISTER', 0x4F01); //其他服务器向routerserver自己


//vipserver


//LogicserverVSCatalogserver
define('SS_MSG_HELLO', 0x5000);
define('SS_MSG_REGISTER', 0x5001); //s<->s注册服务器，拉取配置信息
define('SS_MSG_REPORTSTATICS', 0x5002); //上报统计信息notify


//logicserverVSStateServer（shouldbedeleted）
define('SS_MSG_NOTIFY_LOGICSERVER_INIT', 0x5100); //logicserver通知stateserver自身初始化
//define('SS_MSG_NOTIFY_PLAYER_STATUS',0x5101);//logicserver上报玩家状态给stateserver
//define('SS_MSG_NOTIFY_HEARTBEAT_LOGIC_STATE',0x5102);//logicserver与stateserver之间的心跳包


//ProfileserverVSGameDBserver
define('SS_MSG_GETUSERINFO', 0x6000); //profileserver->gamedbserveraddbylz2008.04.08
define('SS_MSG_GETOTHERUSERINFO', 0x6001); //profileserver->gamedbserveraddbylz2008.04.08


define('SS_MSG_AD_URL', 0x6200); //magicserver<-->adserver，获取广告URL

define('SS_MSG_PUBLISH_AD', 0x6201); //gmserver<-->adserver发布广告
define('SS_MSG_DELETE_AD', 0x6202); //gmserver<-->adserver删除广告
define('SS_MSG_GET_AD_LIST', 0x6203); //gmserver<-->adserver查询广告
define('SS_MSG_SEND_MAC_LIST', 0x6204); //gmserver<-->adserver发送mac地址列表
//hallservervsscoreserver);
define('SS_MSG_NOTIFY_51_SCORE_DELTA', 0x7300); //积分服务器通知用户所在的hall，ta的51积分增量
define('SS_MSG_NOTIFY_MESSAGEBOX', 0x7301);
define('SS_MSG_NOTIFY_LOGIN', 0x7302);
//HallServer、LogicServer、StateServer等VSFriendDBserver
define('SS_MSG_GET_POSITIVE_FRIEND_LIST', 0x7400); //获取自己的正向玩伴列表
define('SS_MSG_GET_STATISTICAL_TAG', 0x7401); //获取某人的统计标签，目前最多10项
define('SS_MSG_ADD_TAG_TO_FRIEND', 0x7402); //给人贴标签，并自动添加为玩伴
define('SS_MSG_DELETE_FRIEND', 0x7403); //删除玩伴
define('SS_MSG_GET_REVERSE_FRIEND_LIST', 0x7404); //获取自己的逆向玩伴列表
define('SS_MSG_ADD_REVERSE_TAG', 0x7405); //贴逆向标签
define('SS_MSG_NOTIFY_FRIEND_INFO', 0x7406); //全量通知某个玩伴的标签信息
define('SS_MSG_GET_RECOMMEND_TAG', 0x7407); //获取玩家的推荐标签，目前从统计标签中取6个，不足6个取全部
define('SS_MSG_DELETE_REVERSE_FRIEND', 0x7408); //删除逆向玩伴
define('SS_MSG_GET_SIMPLE_FRIEND_LIST', 0x7409); //获取简单的玩伴列表（只有玩伴的UIN）
define('SS_MSG_ADD_FRIEND_GROUP', 0x740A); //玩伴列表中添加自定义分组
define('SS_MSG_DEL_FRIEND_GROUP', 0x740B); //删除玩伴列表中的自定义分组
define('SS_MSG_MOVE_FRIEND_TO_GROUP', 0x740C); //把玩伴移到指定的分组中
define('SS_MSG_RENAME_FRIEND_GROUP', 0x740D); //自定义玩伴分组重命名
define('SS_MSG_GET_FRIEND_GROUPS', 0x740E); //拉去玩家的玩伴分组信息
define('SS_MSG_RENAME_FRIEND_REMARKS', 0x740F); //更新玩伴的备注
define('SS_MSG_GET_PLAYED_WITH_INFO', 0x7410); //拉去和谁一起玩过的信息
define('SS_MSG_ADD_PLAYED_WITH_INFO', 0x7411); //添加和谁一起玩过的信息
define('SS_MSG_NOTIFY_DEL_PLAYED_WITH_INFO', 0x7412); //通知删除某个和谁一起玩过的信息
define('SS_MSG_ADD_FRIEND', 0x7413); //加玩伴(贴标签+分组+备注)
define('SS_MSG_GET_FRIEND_BASE_INFO', 0x7414); //拉取玩伴的基本信息（UIN+账号）
define('SS_MSG_GET_BLACK_LIST_INFO', 0x7415); //获取黑名单
define('SS_MSG_ADD_BLACK_LIST_INFO', 0x7416); //添加黑名单
define('SS_MSG_DEL_BLACK_LIST_INFO', 0x7417); //删除黑名单
define('SS_MSG_ADD_NOT_VERIFIED_FRIEND_INFO', 0x7418); //添加未验证的好友信息
define('SS_MSG_CHECK_NOT_VERIFIED_FRIEND_INFO', 0x7419); //核实未验证的好友信息
define('SS_MSG_NOTIFY_MAKE_FRIEND_COUNT_INFO', 0x741A); //通知加好友的数量信息
define('SS_MSG_NOTIFY_GET_CHAT_WITH_INFO', 0x741B); //通知加载和谁聊过的信息
define('SS_MSG_NOTIFY_ADD_CHAT_WITH_INFO', 0x741C); //通知添加和谁聊过的信息
define('SS_MSG_NOTIFY_DEL_CHAT_WITH_INFO', 0x741D); //通知删除和谁聊过的信息


//hallserver与其它后端服务器公共的协议，比如说初始化、上报玩家状态等
//hallservervsstate、gamedb、itemdb、frienddbserver
define('SS_HALL_NOTIFY_INIT', 0x7500); //hall启动时，向state、frienddb、gamedb、itemdbserver注册
define('SS_HALL_NOTIFY_PLAYER_STATE', 0x7501); //hall向state、frienddb、gamedb、itemdbserver上报玩家状态，上线、下线等
define('SS_MSG_BROADCAST_TRANSFRE_MESSAGE', 0x7502); //请求向指定类型的所有目的服务器转发透明数据
define('SS_MSG_NOTIFY_BROADCAST_TRANSFRE_MESSAGE', 0x7503); //向指定类型的所有目的服务器转发透明数据

//gmserver和stateserver
define('SS_MSG_BROADCAST_GM_SYSTEM_MESSAGE', 0x7600); //GM发送系统消息

//GMServerVS(Logic&HallServer)
define('SS_MSG_RELAY_SYSTEM_MESSAGE', 0x7601); //GM通过logicserver和(或)hallserver发生系统消息
#defineSS_MSG_SUBMIT_SYSTEM_MESSAGE',0x7602);//GM提交（设置）系统消息到logic&hallserver
define('SS_MSG_CANCEL_SYSTEM_MESSAGE', 0x7603); //GM取消(清除)原先提交（设置）给logic&hallServer的系统消息

//GMServerVSStateServer
define('SS_GM_GET_PLAYER_STATE', 0x7604); //GM请求获取玩家状态
define('SS_GM_GET_ALL_PLAYER_STATE', 0x7605); //GM请求查看StateServer中的所有内存数据

define('SS_MSG_CANCEL_MESSAGE', 0x7606); //GMHallServer删除原先设定的系统消息，并且通知客户端删除指定的已收到的消息
define('SS_MSG_SEND_SYSTEM_MESSAGE_TO_PLAYER', 0x7607); //GM<->HallServer给指定用户发送系统消息

//StateServer
define('SS_MSG_REGISTER_TO_STATESERVER', 0x7610); //向StateServer注册服务
define('SS_MSG_STATESERVER_NOTIFY_PLAYER_STATE', 0x7611); //StateServer通知玩家状态变化到已经注册服务的服务器
define('SS_MSG_STATE_NOTIFY_BROADCAST_MSG_INFO', 0x7612); //向logicserver的房间或hallserver下发广播消息

//hallservervsstateserver
define('SS_HALL_STATE_REPORT_GAME_STATE', 0x7700); //客户端向hall上报当前游戏状态，hall通知给所以state
define('SS_HALL_STATE_UPDATE_PLAYER_PROFILE', 0x7701); //客户端更新基本资料，hall通知给所以state
define('SS_HALL_STATE_REQUEST_PLAYER_STATE', 0x7703); //cliet向hall请求获取玩家状态，hall转发给state
define('SS_HALL_STATE_REQUEST_PLAYERCOUNT_IN_HALL', 0x7704); //hall向state请求大厅在线人数
define('SS_HALL_STATE_HEARTBEAT', 0x7705); //心跳，可能跟请求在线人数在一起处理
define('SS_HALL_STATE_NOTIFY_FRIEND_ONLINE', 0x7706); //通知好友上线state->hall
define('SS_HALL_STATE_NOTIFY_KICKPLAYER', 0x7707); //已在其它地方登陆，通知玩家关闭游戏
define('SS_HALL_STATE_REQUEST_TRANSFER_MESSAGE', 0x7708); //请求state中转一个消息
define('SS_HALL_STATE_NOTIFY_TRANSFER_MESSAGE', 0x7709); //通知hall有消息要转给clientstate->hall
define('SS_STATE_HALL_GET_REVERSE_FRIEND_UINS', 0x770A); //stateserver拉取逆向玩伴的UIN
define('SS_HALL_STATE_NOTIFY_BROADCAST_MESSAGE', 0x770B); //通知stateserver广播消息
define('SS_STATE_HALL_NOTIFY_STATUS_TOFRIEND', 0x7710); //StateServer向Hall主动push用户的状态信息给用户反向好友

//hallservervsitemdb
//define('SS_HALL_ITEM_NOTIFY_PLAYER_STATUS',0x7800);//hall向itemdb上报玩家状态，login和logoutdelbylz2008.08.21SS_HALL_NOTIFY_PLAYER_STATE
define('SS_ITEMDB_UPDATE_PLAYER_ITEMINFO', 0x7801); //其他服务器与ItemDB之间更新玩家物品信息的协议
define('SS_ITEM_HALL_NOTIFY_PLAYER_INFO', 0x7802); //itemdb下发玩家物品更新信息给hall
define('SS_MSG_ITEMDB_GET_USER_ITEM_INFO', 0x7803); //业务服务器(如hallserver,...)查询某个用户的道具或魅力物品信息...
define('SS_MSG_ITEMDB_TRANSFER_MESSAGE', 0x7804); //业务服务器与ItemDB之间传递消息(此消息为通知类消息)
define('SS_MSG_DELETE_ITEM', 0x7805); //删除指定的道具，包括所有用户
define('SS_MSG_CLEAN_EXPIRE_ITEM', 0x7806); //清除过期道具,包括所有用户
define('SS_MSG_QUERY_PLAYER_ITEMDATA', 0x7807); //查询用户的指定类型的道具
define('SS_MSG_UPDATE_PLAYER_EQUIPMENT_INFO', 0x7808); //更新用户的装备信息
define('SS_MSG_REFRESH_PLAYER_EQUIPMENT_INFO', 0x7809); //刷新用户的装备信息

//stateserverVSCatalogserver
define('SS_MSG_STATE_SERVER_HELLO', 0x7900);
define('SS_MSG_STATE_SERVER_REGISTER', 0x7901); //s<->s注册服务器，拉取配置信息
define('SS_MSG_STATE_SERVER_REPORTSTATICS', 0x7902); //上报统计信息notify
define('WS_MSG_WEB_REPORTSTATICS', 0x7903); //web节点上报统计信息notify


//MiscserverVSGroupserver
define('SS_MSG_GET_GROUP_RANK', 0x7A01); //拉取指定群排名
define('SS_MSG_GET_GROUP_TOP_RANK', 0x7A02); //拉取群top排名


//offlineservervshallserver
define('SS_MSG_PUSH_OFFLINE_MSG', 0x7A10);


//pay.51.comVSproxyserver
define('CS_MSG_PAY_TO_GAME', 0x7B01);
define('CS_MSG_PAY_FROM_GAME', 0x7B02);
define('CS_MSG_SEARCH_GAME_MONEY', 0x7B03);
define('CS_MSG_PAY_TO_VIP', 0x7B04); //PayServer直接注册用户VIP信息
define('CS_MSG_SEARCH_VIP_INFO', 0x7B05); //PayServer查询用户VIP信息
define('CS_MSG_PAY_MOBILE_TO_VIP', 0x7B06); //手机包月VIP
define('CS_MSG_PAY_UNSUBSCRIBE_VIP', 0x7B07); //手机退订包月VIP

//game.51.comVSproxyserver
define('CS_MSG_UPDATE_CARD_ID', 0x7C01);
define('CS_MSG_GET_USER_INFO', 0x7C02);
define('CS_MSG_ITEM_EXCHANGE', 0x7C03);
define('CS_MSG_GET_ITEM_INFO', 0x7C04);
define('CS_MSG_BUY_GOODS', 0x7C05); //web道具商城与MarketServer之间的购买/赠送协议.双向
define('CS_MSG_RENEW_SERVICE', 0x7C06);
define('CS_MSG_LUCKY_DRAW', 0x7C07);
define('CS_MSG_GET_ACTION_INFO', 0x7C08);
define('CS_MSG_MULTI_EXCHANGE', 0x7C09);
define('CS_MSG_QUERY_DRAW', 0x7C0A);
define('CS_MSG_BALANCE', 0x7C0B);
define('CS_MSG_ACTION_HIT', 0x7C0C);
define('CS_MSG_QUERY_ITEM_INFO', 0x7C0D);
define('CS_MSG_UPDATE_EQUIPMENT', 0x7C0E);
define('CS_MSG_CONSIGN', 0x7C0F);
define('CS_MSG_GET_ONLINE_INFO', 0x7C10);
define('CS_MSG_GET_ONLINE_RANK', 0x7C11);
define('CS_MSG_GET_PAIR_INFO', 0x7C12);
define('CS_MSG_PAIRING', 0x7C13);
define('CS_MSG_GET_LATEST_PAIR', 0x7C14);
define('CS_MSG_SEND_MESSAGE_TO_CLIENT', 0x7C15);

//gameadm.51.comVSGMServer
define('CS_MSG_GM_PUNISH', 0x7D01);
define('CS_MSG_GM_SEND_MESSAGE', 0x7D02);

define('CS_MSG_GM_RELAY_SYSTEM_MESSAGE_TO_HALL', 0x7D03);
define('CS_MSG_GM_RELAY_SYSTEM_MESSAGE_TO_LOGIC', 0x7D04);
define('CS_MSG_GM_SUBMIT_SYSTEM_MESSAGE_TO_HALL', 0x7D05);
define('CS_MSG_GM_SUBMIT_SYSTEM_MESSAGE_TO_LOGIC', 0x7D06);
define('CS_MSG_GM_CANCEL_SYSTEM_MESSAGE_TO_HALL', 0x7D07);
define('CS_MSG_GM_CANCEL_SYSTEM_MESSAGE_TO_LOGIC', 0x7D08);

define('CS_MSG_GM_GET_USER_DETAIL_INFO', 0x7D09); //查看用户状态，禁言，封号，解锁&加锁游戏币
define('CS_MSG_CHANGE_MONEY', 0x7D0A); //修改玩家游戏币
define('CS_MSG_LOCKMONEY', 0x7D0B); //解锁&加锁玩家游戏币
define('CS_MSG_QUERY_PLATFORM_MONEYLOCK_TO_GAMEDB', 0x7D0C); //查看gamedb平台游戏币状态
define('CS_MSG_UPDATE_PLATFORM_MONEYLOCK_TO_GAMEDB', 0x7D0D); //更新gamedb平台游戏币状态
define('CS_MSG_GM_UPDATE_GAME_PROP', 0x7D0E); //更新用户游戏道具
define('CS_MSG_GM_UPDATE_GAME_POINT', 0x7D0F); //更新用户游戏积分
define('CS_MSG_GM_UPDATE_Withery_Value', 0x7D10); //更新用户魅力值
define('CS_MSG_GM_UPDATE_Achievement_Value', 0x7D11); //更新用户成就值
define('CS_MSG_GM_DELETE_ITEM', 0x7D12); //删除指定道具
define('CS_MSG_GM_CLEAN_EXPIRED_ITEM', 0x7D13); //清除过期道具
define('CS_MSG_QUERY_PLATFORM_MONEYLOCK_TO_ITEMDB', 0x7D14); //查看itemdb平台游戏币状态
define('CS_MSG_UPDATE_PLATFORM_MONEYLOCK_TO_ITEMDB', 0x7D15); //更新itemdb平台游戏币状态
define('CS_MSG_GM_CHANGE_HAPPY_BEAN', 0x7D16); //修改玩家快乐豆
define('CS_MSG_GM_LOCK_HAPPY_BEAN', 0x7D17); //解锁&加锁玩家快乐豆
define('CS_MSG_GET_PLAYER_ALL_GAME_DATA', 0x7D18); //获取玩家所有游戏信息
define('CS_MSG_GET_PLAYER_ITEM_DATA', 0x7D19); //获取玩家所有道具信息
define('CS_MSG_GET_PLAYER_STATE_FROM_STATE_SERVER', 0x7D20); //从StateServer获取玩家所有状态信息
define('CS_MSG_GET_ALL_PLAYER_STATE', 0x7D21); //获取所有玩家状态信息
define('CS_MSG_GM_CANCEL_MESSAGE', 0x7D22); //删除系统消息
define('CS_MSG_GM_SEND_SYSTEM_MESSAGE_TO_PLAYER', 0x7D23); //发送系统消息给指定用户
define('CS_MSG_GM_REGISTER_GAME_SERVICE', 0x7D24); //Register游戏服务
define('CS_MSG_GM_UPDATE_VIP_DATA', 0x7D25); //更新用户VIP相关信息
define('CS_MSG_GM_REGISTER_SERVICE', 0x7D26); //给用户加服务，包括VIP服务
define('CS_MSG_GM_PUBLISH_AD', 0x7D27); //GM发布广告信息
define('CS_MSG_GM_DELETE_AD', 0x7D28); //GM取消广告
define('CS_MSG_GM_GET_AD_LIST', 0x7D29); //GM拉取广告列表
define('CS_MSG_GM_SEND_MAC_LIST', 0x7D30); //GM发送MAC地址列表

//client.51.comVSmiscServer
define('CS_MSG_MISC_GET_PROFILE_FRIEND_LIST', 0x7E01); //拉取简单玩伴列表
define('CS_MSG_GET_PLAYER_CARD_ID', 0x7E02); //查询用户身份证信息
define('CS_MSG_GET_GROUP_RANK', 0x7E03); //拉取指定群排名
define('CS_MSG_GET_GROUP_TOP_RANK', 0x7E04); //拉取群top排名
define('CS_MSG_GET_FRIEND_GROUP_INFO', 0x7E05); //拉取分组信息
define('CS_MSG_GET_PLAYER_GROUP_DATA', 0x7E06); //拉取用户群权限
define('WS_MSG_GET_SIMPLE_FRIEND_LIST', 0x7E08); //获得玩伴列表
define('WS_MSG_GET_SIMPLE_GAME_ID_LIST', 0x7E09); //获取最近常玩的游戏ID

//client.51.comVSRecommendServer
define('CS_MSG_GET_RECOMMEND_USER', 0x7E07); //拉取推荐用户
define('WS_MSG_GET_RECOMMEND_USER_LIST', 0x7E0A); //拉取推荐用户列表
//特别注意:SS协议的ID范围:[',0x4000--0x7FFD]

# 全局参数开始
const connector_head_base_size = 7; //sizeof(int32_t)+sizeof(int8_t)+sizeof(int16_t)
const max_client_pkg_size = 5120; //客户端发送过来的包的最大大小
const max_relay_pkg_size = 4096; //客户端给RelayServer发送过来的最大数据包大小

const max_cs_package_size = 0x3ffff; //cs包的最大长度 256K
# 全局参数结束


/************************************************************************/
/*					    各服务器之间通用的协议                          */
/************************************************************************/

# 玩家状态
class PlayerState
{
    const player_offline = 0;
    const player_online = 1;
    const player_hide = 2;
    const player_alive = 3; # hall server和score server之间使用
}

const max_game_other_data_count = 8;
const max_game_data_count = 256;
const max_game_ext_int_count = 128;
const max_game_ext_data_size = 1024; //最大的扩展内存大小.
const max_web_order_id_size = 30; //网站充值的流水号大小
const max_web_qun_data_size = 1024; //网站群的信息块大小
const max_game_count_in_server = 10; //单server上最多可放10个游戏.

const TimeType_Relative = 1;
const TimeType_Absolute = 2;
const TimeType_Subscribe = 3; //定购包月(手机,荣誉)
const TimeType_UnSubscribe = 4; //取消包月(手机,荣誉)

const max_request_register_service_number = 10;