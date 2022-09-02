install: # установить зависимости
	composer install

validate: # публикация
	composer validate

lint: # запуск phpcs
	composer exec --verbose phpcs -- --standard=PSR12 src bin