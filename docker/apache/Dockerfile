FROM httpd:2.4-alpine


RUN apk update

RUN apk add --no-cache bash

# COPY webapp.conf /usr/local/apache2/conf/webapp.conf
# RUN echo "Include /usr/local/apache2/conf/webapp.conf" \
#     >> /usr/local/apache2/conf/httpd.conf \
#     && echo "Include /usr/local/apache2/conf/httpd.conf" \
#     >> /etc/apache2/apache2.conf

# COPY demo.apache.conf /usr/local/apache2/conf/demo.apache.conf
RUN echo "Include /usr/local/apache2/conf/webapp.conf" \
    >> /usr/local/apache2/conf/httpd.conf





