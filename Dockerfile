# Captive Portal
FROM ubuntu:14.04
MAINTAINER Paradrop Team <info@paradrop.io>

# Install dependencies.
RUN apt-get update && apt-get install -y \
	apache2 \
	iptables \
	rsyslog \
	dnsmasq \
	conntrack \
	aptitude \
	libapache2-mod-php5 \
    php5-curl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install files required by the chute.
ADD chute/000-default.conf /etc/apache2/sites-available/000-default.conf
ADD chute/cmd.sh /usr/local/bin/cmd.sh
ADD chute/rmtrack /usr/bin/rmtrack
ADD chute/index.php /var/www/index.php
ADD chute/poller.php /var/www/poller.php
ADD chute/dnsmasq.conf /etc/dnsmasq.conf
ADD chute/images/martini.jpg /var/www/martini.jpg
ADD chute/images/mintDrink.jpg /var/www/mintDrink.jpg
ADD chute/images/strawberryDrink.jpg /var/www/strawberryDrink.jpg
ADD chute/index.html /var/www/index.html
ADD chute/mystyle.css /var/www/mystyle.css
ADD chute/readImage.php /var/www/readImage.php
ADD chute/landing.php /var/www/landing.php


RUN echo "www-data ALL = NOPASSWD: /sbin/iptables *" >> /etc/sudoers.d/www-data
RUN echo "www-data ALL = NOPASSWD: /usr/bin/rmtrack [0-9]*.[0-9]*.[0-9]*.[0-9]*" >> /etc/sudoers.d/www-data

RUN echo "nameserver 127.0.0.1" > /etc/resolvconf/resolv.conf.d/base

# Set up permissions.
RUN chmod +x /usr/local/bin/cmd.sh && \
    chmod +x /usr/bin/rmtrack && \
    chmod 0755 /var/www/* && \
    touch /var/www/users && \
    chown www-data /var/www/*

CMD ["/usr/local/bin/cmd.sh"]
