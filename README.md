# wp-dokku-deployment

This repository contains a standard WordPress installation configured to run on Docker, ideal for deployment in a Dokku environment. It facilitates configuration, development, and deployment of a WordPress site with dependency management via Composer.

## Requirements

- Docker
- Docker Compose
- Dokku (for production deployment)

## Installation and Local Execution

1. Clone this repository:
```bash
git clone https://github.com/rafaell1995/wp-dokku-deployment.git
cd wp-dokku-deployment
```

2. Build and start the Docker containers:
```bash
docker-compose up --build
```

3. On the first build, we need to install the Composer dependencies inside the web container:
```sh
docker compose exec web composer install
```

4. Finally, if you have a database, you can import it into the db container:
```sh
docker exec -i $(docker compose ps -q db) mysql -p123 wordpress < dump.sql
```

5. Access http://localhost:8000 in your browser to configure WordPress.

## Deployment in Dokku

To deploy this project in Dokku, follow these steps:

1. On the Dokku server, create a new app:
```bash
dokku apps
nome-do-app
```

2. Push the code to Dokku:
```bash
git push dokku master
```

3. Configure the database and other necessary environment variables.

Complete information on how to deploy an application with Dokku can be found at [Dokku Application Deployment Documentation](https://dokku.com/docs/deployment/application-deployment/)
