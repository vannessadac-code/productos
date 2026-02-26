# Stage 1: Build frontend assets
FROM node:22-alpine AS frontend-builder
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: Build PHP dependencies
FROM composer:2 AS composer-builder
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --ignore-platform-reqs
COPY . .
RUN composer dump-autoload --optimize --no-dev --classmap-authoritative

# Stage 3: Final image
FROM dunglas/frankenphp:php8.4-alpine
WORKDIR /app

# Install PHP extensions
RUN install-php-extensions \
    pdo_pgsql \
    bcmath \
    pcntl \
    intl \
    zip \
    opcache

# Set environment variables
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV SERVER_NAME=:80

# Copy PHP dependencies and application code from composer-builder
COPY --from=composer-builder /app /app
# Copy built assets from frontend-builder
COPY --from=frontend-builder /app/public/build /app/public/build

# Copy entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose ports
EXPOSE 80
EXPOSE 443
EXPOSE 443/udp

ENTRYPOINT ["entrypoint.sh"]
CMD ["frankenphp", "php-server", "--root", "public/"]
