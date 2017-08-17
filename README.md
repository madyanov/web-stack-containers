Набор Docker-контейнеров для разворачивания веб-приложений на стеке nginx + php + mysql + memcached + redis + ~~websocket-proxy~~.

### Структура

```
- containers/ - Dockerfile-ы контейнров
- environments/ - окружения (development, production, testing, ...)
    - <environment>/ - конфигруация контейнеров конкретного окружения
- www/ – код приложения по умолчанию
- base.yml – базовая конфигурация docker-compose
- <environment>.yml – конфигурация docker-compose конкретного окружения
```

### Запуск

```
$ git clone https://github.com/madyanov/web-stack-containers
$ cd web-stack-containers
$ ./deply.sh <environment> ../path-to-project-code
```

Первый аргумент – название окружения из папки `environments`.

Второй агрумент – путь до проекта (PHP-кода), по умолчанию имеет значение `./www`.

После запуска выполняется скрипт `bootstrap.sh` в папке проекта, в котором может быть запуск композера, тестов и прочего.