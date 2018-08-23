FROM debian:stretch-slim

ENV DEBIAN_FRONTEND=noninteractive
COPY entrypoint.sh /

RUN apt-get update
RUN apt-get install -y --no-install-recommends ca-certificates mariadb-server pwgen wget

ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz && \
    echo "f3d77239644ecaa53b762c9bfce8e9547399eea4 dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz" | sha1sum -c - && \
    tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz && \
    rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

RUN mkdir /var/run/mysqld && \
    rm -rf /var/lib/mysql/* && \
    chown -R mysql:mysql /var/run/mysqld /var/lib/mysql

RUN apt-get clean && \
    apt-get purge && \
    rm -rf /tmp/* /var/tmp/* && \
    rm -rf /var/lib/apt/lists/*

ENTRYPOINT ["/entrypoint.sh"]
CMD ["mysqld", "--console", "--user=mysql"]
