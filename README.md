# hp-test-task

## Usage

* Start testing
```bash
cp .env.docker .env
docker-compose up -d
```
* For development
```bash
cp .env.docker.dev .env
docker-compose up -d
```

* [Emulate client request](./src/requester/README.md#usage) a.k.a. test functionality

## Final result
```text
root@cfa532390b82:/var/www/html# while true; do php cli/app.php ; done
200
{"message":"Hi Bram Bye"}
200
{"message":"Hi Gabriel Bye"}
200
{"message":"Hi Eni Bye"}
200
{"message":"Hi Fehim Bye"}
200
{"message":"Hi Patrick Bye"}
200
{"message":"Hi Patrick Bye"}
200
{"message":"Hi Patrick Bye"}
200
{"message":"Hi Mirzet Bye"}
200
{"message":"Hi Liliana Bye"}
200
{"message":"Hi Micha Bye"}
200
{"message":"Hi Eni Bye"}
200
{"message":"Hi Gabriel Bye"}
200
{"message":"Hi Fehim Bye"}
200
{"message":"Hi Fehim Bye"}
200
{"message":"Hi Joao Bye"}
200
{"message":"Hi Patrick Bye"}
200
{"message":"Hi Sebastien Bye"}
200
{"message":"Hi Bram Bye"}
^C
root@cfa532390b82:/var/www/html#
```

## List of improves can be done
* Avoid processing queue duplication messages
* Logger for services
* Test with kafka cluster. Was tested only with standalone kafka
* Improve consumers speed. They are too slow. It can't be so. Maybe, instead of subscriber assign must be used when we have offset.
* brokers' web entrypoint, which is `index.php` should be refactored. Move logic to the router component and Controller
* If we look through all php service we'll see lots of common code, which can be moved to the common library. Also,
  micro-framework can be an option.
* docker-compose not well optimized. Hardcoded values, some config duplications, kafka cluster and zookeeper in standalone mode

## List of docs
- [requester doc](./src/requester/README.md)
- [broker doc](./src/broker/README.md)
- [Service A doc](./src/service_a/README.md)
- [Service B doc](./src/service_b/README.md)

## todo list
* [x] Environment
    * [x] docker-compose 3.7
    * [x] postgres 10
    * [x] kafka 2.12
    * [x] php 7.4
* [x] Infrastructure(docker-compose based)
    * [x] zookeeper
    * [x] kafka cluster
    * [x] postgresql
    * [x] Broker service
    * [x] Broker supervisor service
    * [x] Service A(name appender)
    * [x] Service B(bye appender)
    * [x] Requester service
    * [x] DB Migration. init.sql
    * [x] Add `composer install` to the services Dockerfile
* [x] Services logic
  * [x] Requester service
    * [x] Sends "Hi" message to the broker service
    * [x] Response wait interval 50ms - 1s. Unique identifier as the response payload
    * [x] Prints the final message. Should be like {Hi} {First name} {Bye} 
  * [x] Broker service
    * [x] Listens for "Hi" message from the Requester
    * [x] Stores "Hi" into db. Schema "Broker", table "request"
    * [x] Returns identifier to the requester
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
