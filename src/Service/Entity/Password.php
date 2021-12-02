<?php

namespace Service\Entity;

use ArrayObject;

/**
 * @property int user_id
 * @property string password_hash
 */
class Password extends Entity
{

    public static function getStructure(): ArrayObject
    {
        return new ArrayObject([
            'table' => 'password',
            'primary_key' => 'user_id',
            'columns' => [
                'user_id' => ['default' => null],
                'password_hash' => ['default' => '']
            ]
        ]);
    }

}