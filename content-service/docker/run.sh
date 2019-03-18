#!/bin/bash
if [ -z "$PROFILES" ]; then
  PROFILES="prod"
fi

echo java -jar -agentlib:jdwp=transport=dt_socket,server=y,suspend=n,address=5005 -Dfile.encoding=UTF-8 -Dspring.profiles.active=$PROFILES $JVM_OPTS /opt/content-service-1.0-SNAPSHOT.jar
java -jar -agentlib:jdwp=transport=dt_socket,server=y,suspend=n,address=5005 -Dfile.encoding=UTF-8 -Dspring.profiles.active=$PROFILES $JVM_OPTS /opt/content-service-1.0-SNAPSHOT.jar

