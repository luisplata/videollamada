git pull --tags
git checkout -b $1 $1
composer install
php artisan migrate