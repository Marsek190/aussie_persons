CONTAINER=mysql

# Backup
docker exec $CONTAINER sh -c \
    'mysqldump --all-databases --quick --single-transaction --skip-lock-tables --flush-privileges -uroot -p"$MYSQL_ROOT_PASSWORD"' \
    | gzip > ./backup.sql.gz

# Restore
gunzip ./backup.sql.gz
cat backup.sql | docker exec -i $CONTAINER sh -c 'mysql -uroot -p"$MYSQL_ROOT_PASSWORD"'
