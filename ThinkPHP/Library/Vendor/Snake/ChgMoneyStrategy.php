<?php
/**
 * SS_MSG_CHANGEMONEY
 *
 * Author: snake
 * Date: 14-8-18
 * Time: 下午9:26
 * Denpend:
 */




class ChgMoneyStrategy
{
    const money_change_strategy_must_be_all = 1; //必须足额扣除
    const money_change_strategy_as_possible_as_unit = 2; //若余额不足，则尽可能扣除最大单元数
    const money_change_strategy_try_your_best_zero = 3; //若余额不足，则扣除到零
} 