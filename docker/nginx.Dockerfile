FROM node:14.20-alpine as node_modules_sportisimo
WORKDIR /tmp
ADD ./ /tmp/
RUN npm install; \
    npm run build

FROM nginx:alpine

WORKDIR /var/www/sportisimo/
COPY --from=node_modules_sportisimo /tmp/node_modules/ ./node_modules/
COPY --from=node_modules_sportisimo /tmp/www/ ./www/

WORKDIR /var/www/
RUN set -eux;