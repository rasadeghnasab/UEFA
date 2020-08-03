<?php

return [
    'conditions' => [
        'lowercase' => [
            'check' => false,
            'regex' => '@[A-Z]@'
        ],

        'uppercase' => [
            'check' => false,
            'regex' => '@[a-z]@'
        ],

        'number' => [
            'check' => true,
            'regex' => '@[0-9]@'
        ],
    ],
    'min-length' => [
        'check' => true,
        'length' => 8
    ]
];
