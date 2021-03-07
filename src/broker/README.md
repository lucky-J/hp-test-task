# Proxy Service Broker

Proxies the queries from client to the system and store data into a database.

## Ecosystem
```
├── App
│     ├── App.php    - app kernel
│     ├── Command    - console commands
│     ├── Consumer   - kafka's consumers
│     ├── Exception  - custom exceptioons
│     ├── Factory    - services factories
│     ├── Model      - models and DTOs
│     ├── Producer   - kafka's producers
│     └── Repository - DB Repositories
├── cli    - console entrypoint
├── config - service's configuration fies and php-di services declarations
└── vendor - external libraries
```
## How to run consumers

Broker has 2 kafkas' consumers:
* ConsumerA - listens to TopicRevA topic that delivers messages from the ServiceA
* ConsumerB - listens to TopicRevB topic that delivers messages from the ServiceB

Each consumer runs separately by `cli/app.php` which handle input argv to the application commands.

Run `bash php cli/app.php list` to see list of available commands

## Producers

Application has 2 producers:
* ProducerA - sends a message to the TopicA
* ProducerB - sends a message to the TopicB

Usage example
```php
$app = \App\App::make();
$producer = $app->getContainer()->get('producerA');
$message = new \App\Model\Kafka\SimpleMessage(123, 'Text');
$producer->publish($message);
```

## Ideas

* Move common abstractions to the separate library. Or maybe, create micro framework
* \SplObserver and \SplSubject for internal events
* Events on request table record update 