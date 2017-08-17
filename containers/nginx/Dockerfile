FROM debian:stretch-slim
MAINTAINER Roman Madyanov <romantaken@gmail.com>

# Prepare
ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update

# Install
RUN apt-get install -y --no-install-recommends nginx

# Configure
RUN rm -rf /etc/nginx/sites-available/* && \
    rm -rf /etc/nginx/sites-enabled/* && \
    rm -rf /etc/nginx/conf.d/* && \
    rm -rf /var/www/html/*

# Cleanup
RUN apt-get clean && \
    apt-get purge && \
    rm -rf /tmp/* /var/tmp/* && \
    rm -rf /var/lib/apt/lists/*

# Run
CMD ["nginx", "-g", "daemon off;"]