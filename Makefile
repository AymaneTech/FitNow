install:
	./vendor/bin/sail composer update
	./vendor/bin/sail composer require barryvdh/laravel-debugbar --dev
	./vendor/bin/sail composer require rennokki/laravel-eloquent-query-cache
	./vendor/bin/sail composer require cviebrock/eloquent-sluggable
	./vendor/bin/sail php artisan vendor:publish --provider="Cviebrock\EloquentSluggable\ServiceProvider"
	./vendor/bin/sail composer require beyondcode/laravel-query-detector --dev
	./vendor/bin/sail composer require laravel/telescope
	./vendor/bin/sail php artisan telescope:install
	./vendor/bin/sail composer require silverhand7/laravel-artisan-maker
	sail composer require --dev barryvdh/laravel-ide-helper
	sail composer require itsgoingd/clockwork
	#./vendor/bin/sail composer require "matte97p/laravel-postgresql-inherit ~2.7"
	#./vendor/bin/sail composer require barryvdh/laravel-dompdf
