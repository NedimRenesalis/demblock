#!/bin/bash

# Build and apply migrations
docker-compose up --build -d
docker exec web_demblock_machinepicker composer install --no-interaction
docker exec web_demblock_machinepicker /bin/bash -c 'php yii migrate --interactive=0'