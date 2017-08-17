Набор Docker-контейнеров для разворачивания веб-приложений, использующих nginx, PHP, MySQL, Memcached, Redis, ~~WebSocket~~.

Контейнеры базируются на Debian Stretch (slim-версия). Приложения устанавливаются из официального стабильного репозитория Debian.

### Структура

```
containers - Dockerfile-ы контейнров
└───...
environments
└─── <environment>
│   └───app
│   │       app.env – переменные окружения приложения (будут доступны через getenv)
│   │       fpm-global.conf – общие настройки PHP-FPM
│   │       fpm-www.conf – настройки пула www
│   │       php.ini – настройки PHP
│   │
│   └───memcached
│   │       memcached.conf – настройки Memcached
│   │
│   └───mysql
│   │       mysql.env – переменные окружения MySQL (user, password, database), доступны также приложению
│   │       server.cnf – настройки MySQL
│   │
│   └───nginx
│   │   │   nginx.conf – общие настройки nginx
│   │   │   
│   │   └───sites
│   │           app.conf – настройки сервера
│   │
│   └───redis
│           redis.conf – настройки Redis
│
└───...
www – код тестового приложения
└───...
base.yml – базовая конфигурация docker-compose
<environment>.yml – конфигурация docker-compose конкретного окружения
```

После изменения настроек окружения пересборка контейнеров не требуется. Достаточно перезапустить работающие контейнеры.

### Запуск

```
$ git clone https://github.com/madyanov/web-stack-containers
$ cd web-stack-containers
$ ./deply.sh <environment> ../path-to-app-code
```

Первый аргумент – название используемого окружения из папки `environments`.

Второй агрумент – путь до кода приложения (по умолчанию `./www`). Точка входа (`index.php`) обязательно должна быть в папке `public`.

- **При первом запуске будет сгенерирован root password MySQL, его нужно сохранить:**
    ```
    ========================
    Generated root password: **********
    ========================
    ```
- Сразу перед запуском приложения выполняется скрипт `bootstrap.sh` в директории приложения (например, для запуска composer, тестов и прочего). В качестве примера можно использовать `www/bootstrap.sh`, который ожидает запуска зависимостей.
- Приложению доступна переменная окружения `ENVIRONMENT`, равная названию используемого окружения.