.PHONY: *

infra-shell-php:
	docker compose -f ../../server/docker-compose.yml exec -u=dev -it pixl bash

infra-shell-root-php:
	docker compose -f ../../server/docker-compose.yml exec -it pixl bash

start:
	docker compose -f ../../server/docker-compose.yml up -d
