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
                'topic' => 'TopicA',
                'group_id' => 'testgroup',
                'auto_commit_timeout' => '100',
                'offset_store_method' => 'broker',
                'auto_reset_offset' => 'earliest'
            ]
        ],
        'producers'  => [
            'producerA' => [
                'topics' => [
                    'TopicA',
                ]
            ],
        ],
    ]
];
