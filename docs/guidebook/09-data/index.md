# Guidebook > Data

Following the CQRS pattern, entities have a single write model and can have multiple read models 

## Write

There are three main write aggregates, covering Customers, Orders and Products.

![Entity-Relationship Diagram](./entity-relationship-diagram-main.png "Entity-Relationship Diagram")

Additional aggregates include the Basket.

![Entity-Relationship Diagram](./entity-relationship-diagram-additional.png "Entity-Relationship Diagram")

## Read

Currently, only the Basket has a read model (including the price and title from Sku)

![Entity-Relationship Diagram](./entity-relationship-diagram-read.png "Entity-Relationship Diagram")
