FROM debian:stretch-slim

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update
RUN apt-get install -y --no-install-recommends nginx

RUN rm -rf /etc/nginx/sites-available/* && \
    rm -rf /etc/nginx/sites-enabled/* && \
    rm -rf /etc/nginx/conf.d/* && \
    rm -rf /var/www/html/*

RUN apt-get clean && \
    apt-get purge && \
    rm -rf /tmp/* /var/tmp/* && \
    rm -rf /var/lib/apt/lists/*

CMD ["nginx", "-g", "daemon off;"]
