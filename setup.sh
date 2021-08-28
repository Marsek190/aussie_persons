#!/usr/bin/env bash

sudo chmod -R gou+rwx ./logs
sudo chmod -R gou+rwx ./data
docker-compose down
docker-compose up -d --build

#mysql installing
while [ -z $(docker logs mysql 2>&1 | grep "mysqld: ready for connections") ]
do
    sleep 1
    echo "We are waiting for mysql to be ready."
done
if docker logs mysql 2>&1 | grep -Fxq "Initializing database"; then
  echo "Mysql inited."
fi

#install local scripts
for filename in ./local_tools/*; do
    sudo chmod +x $filename
done