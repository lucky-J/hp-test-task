<?php

declare(strict_types=1);

namespace App\Factory;

use App\Producer\Producer;
use App\Producer\ProducerInterface;
use RdKafka\Conf;
use RdKafka\ConsumerTopic;
use RdKafka\Producer as VendorProducer;
use RdKafka\TopicConf;

class KafkaFactory
{
    public static function createProducer(array $config, string $producerName): ProducerInterface
    {
        $rdKafkaProducer = new VendorProducer(new Conf());
        $rdKafkaProducer->addBrokers(implode(', ', $config['connection']['hosts']));
        $topics = [];
        foreach ($config['producers'][$producerName]['topics'] as $topic) {
            $topics[] = $rdKafkaProducer->newTopic($topic);
        }

        return new Producer($rdKafkaProducer, $topics);
    }

    public static function createConsumerTopic(array $config, string $consumerName): ConsumerTopic
    {
        $consumerRawConf = $config['consumers'][$consumerName];
        $consumerConf =new Conf();
        $consumerConf->set('metadata.broker.list', implode(', ', $config['connection']['hosts']));
        $consumerConf->set('group.id', $consumerRawConf['group_id']);

        $topicConf = new TopicConf();
        $topicConf->set('auto.commit.interval.ms', $consumerRawConf['auto_commit_timeout']);
        $topicConf->set('offset.store.method', $consumerRawConf['offset_store_method']);
        $topicConf->set('auto.offset.reset', $consumerRawConf['auto_reset_offset']);

        return (new \RdKafka\Consumer($consumerConf))->newTopic($consumerRawConf['topic'], $topicConf);
    }
}
