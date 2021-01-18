# for php with fpm
FROM nginx:alpine

# Add the startup script and set executable
COPY nginx-entrypoint.sh /usr/bin/nginx-entrypoint.sh
RUN chmod +x /usr/bin/nginx-entrypoint.sh

# add certificates
ADD certs/nginx-selfsigned.crt /etc/ssl/certs/server.crt
ADD certs/nginx-selfsigned.key /etc/ssl/certs/server.key
ADD certs/cacert.pem /etc/ssl/certs/cacert.pem

#WORKDIR /var/www/html