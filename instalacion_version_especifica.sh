git checkout master
git pull
git checkout -b $1 $1
composer install
php artisan migrate