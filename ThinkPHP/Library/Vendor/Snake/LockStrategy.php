<?php
/**
 * 锁策略
 *
 * Author: snake
 * Date: 14-8-18
 * Time: 下午9:51
 * Denpend:
 */




class LockStrategy
{
    const lock_type_strategy_try = 1; //尽可能锁.
    const lock_type_strategy_must = 2; //必须锁全值
} 