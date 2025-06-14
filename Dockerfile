# Dockerfile

# Stage 1: Build assets with Node.js
FROM node:18-alpine AS assets-builder
WORKDIR /var/www/html
COPY package.json ./
RUN npm install
COPY tailwind.config.js postcss.config.js ./
COPY src/css ./src/css
COPY app ./app
COPY public ./public
RUN npm run build \
    && cp node_modules/alpinejs/dist/cdn.min.js public/dist/alpine.min.js

# Stage 2: Setup PHP with extensions and composer
FROM php:8.1-fpm-alpine AS fpm
RUN apk add --no-cache postgresql-dev libpq git unzip \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .
RUN composer install --optimize-autoloader --no-dev

# Copy entrypoint and make it executable
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Copy built assets
COPY --from=assets-builder /var/www/html/public/dist ./public/dist

RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000
ENTRYPOINT ["docker-entrypoint.sh"]
# Stage 3: Nginx with assets
FROM nginx:alpine AS web
WORKDIR /var/www/html
COPY --from=assets-builder /var/www/html/public /var/www/html/public
COPY nginx/default.conf /etc/nginx/conf.d/default.conf