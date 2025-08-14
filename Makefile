build:
	docker build . -t xyo-sdk-php:7.0


ssh:
	docker run -it --rm --name xyo_sdk_php -v "$PWD":/usr/local/app -w /usr/local/app php:7.0-alpine sh
