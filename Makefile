build:
	docker build . -t xyo-sdk-php:7.1.33 --no-cache


ssh:
	docker run -it --rm --name xyo_sdk_php -v $(PWD):/usr/local/xyo/sdk xyo-sdk-php:7.1.33 sh
