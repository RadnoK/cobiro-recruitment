FROM nginx:1.15-alpine AS base

WORKDIR /var/www/cobiro

COPY public/ public/

FROM base AS dev

FROM base AS prod
COPY docker/nginx/api-prod.conf /etc/nginx/conf.d/default.conf
