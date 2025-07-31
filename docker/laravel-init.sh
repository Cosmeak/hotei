set -e

for d in \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views  \
    storage/logs \
    bootstrap/cache
do
    mkdir -p "/var/www/html/$d"
done

chown -R nobody:nobody /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775           /var/www/html/storage /var/www/html/bootstrap/cache

exec "$@"