Набор Docker-контейнеров для разворачивания веб-приложений, использующих nginx, PHP, MySQL, Memcached, Redis, ~~WebSocket~~.

### Структура

```
- containers/ - Dockerfile-ы контейнров
- environments/ - окружения (development, production, testing, ...)
    - <environment>/ - конфигруация контейнеров конкретного окружения
- www/ – код тестового приложения
- base.yml – базовая конфигурация docker-compose
- <environment>.yml – конфигурация docker-compose конкретного окружения
```

### Запуск

```
$ git clone https://github.com/madyanov/web-stack-containers
$ cd web-stack-containers

$ ./deply.sh <environment> ../path-to-project-code
```

Первый аргумент – название используемого окружения из папки `environments`.

Второй агрумент – путь до кода приложения (по умолчанию `www`).

Сразу перед запуском приложения выполняется скрипт `bootstrap.sh` в директории приложения (например, для запуска композера, тестов и прочего).