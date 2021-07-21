#!/bin/bash
# 
# Script to setup RunCloud config on a Miranj production server
# 


APP_NAME="boilerplate-craft"
CDN_NAME="boilerplate-cdn"
REDIRECTS_NAME="boilerplate-redirects"

REPO_DIR="/home/runcloud/webapps/$APP_NAME"
TARGET_DIR="/etc/nginx-rc/extra.d"

cd $TARGET_DIR

# CDN
ln -s $REPO_DIR/serverconfigs/nginx/cdn/static.conf $CDN_NAME.location.static.include.conf
ln -s $REPO_DIR/serverconfigs/nginx/cdn/proxy.conf $CDN_NAME.location.proxy.include.conf

# Craft
ln -s $REPO_DIR/serverconfigs/nginx/craft/http.conf $APP_NAME.location.http.include.conf
ln -s $REPO_DIR/serverconfigs/envs/production/env.conf $APP_NAME.location.main-before.include.conf
ln -s $REPO_DIR/serverconfigs/nginx/craft/main.conf $APP_NAME.location.main.include.conf
ln -s $REPO_DIR/serverconfigs/nginx/cdn/static.conf $APP_NAME.location.static.include.conf
ln -s $REPO_DIR/serverconfigs/nginx/craft/proxy.conf $APP_NAME.location.proxy.include.conf

# Redirects
ln -s $REPO_DIR/serverconfigs/envs/production/env.conf $REDIRECTS_NAME.location.main-before.include.conf
ln -s $REPO_DIR/serverconfigs/nginx/redirects/main.conf $REDIRECTS_NAME.location.main.include.conf
