#!/bin/bash

yarn build

rsync -ahlrtvz --delete \
-e ssh ./ggdev-2024 ggdev:/home/ggdev/ggdev.biz/public_html/wp-content/themes/

