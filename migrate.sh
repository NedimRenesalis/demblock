#!/bin/bash

# Build and apply migrations
docker-compose up -d --build
docker exec -it web_demblock_machinepicker /bin/bash ./run.sh