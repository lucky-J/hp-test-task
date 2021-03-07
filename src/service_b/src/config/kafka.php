<?php

return [
    'kafka' => [
        'connection' => [
            'hosts' => [
                'kafka:9092'
            ]
        ],
        'consumers'  => [
            'consumerA' => [
                'topic' => 'TopicB',
                'group_id' => uniqid(),
                'auto_commit_timeout' => '100',
                'offset_store_method' => 'broker',
                'auto_reset_offset' => 'earliest'
            ],
        ],
        'producers'  => [
            'producerA' => [
                'topics' => [
                    'TopicRevB',
                ]
            ],
        ],
    ]
];
