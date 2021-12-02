<?php

namespace Service\Entity;

use ArrayObject;

/**
 * @property int user_id
 * @property string username
 * @property string first_name
 * @property string last_name
 * @property string display_name
 * @property string email
 * @property int group_id
 */
class User extends Entity
{

    public static function getStructure(): ArrayObject
    {
        return new ArrayObject([
            'table' => 'user',
            'primary_key' => 'user_id',
            'columns' => [
                'user_id' => ['default' => 0],
                'username' => ['default' => 'Chat User'],
                'first_name' => ['default' => 'No'],
                'last_name' => ['default' => 'Name'],
                'display_name' => ['default' => 'No Name'],
                'email' => ['default' => 'example@example.com'],
                'group_id' => ['default' => 0]
            ]
        ]);
    }

}