# Run artisan commands
alias artisan='sudo docker exec --user "$(id -u):$(id -g)" shop_dev_php_1 php artisan'