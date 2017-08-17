Набор Docker-контейнеров для разворачивания веб-приложений на стеке nginx + php + mysql + memcached + redis + ~~websocket-proxy~~.

### Структура

```
- containers/ - Контейнеры
- environments/ - Окружения (development, production, testing, ...)
    - <environment>/ - Конфигруация контейнеров окружения
- www/ – 
- base.yml
- <environment>.yml
```

### Запуск

