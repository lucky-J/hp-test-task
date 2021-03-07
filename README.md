# hp-test-task

## Usage

```bash
cp .env.docker .env
docker-compose up -d && docker-compose logs -f
```

## todo list
* [ ] improve consumers. set offset to avoid message duplication 
* [ ] Environment
    * [x] docker-compose 3.7
    * [x] postgres 10
    * [x] kafka 2.12
    * [x] php 7.4
* [ ] Infrastructure(docker-compose based)
    * [x] zookeeper
    * [x] kafka cluster
    * [x] postgresql
    * [x] Broker service
    * [x] Service A(name appender)
    * [x] Service B(bye appender)
    * [ ] Requester service
    * [x] DB Migration. init.sql
    * [x] Add `composer install` to the services Dockerfile
* [ ] Services logic
  * [ ] Requester service
    * [ ] Sends "Hi" message to the broker service
    * [ ] Response wait interval 50ms - 1s. Unique identifier as the response payload
    * [ ] Prints the final message. Should be like {Hi} {First name} {Bye} 
  * [ ] Broker service
    * [ ] Listens for "Hi" message from the Requester
    * [x] Stores "Hi" into db. Schema "Broker", table "request"
    * [ ] Returns identifier to the requester
    * [x] Produces message to the kafkas' topic A
    * [x] Waiting for the message from Service A
    * [x] Sends the message from Service A to the Topic B
    * [x] Waiting for the message from Service B
    * [x] Stores full message into db under unique identifier. Schema "Broker", table "request"
    * [ ] Returns full message to the client
  * [x] Service A
    * [x] Listens Topic A
    * [x] Validate incoming message
    * [x] Adds a random name. List of names: Joao, Bram, Gabriel, Fehim, Eni, Patrick, Micha, Mirzet, Liliana, Sebastien.
    * [x] Sends a changed message to the Broker service
  * [x] Service B
    * [x] Listens Topic B
    * [x] Validate incoming message
    * [x] Appends the word "Bye" to the received message.
    * [x] Sends full message to the Broker service
