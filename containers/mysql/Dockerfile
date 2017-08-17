FROM jwilder/dockerize AS dockerize

FROM debian:stretch-slim
MAINTAINER Roman Madyanov <romantaken@gmail.com>

# Prepare
ENV DEBIAN_FRONTEND=noninteractive
COPY entrypoint.sh /
COPY --from=dockerize /usr/local/bin/dockerize /usr/local/bin

RUN apt-get update

# Install
RUN apt-get install -y --no-install-recommends mariadb-server pwgen

RUN mkdir /var/run/mysqld && \
    rm -rf /var/lib/mysql/* && \
    chown -R mysql:mysql /var/run/mysqld /var/lib/mysql

# Cleanup
RUN apt-get clean && \
    apt-get purge && \
    rm -rf /tmp/* /var/tmp/* && \
    rm -rf /var/lib/apt/lists/*

# Run
ENTRYPOINT ["/entrypoint.sh"]
CMD ["mysqld", "--console", "--user=mysql"]