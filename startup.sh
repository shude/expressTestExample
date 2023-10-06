#!/usr/bin/env bash
source console.sh
com install
up
run d:d:c
migrate
fixtures
start-server
