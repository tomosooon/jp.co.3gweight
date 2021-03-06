#!/bin/sh

# Variables
project=jp.co.3gdiet.dev
from=/mnt/workspace/${project}/
to=/usr/local/rms/evt/${project}/

# Commnads
rsync -avzln --delete --exclude /bootstrap.php.cache --exclude /cache --exclude /logs --exclude /pear ${from}app/ ${to}app/
rsync -avzln --delete --exclude '*.compressed.css' --exclude '*.compressed.js'                        ${from}src/ ${to}src/
rsync -avzln --delete --exclude /bundles --exclude /assets --exclude /uploads                         ${from}web/ ${to}web/

echo "-------------------------------------------" 
echo "Are you sure rsync? [Press Y(Yes) or N(No)]" 
echo -n " => " 
read ans
echo "-------------------------------------------" 
case ${ans} in
  Y)
    continue ;;
  *)
    echo "Canceled." 
    exit 0;;
esac

rsync -avzl --delete --exclude /bootstrap.php.cache --exclude /cache --exclude /logs --exclude /pear ${from}app/ ${to}app/
rsync -avzl --delete --exclude '*.compressed.css' --exclude '*.compressed.js'                        ${from}src/ ${to}src/
rsync -avzl --delete --exclude /bundles --exclude /assets --exclude /uploads                         ${from}web/ ${to}web/
