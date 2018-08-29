Набор Docker-контейнеров для разворачивания веб-приложений, использующих Nginx, PHP, MySQL, Memcached, Redis, ~~WebSocket~~.

## Версии пакетов

- PHP 7.2.8
- MariaDB 10.1.26
- Nginx 1.10.3
- Memcached 1.4.33
- Redis 3.2.6

## Структура файлов

Конфигурационные файлы монтируются как отдельные тома, поэтому после изменения настроек окружения пересборка контейнеров не требуется, достаточно перезапустить работающие контейнеры.

```
.
├── containers                              # Dockerfile-ы контейнров
│   └── ...
│
├── environments                            # настройки окружений
│   ├── development                         # настройки development-окружения
│   │   ├── app
│   │   │   ├── scripts
│   │   │   │   ├── bootstra.sh             # скрипт, выполняющийся перед запуском приложения
│   │   │   │   ├── wait-for-services.php   # скрипт, ожидающий запуска всех сервисов
│   │   │   │   └── ...
│   │   │   │
│   │   │   ├── app.env                     # переменные окружения, доступные приложению
│   │   │   ├── fpm-global.conf             # настройки PHP-FPM
│   │   │   ├── fpm-www.conf                # настройки пула www
│   │   │   └── php.ini                     # настройки PHP
│   │   │
│   │   ├── memcached
│   │   │   └──memcached.conf               # настройки Memcached
│   │   │
│   │   ├── mysql
│   │   │   ├── mysql.env                   # переменные окружения MySQL, доступные приложению (user, password, database)
│   │   │   └── server.cnf                  # настройки MySQL
│   │   │
│   │   ├── nginx
│   │   │   ├── nginx.conf                  # настройки nginx
│   │   │   └── sites                       # настройки сайтов
│   │   │       ├── app.conf
│   │   │       └── ...
│   │   │
│   │   └──redis
│   │       └── redis.conf                  # настройки Redis
│   │
│   ├── production                          # настройки production-окружения
│   │   └── ...
│   │
│   ├── testing                             # настройки testing-окружения
│   │   └── ...
│   │
│   └── <environment>                       # настройки других окружений
│       └── ...
│
├── www                                     # код приложения
│   └── public
│       ├── index.php
│       └── ...
│
├── base.yml                                # базовая конфигурация docker-compose, от которой наследуются конфигурации окружений
├── development.yml                         # конфигурация docker-compose development-окружения
├── production.yml                          # конфигурация docker-compose production-окружения
├── testing.yml                             # конфигурация docker-compose testing-окружения
└── <environment>.yml                       # конфигурация docker-compose других окружений
```

## Установка и запуск

```bash
$ git clone https://github.com/madyanov/web-stack-containers
$ cd web-stack-containers
```

```bash
$ ./start.sh development ../path-to-app-www-dir
```

Первый аргумент – название используемого окружения из папки `environments`.

Второй агрумент – путь до кода приложения (по умолчанию `./www`).

## Перезапуск и остановка

```bash
$ ./restart.sh development
```

```bash
$ ./stop.sh development
```

## Примечания

- **При первом запуске будет сгенерирован MySQL root password, сохраните его:**
    ```
    ========================
    Generated root password: **********
    ========================
    ```
- Точка входа (`index.php`) обязательно должна быть в папке `public` в папке приложения (по умолчанию `www/public/index.php`).
- Сразу перед запуском приложения выполняется скрипт `environments/<environment>/app/scripts/bootstrap.sh`. Его можно использоваь для ожидания запуска сервисов, установки зависимостей `composer`, тестов и прочего).
- Приложению доступна переменная окружения `ENVIRONMENT`, равная названию используемого окружения (`development`, `production`, ...), а также любые переменные окружения из файла `environments/<environment>/app/app.env`.
