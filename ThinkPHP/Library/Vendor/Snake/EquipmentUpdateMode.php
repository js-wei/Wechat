<?php
/**
 * 
 * User: snake
 * Date: 14-6-1
 * Time: 上午10:12
 */




class EquipmentUpdateMode {
    const Equipment_Update_Mode_must = 0; # 必须，不论该位置上是否有该道具
    const Equipment_Update_Mode_if = 1; # 如果该位置上无有效道具，即用当前的更新道具，否则跳过更新
    const Equipment_Update_Mode_Expiretime = 2; # 超时清理
} 