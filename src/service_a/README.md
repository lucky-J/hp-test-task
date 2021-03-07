# Service A

* Listens to the kafka's TopicA
* Adds a random name to the received message
* Sends the modified message to the kafka's TopicRevA

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
├── cli    - console entrypoint
├── config - service's configuration fies and php-di services declarations
└── vendor - external libraries
```

## Run consumer
If containers were built with docker-compose.dev.yml then run next
```bash
docker-compose exec service-a php 'cli/app.php consumer:listen'
```

Otherwise, it should be executed automatically