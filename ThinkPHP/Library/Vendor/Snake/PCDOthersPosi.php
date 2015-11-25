<?php
/**
 *
 * User: snake
 * Date: 14-8-21
 * Time: 下午8:52
 */




class PCDOthersPosi
{
    const PCD_OP_Begin = 0;
    const PCD_OP_RejectAnyChat = self::PCD_OP_Begin; //拒绝接收任何私聊
    const PCD_OP_RejectAnyGameInvite = 1; //不接收任何游戏邀请
    const PCD_OP_AddFriendLimit = 2; //加玩伴的限制
    const PCD_OP_VedioInvitationLimit = 3; //视频邀请的限制
    const PCD_OP_End = 31;
} 