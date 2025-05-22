FROM serversideup/php:8.3-cli-alpine

USER root

ARG USER_ID
ARG GROUP_ID

RUN docker-php-serversideup-set-id www-data $USER_ID:$GROUP_ID

USER www-data
