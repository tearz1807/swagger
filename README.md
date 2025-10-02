##### Step1
Creater .env from .env.example

##### Step2

`docker run --rm \
-u "$(id -u):$(id -g)" \
-v "$(pwd)":/opt \
-w /opt \
laravelsail/php84-composer:latest \
composer install --ignore-platform-reqs
`

`./vendor/bin/sail up -d`

`sail artisan migrate:fresh --seed`

`sail npm run build`

`sail npm i`

`sail artisan jwt:secret`

`sail artisan storage:link`

`sail artisan test`

`//sail artisan vendor:publish --provider=RonasIT\\AutoDoc\\AutoDocServiceProvider`

`//sail artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"`

##### Step3

sail artisan test --coverage-htm storage/app/public/coverage

Open http://localhost/api/doc

