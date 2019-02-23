#!/bin/bash

export MYSQL_DATABASE="zaposljavanje"
export MYSQL_USER="zaposljavanje"

# Build and apply migrations
docker-compose up --build -d
docker exec web_demblock_machinepicker /bin/bash -c 'composer install --no-interaction'
docker exec web_demblock_machinepicker /bin/bash -c 'php yii migrate --interactive=0'