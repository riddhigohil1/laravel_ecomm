<?php

namespace App\Enum;

enum ProductStatusEnum : string
{
    case IN_STOCK = 'In Stock';

    case SOLD_OUT = 'Sold Out';

    public static function labels():array
    {
        return [
            self::IN_STOCK->value => __('In Stock'),
            self::SOLD_OUT->value => __('Sold Out'),
        ];
    }

    public static function colors():array
    {
        return [
            'success' => self::IN_STOCK->value,
            'danger' => self::SOLD_OUT->value,
        ];
    }
}
