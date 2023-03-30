# php-mysql-mongo


This is a simple PHP app that reads and displays dummy data to/from MySQL and MongoDB.

The Development version ships with Xdebug and otherwise for the Production version.

To run to app:

```
git clone https://github.com/enyioman/php-mysql-mongo.git

cd php-mysql-mongo
```

For Development:

```
docker compose -up --build frontend-dev
```

For Production:

```
docker compose -up --build frontend-prod
```