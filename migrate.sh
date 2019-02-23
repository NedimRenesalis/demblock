#!/bin/bash

# Build and apply migrations
docker-compose up -d --build
docker exec web_demblock_login php yii migrate --interactive=0