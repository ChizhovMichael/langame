docker-compose up -d
while :
do
    if [[ -f ${PWD}/vendor/autoload.php ]]
    then
        sleep 10
        docker-compose exec php php artisan migrate
        docker-compose exec php php artisan post:import
        break
    fi
    sleep 5
done
echo "Start website: localhost:80"
