# hp-test-task

## Usage

```bash
cp .env.docker .env
docker-compose up -d && docker-compose logs -f
```

## todo list

* [ ] Environment
    * [ ] docker 3.7
    * [ ] postgres 10
    * [ ] kafka 2.12
    * [ ] php 7.4
* [ ] Infrastructure(docker-compose based)
    * [ ] zookeeper
    * [ ] kafka cluster
    * [ ] postgresql
    * [ ] Broker service
    * [ ] Service A(name appender)
    * [ ] Service B(bye appender)
    * [ ] Requester service
    * [ ] DB Migration service. Flyway
* Services logic
  * [ ] Flyway
    * [ ] Run migration. Create a table named "request" under "Broker" schema
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
