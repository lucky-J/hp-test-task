<?php

return [
    'kafka' => [
        'connection' => [
            'hosts' => [
                'kafka:9092'
            ]
        ],
        'consumers'  => [
            'consumerRevA' => [
                'topic' => 'TopicRevA',
                'group_id' => uniqid(),
                'auto_commit_timeout' => '100',
                'offset_store_method' => 'broker',
                'auto_reset_offset' => 'earliest'
            ],
            'consumerRevB' => [
                'topic' => 'TopicRevB',
                'group_id' => uniqid(),
                'auto_commit_timeout' => '100',
                'offset_store_method' => 'broker',
                'auto_reset_offset' => 'earliest'
            ],
        ],
        'producers'  => [
            'producerA' => [
                'topics' => [
                    'TopicA',
                ]
            ],
            'producerB' => [
                'topics' => [
                    'TopicB',
                ]
            ],
        ],
    ]
];
