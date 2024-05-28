#!/bin/sh

expected_checksum="$(php -r 'copy("https://composer.github.io/installer.sig", "php://stdout");')"
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
actual_checksum="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

if test "$expected_checksum" != "$actual_checksum"; then
	>&2 echo "$0: invalid checksum"
	rm composer-setup.php
	exit 1
fi

php composer-setup.php --quiet
result=$?
rm composer-setup.php
exit $result