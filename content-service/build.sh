#!/bin/bash

# build the web docker
base_dir="$( cd "$(dirname "$0")" ; pwd -P )"

cd $base_dir

echo `git rev-list HEAD -n 1 | cut -c 1-7` > "docker/version.log"

mvn clean
mvn package -DskipTests || exit $?

cp target/content-service-1.0-SNAPSHOT.jar ./docker/

cd $base_dir/docker

dos2unix run.sh

docker build --tag=47.105.65.19:5000/pf-cms-content . || exit $?
docker push 47.105.65.19:5000/pf-cms-content || exit $?