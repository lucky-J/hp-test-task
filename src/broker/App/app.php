<?php

use RdKafka\TopicConf;

require __DIR__ . '/../vendor/autoload.php';

// producer topics: topicA and topicB
$conf = new \RdKafka\Conf();
$conf->set('metadata.broker.list', 'kafka:9092');
$producerA = new \RdKafka\Producer($conf);
//$producerB = clone $producerA;
$topic = $producerA->newTopic('topicA');
for ($i = 0; $i < 10; $i++) {
    $topic->produce(RD_KAFKA_PARTITION_UA, 0, "Hi $i");
    $producerA->poll(0);
}

$result = null;
for ($flushRetries = 0; $flushRetries < 10; $flushRetries++) {
    $result = $producerA->flush(10000);
    if (RD_KAFKA_RESP_ERR_NO_ERROR === $result) {
        break;
    }
}

if (RD_KAFKA_RESP_ERR_NO_ERROR !== $result) {
    throw new \RuntimeException('Was unable to flush, messages might be lost!');
}

// subscriber topics: topicRevA and topicRevB
$consumerConf =new \RdKafka\Conf();
$consumerConf->set('metadata.broker.list', 'kafka:9092');
$consumerConf->set('group.id', 'myConsumerGroup');
$consumerA = new \RdKafka\Consumer($consumerConf);

$topicConf = new TopicConf();
$topicConf->set('auto.commit.interval.ms', '100');
$topicConf->set('offset.store.method', 'broker');
$topicConf->set('auto.offset.reset', 'earliest');

$t2 = $consumerA->newTopic('topicA', $topicConf);
$t2->consumeStart(0, RD_KAFKA_OFFSET_STORED);

for ($i = 0; $i < 10; $i++) {
    $message = $t2->consume(0, 120*1000);
    echo $message->payload . PHP_EOL;
}

