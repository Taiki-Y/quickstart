<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TaskState extends Enum
{
    const Waiting = 1;
    const Working = 2;
    const Completed = 3;

     /**
     * Get the description for an enum value
     *
     * @param $value
     * @return string
     */
    public static function getDescription($value): string
    {
        switch ($value){
            case self::Waiting:
                return '未着手';
                brake;
            case self::Working:
                return '着手中';
                brake;
            case self::Completed:
                return '完了';
                brake;
            default:
                return self::getKey($value);
        }
    }
}
