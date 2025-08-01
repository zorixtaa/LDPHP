# Placeholder multi-stage Dockerfile
FROM php:8.5-fpm AS base
WORKDIR /var/www/html

FROM node:20 as frontend
WORKDIR /app

FROM base AS final
COPY --from=frontend /app/build /var/www/html/public
CMD ["php-fpm"]
