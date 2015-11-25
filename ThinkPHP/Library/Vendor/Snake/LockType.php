<?php
/**
 * 锁类型
 *
 * Author: snake
 * Date: 14-8-18
 * Time: 下午9:49
 * Denpend:
 */




class LockType
{
    const lock_type_unlock = 0; //解锁
    const lock_type_exclusive_lock = 1; //增加互斥锁
    const lock_type_force_unlock = 2; //强制解锁(仅限于GM发起强制解锁).
} 