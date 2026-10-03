#!/bin/bash
set -e

# Bind mount from Windows/macOS often leaves dirs owned by the host user (e.g. uid 1000)
# while Apache runs as www-data — Laravel needs writable storage and SQLite.
chmod -R 777 storage bootstrap/cache 2>/dev/null || true

if [ -f database/database.sqlite ]; then
    chmod 777 database 2>/dev/null || true
    chmod 666 database/database.sqlite 2>/dev/null || true
fi

exec apache2-foreground
