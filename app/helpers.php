<?php

/**
 * 从给定的 物品 => 概率 键值对数组中取出固定个数的物品
 *
 * @param $list
 * @param int $amount
 * @param array $choices
 * @return array
 * @throws Exception
 */
function roulette_choose($list, $amount=1, $choices=[])
{
    if ($amount > count($list)) {
        throw new Exception('数组越界');
    }
    if ($amount > 0) {
        $rand = rand(0, array_sum($list));
        $lower = 0; $upper = 0;
        foreach ($list as $item => $value) {
            $upper += $value;
            if ($rand >= $lower && $rand < $upper) {
                $choices[] = $item;
                unset($list[$item]);
                break;
            }
            $lower = $upper;
        }
        $choices = roulette_choose($list, $amount - 1, $choices);
    }
    return $choices;
}