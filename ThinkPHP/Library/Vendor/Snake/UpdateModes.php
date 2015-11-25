<?php
/**
 * 更新模式
 *
 * User: snake
 * Date: 14-8-21
 * Time: 下午9:01
 */




class UpdateModes
{
    const update_mode_none = 0;
    const update_mode_delta = 1;
    const update_mode_set = 2;
    const update_mode_bit_and = 3;
    const update_mode_bit_or = 4;
    const update_mode_bit_xor = 5;
    const update_mode_bit_non_and = 6; //先非再与
    const update_mode_bit_non_or = 7; //先非再或
} 