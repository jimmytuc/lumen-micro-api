#!/usr/bin/env bash

make up

sleep 1

make config

sleep 0.5

make migrate

exit 0
