<?php
/**
 *
 * User: snake
 * Date: 14-11-13
 * Time: 下午9:42
 */




class State
{
    const player_status_idle = 0; //在房间内空闲
    const player_status_sitting = 1; //坐在游戏桌上，但没有按开始游戏
    const player_status_beready = 2; //坐在游戏桌上，并按了开始游戏
    const player_status_ingame = 3; //一局游戏中
    const player_status_onobserve = 4; //在某游戏桌旁观
    const player_status_offline = 5; //断线并等待续玩
} 