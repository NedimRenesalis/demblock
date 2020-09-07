#!/bin/sh
# ======================================================
# Controls which service will be exposed in k8s cluster.
# This is used as an intro cmd script for pods.
# NOTE: Do not override!
# ======================================================

# Perform migration
php yii migrate --interactive=0

# 1) Enable specified service  ["frontend", "backend"]
ENABLE_SERVICE=$1
a2ensite "$ENABLE_SERVICE.conf"

# 2) Run Apache server
apachectl -D FOREGROUND
service apache2 reload
