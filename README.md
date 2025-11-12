##### Step1
Creater .env from .env.example

##### Step2

```
docker run --rm \
-u "$(id -u):$(id -g)" \
-v "$(pwd)":/opt \
-w /opt \
laravelsail/php84-composer:latest \
composer install --ignore-platform-reqs
```

```
./vendor/bin/sail up -d

sail artisan migrate:fresh --seed

sail npm i

sail npm run build

sail artisan jwt:secret

sail artisan storage:link
```

##### Step3

```
sail artisan test --coverage-htm storage/app/public/coverage
```

- Open [Dock](http://localhost/api/doc/)
- Open [Coverage](http://localhost/storage/coverage/)

##### Fix autorize
fix module ronasit/laravel-swagger
add line 155 to SwaggerService.php block 'components'
```
'securitySchemes' => $this->config['securitySchemes'],
```