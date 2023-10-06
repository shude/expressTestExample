#!/usr/bin/env bash
#if [ "$(uname)" = "Darwin" ]; then
    export PHP_XDEBUG_CLIENT_HOST=host.docker.internal
    dc=(docker compose)
#else
    dc=(docker compose)
#fi

#if [ "$(uname)" = "Linux" ]; then
    export PHP_XDEBUG_CLIENT_HOST=172.17.0.1
#fi

help(){
  printf "Usage :\n\n"
  printf "help         - Show this help page.\n"
  printf "up           - docker compose up -d\n"
  printf "down         - docker compose down\n"
  printf "com          - composer\n"
  printf "run          - bin/console without XDebug\n"
  printf "deb          - bin/console with XDebug\n"
  printf "migrate      - bin/console doctrine:migrations:migrate\n"
  printf "fixtures     - bin/console --env=test doctrine:fixtures:load\n"
  printf "sql          - bin/console --env=test doctrine:query:sql\n"
  printf "start-server - Start a builtin PHP Web server\n"
}

#Composer
com(){
	"${dc[@]}" run --rm -e PHP_XDEBUG_MODE=off php composer "$@"
}

#docker-compose up
up(){
  export PHP_XDEBUG_MODE=off
	"${dc[@]}" up -d
}

up-debug(){
  export PHP_XDEBUG_MODE=debug
  "${dc[@]}" up -d
}

#docker-compose down
down(){
	"${dc[@]}" down
}

#Symfony cli
run(){
	"${dc[@]}" run --rm -e PHP_XDEBUG_MODE=off php bin/console "$@"
}

#Symfony cli with debug=ON
deb() {
  "${dc[@]}" run --rm -e PHP_XDEBUG_MODE=debug php bin/console "$@"
}

#Migrations
migrate(){
  "${dc[@]}" run --rm -e PHP_XDEBUG_MODE=off php bin/console doctrine:migrations:migrate "$@"
}

#Fixture loader
fixtures(){
  "${dc[@]}" run --rm -e PHP_XDEBUG_MODE=off php bin/console doctrine:fixtures:load "$@"
}

#Server start
start-server() {
  "${dc[@]}" exec -e PHP_XDEBUG_MODE=off php php -S 0.0.0.0:8080 -t public/
}

#SQL query
sql(){
  "${dc[@]}" run --rm -e PHP_XDEBUG_MODE=off php bin/console doctrine:query:sql "$@"
}