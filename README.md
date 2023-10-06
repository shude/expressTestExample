# Демонстрационный проект

## Установка и запуск Mac OS / Linux

```shell
startup.sh
```

## Установка и и запуск Windows

```shell
docker compose build
docker compose run --rm php composer install
docker compose up -d
docker compose run --rm -ti php bin/console d:d:c
docker compose run --rm -ti php bin/console d:m:m
docker compose run --rm -ti php bin/console doctrine:fixtures:load
docker compose exec -ti php php -S 0.0.0.0:8080 -t public/
```

### Описание настроек

Тесты, вопросы и ответы можно добавить в ```src/ExpressTest/DataFixtures/ExpressTestFixtures.php```  
  
### Настройка выдачи вопросов и ответов
По умолчанию вопросы и ответы выводятся в том порядке в котором заносились в БД.
Изменить поведение можно в ```services.yaml```:  
```yaml
    App\ExpressTest\Loader\Answer\AnswerStrategyInterface:
        alias: direct.answer.strategy   # shuffle.answer.strategy    - случайная выдача вариантов
    App\ExpressTest\Loader\Question\NextQuestionStrategyInterface:
        alias: direct.question.strategy # shuffle.question.strategy  - случайная выдача вопросов
```