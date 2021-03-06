# hp-test-task

## Usage

```bash
cp .env.docker .env
docker-compose up -d && docker-compose logs -f
```

## todo list

* [ ] Environment
    * [x] docker-compose 3.7
    * [x] postgres 10
    * [x] kafka 2.12
    * [ ] php 7.4
* [ ] Infrastructure(docker-compose based)
    * [x] zookeeper
    * [x] kafka cluster
    * [x] postgresql
    * [ ] Broker service
    * [x] Service A(name appender)
    * [ ] Service B(bye appender)
    * [ ] Requester service
    * [x] DB Migration. init.sql
* [ ] Services logic
  * [ ] Requester service
    * [ ] Sends "Hi" message to the broker service
    * [ ] Response wait interval 50ms - 1s. Unique identifier as the response payload
    * [ ] Prints the final message. Should be like {Hi} {First name} {Bye} 
  * [ ] Broker service
    * [ ] Listens for "Hi" message from the Requester
    * [ ] Stores "Hi" into db. Schema "Broker", table "request"
    * [ ] Returns identifier to the requester
    * [ ] Produces message to the kafkas' topic A
    * [ ] Waiting for the message from Service A
    * [ ] Sends the message from Service A to the Topic B*
    * [ ] Waiting for the message from Service B
    * [ ] Stores full message into db under unique identifier. Schema "Broker", table "request"
  * [ ] Service A
    * [ ] Listens Topic A
    * [ ] Adds a random name. List of names: Joao, Bram, Gabriel, Fehim, Eni, Patrick, Micha, Mirzet, Liliana, Sebastien.
    * [ ] Sends a changed message to the Broker service
  * [ ] Service B
    * [ ] Listens Topic B
    * [ ] Appends the word "Bye" to the received message.
    * [ ] Sends full message to the Broker service
