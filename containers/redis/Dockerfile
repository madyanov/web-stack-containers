FROM debian:stretch-slim
MAINTAINER Roman Madyanov <romantaken@gmail.com>

# Prepare
ENV DEBIAN_FRONTEND=noninteractive
COPY entrypoint.sh /

RUN apt-get update

# Install
RUN apt-get install -y --no-install-recommends redis-server

# Cleanup
RUN apt-get clean && \
    apt-get purge && \
    rm -rf /tmp/* /var/tmp/* && \
    rm -rf /var/lib/apt/lists/*

# Run
ENTRYPOINT ["/entrypoint.sh"]
CMD ["redis-server", "/etc/redis/redis.conf"]