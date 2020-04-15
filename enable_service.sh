#!/bin/sh
# Controls which service will be exposed

# Enable specified service
# (str) - ["frontend", "backend"]
ENABLE_SERVICE=$1
a2ensite "$ENABLE_SERVICE.conf"

# Run Apache server
apachectl -D FOREGROUND
