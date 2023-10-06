#!/usr/bin/env bash
source console.sh
com install
up
#Чуток подождать чтобы постгрес запустился
sleep 5
run d:d:c
migrate
fixtures
start-server
