FROM cubesky/ssh-with-java

WORKDIR /opt/
COPY content-service-1.0-SNAPSHOT.jar /opt/
COPY run.sh /opt/run.sh
RUN chmod +x /opt/run.sh

RUN cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime && echo 'Asia/Shanghai' >/etc/timezone
COPY version.log /opt/

EXPOSE 9061
ENTRYPOINT ["/opt/run.sh"]