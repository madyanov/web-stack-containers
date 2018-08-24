#!/bin/bash

if [ ! -d /var/lib/mysql/mysql ]; then
    echo
    echo "Init MySQL users and databases"
    echo

    mysql_install_db
    mysqld --skip-networking &

    for i in {30..0}; do
        if echo "SELECT 1" | mysql &> /dev/null; then
            break
        fi

        echo "MySQL init process in progress..."
        sleep 1
    done

    echo "SET @@SESSION.SQL_LOG_BIN = 0;" | mysql
    echo "DROP DATABASE IF EXISTS test;" | mysql
    echo "DELETE FROM mysql.user;" | mysql

    if [ "$MYSQL_DATABASE" ]; then
        echo "CREATE DATABASE IF NOT EXISTS \`$MYSQL_DATABASE\`;" | mysql
    fi

    if [ "$MYSQL_USER" -a "$MYSQL_PASSWORD" ]; then
        echo "CREATE USER '$MYSQL_USER'@'%' IDENTIFIED BY '$MYSQL_PASSWORD';" | mysql

        if [ "$MYSQL_DATABASE" ]; then
            echo "GRANT ALL ON \`$MYSQL_DATABASE\`.* TO '$MYSQL_USER'@'%';" | mysql
        fi
    fi

    MYSQL_ROOT_PASSWORD=$(pwgen -1 32)
    echo "CREATE USER 'root'@'%' IDENTIFIED BY '$MYSQL_ROOT_PASSWORD';" | mysql
    echo "GRANT ALL ON *.* TO 'root'@'%' WITH GRANT OPTION;" | mysql
    echo "FLUSH PRIVILEGES;" | mysql

    kill -s TERM "$!"
    wait "$!"

    echo
    echo "MySQL init process done"
    echo
    echo "========================"
    echo "Generated root password: $MYSQL_ROOT_PASSWORD"
    echo "========================"
    echo
fi

exec dockerize --stdout /var/log/mysql/error.log "$@"
