<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

abstract class BaseEnum extends Enum
{
    /**
     * Get the description for an enum value
     *
     * @param $value
     * @return string
     */
    public static function getDescription($value): string
    {
        $className = self::getClassName();
        $localizedStringKey = "enums.{$className}.{$value}";

        if (strpos(__($localizedStringKey), 'enums.') !== 0) {
            return __($localizedStringKey);
        }

        return parent::getDescription($value);
    }

    private static function getClassName()
    {
        $className = explode('\\', get_called_class());
        return array_pop($className);
    }
}
