cp /usr/src/app/class/.env.dist /usr/src/app/class/.env && \
composer install -d /usr/src/app/class && \
bin/console --no-interaction doctrine:migrations:migrate