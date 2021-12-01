<?php

namespace Service;

class Setup
{

    protected App $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function runSetup()
    {
        $db = $this->app->db();

        $tables = $this->getTables();
        foreach ($tables as $tableName => $table)
        {
            $db->create(
                $tableName,
                $table['columns'] ?? [],
                $table['options'] ?? []
            );
        }
    }

    public function runUninstall()
    {
        $db = $this->app->db();
        $tables = $this->getTables();
        foreach (array_keys($tables) as $tableName)
        {
            $db->drop($tableName);
        }
    }

    public function getTables(): array
    {
        return [
            'authentication' => [
                'columns' => [
                    'user_id' => [
                        'INT',
                        'NOT NULL'
                    ],
                    'authorization_date' => [
                        'INT',
                        'NOT NULL'
                    ],
                    'token' => [
                        'VARCHAR(96)',
                        'NOT NULL'
                    ]
                ]
            ],
            'user' => [
                'columns' => [
                    'user_id' => [
                        'INT',
                        'NOT NULL',
                        'AUTO_INCREMENT',
                        'PRIMARY KEY'
                    ],
                    'username' => [
                        'VARCHAR(48)',
                        'NOT NULL'
                    ],
                    'first_name' => [
                        'VARCHAR(48)',
                        'NOT NULL'
                    ],
                    'last_name' => [
                        'VARCHAR(48)',
                        'NOT NULL'
                    ],
                    'display_name' => [
                        'VARCHAR(48)',
                        'NOT NULL'
                    ],
                    'email' => [
                        'VARCHAR(512)',
                        'NOT NULL'
                    ],
                    'group_id' => [
                        'INT',
                        'NOT NULL'
                    ]
                ]
            ],
            'membership' => [
                'columns' => [
                    'user_id' => [
                        'INT',
                        'NOT NULL'
                    ],
                    'group_id' => [
                        'INT',
                        'NOT NULL'
                    ]
                ]
            ],
            'group' => [
                'columns' => [
                    'group_id' => [
                        'INT',
                        'NOT NULL',
                        'AUTO_INCREMENT',
                        'PRIMARY KEY'
                    ],
                    'group_name' => [
                        'VARCHAR(48)',
                        'NOT NULL'
                    ],
                    'manager_id' => [
                        'INT',
                        'NOT NULL'
                    ],
                    'active' => [
                        'BOOL',
                        'NOT NULL'
                    ]
                ]
            ],
            'password' => [
                'columns' => [
                    'user_id' => [
                        'INT',
                        'NOT NULL'
                    ],
                    'password_hash' => [
                        'VARCHAR(96)',
                        'NOT NULL'
                    ]
                ]
            ],
            'admin' => [
                'columns' => [
                    'user_id' => [
                        'INT',
                        'NOT NULL'
                    ],
                    'group_id' => [
                        'INT',
                        'NOT NULL'
                    ]
                ]
            ],
            'chat_room' => [
                'columns' => [
                    'chat_room_id' => [
                        'INT',
                        'NOT NULL'
                    ],
                    'group_id' => [
                        'INT',
                        'NOT NULL'
                    ],
                    'room_name' => [
                        'VARCHAR(48)',
                        'NOT NULL'
                    ]
                ]
            ],
            'chat_message' => [
                'columns' => [
                    'chat_message_id' => [
                        'INT',
                        'NOT NULL',
                        'AUTO_INCREMENT',
                        'PRIMARY KEY'
                    ],
                    'user_id' => [
                        'INT',
                        'NOT NULL'
                    ],
                    'message' => [
                        'VARCHAR(512)',
                        'NOT NULL'
                    ]
                ]
            ]
        ];
    }

}