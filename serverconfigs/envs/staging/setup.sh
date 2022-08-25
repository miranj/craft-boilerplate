#!/bin/bash
# 
# Script to setup RunCloud config on the Miranj staging server
# 


APP_NAME="boilerplate"

REPO_DIR="/home/runcloud/webapps/$APP_NAME"
TARGET_DIR="/etc/nginx-rc/extra.d"

cd $TARGET_DIR
ln -s $REPO_DIR/serverconfigs/envs/staging/env.conf $APP_NAME.location.main-before.10-env.conf
ln -s $REPO_DIR/serverconfigs/envs/staging/auth.conf $APP_NAME.location.main-before.20-auth.conf
ln -s $REPO_DIR/serverconfigs/nginx/cdn/static.conf $APP_NAME.location.static.include.conf
