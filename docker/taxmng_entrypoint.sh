#!/bin/bash

set -e

nginx -g 'daemon on;'

OUTPUT_FILE="/var/run/hhvm/hhvm.hhbc"

# Check if hhbc file exists

if [ ! -f "$OUTPUT_FILE" ]; then
    >&2 echo "Compile php code ...!"

    touch /var/run/hhvm/fileindex

    INDEX_TMP="/var/run/hhvm/fileindex"

    find $PHP_SRC_ROOT -name \*.php > $INDEX_TMP

    hhvm --hphp -t hhbc --input-list $INDEX_TMP -v AllVolatile=true --optimize-level 0 --output-dir /var/run/hhvm/

    >&2 echo "Clear file content"
    while read -u 10 p; do
      truncate -s 0 $p
    done 10<$INDEX_TMP
fi

cp $OUTPUT_FILE /var/www/html/

host=${MYSQL_HOST_ADDR:-mariadb}
password=${MYSQL_ROOT_PASSWORD:-root}

until mysql -h "$host" -uroot -p${password}; do
  >&2 echo "MYSQL is unavailable - sleeping"
  sleep 1
done

>&2 echo "MYSQL is up - executing command"

# start service
>&2 echo "Start migration ...!"

php /var/www/html/yii.php migrate --migrationPath=@vendor/dektrium/yii2-user/migrations --interactive=0

php /var/www/html/yii.php migrate --migrationPath=@yii/rbac/migrations --interactive=0

php /var/www/html/yii.php migrate --interactive=0

if [ "$PK_ENVIRONMENT" == "test" ]; then
    echo "--------------------You are in test environment--------------------"
else
	echo "--------------------You are in product environment--------------------"
fi

>&2 echo "Start hhvm service ...!"

exec "$@"
