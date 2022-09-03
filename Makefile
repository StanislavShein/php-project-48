install: # установить зависимости
	composer install

validate: # публикация
	composer validate

lint: # запуск линтера
	composer exec --verbose phpcs -- --standard=PSR12 src bin tests

test: # запуск тестов
	composer exec --verbose phpunit tests