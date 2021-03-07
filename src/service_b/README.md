# Service B

* Listens to TopicB
* Appends a word 'Bye' to the received message
* Sends the modified message to the TopicRevB 

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
docker-compose exec service-b php 'cli/app.php consumer:listen'
```

Otherwise, it should be executed automatically