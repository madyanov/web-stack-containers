FROM debian:stretch-slim

ENV DEBIAN_FRONTEND=noninteractive
COPY start-memcached.pl /

RUN apt-get update
RUN apt-get install -y --no-install-recommends memcached

RUN apt-get clean && \
    apt-get purge && \
    rm -rf /tmp/* /var/tmp/* && \
    rm -rf /var/lib/apt/lists/*

CMD ["./start-memcached.pl"]
