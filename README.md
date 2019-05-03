# S-mardii/wordpress-development-on-docker
This repository is created for practicing on creating WordPress local development environment with Docker on Windows machine.

## Start the Docker container
Run `docker-compose up -d`

## Halt the Docker container
Run `docker-compose stop`

## Login with SSH to Docker container of WordPress image via Git Bash
Run `winpty docker exec -it docker-wordpress-premium-theme-setup_wordpress_1 sh`

## Quit Docker container
Run `exit`
