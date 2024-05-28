# wp-dokku-deployment

Este repositório contém uma instalação padrão do WordPress configurada para rodar em Docker, ideal para implantação em um ambiente Dokku. Facilita a configuração, desenvolvimento e implantação de um site WordPress com gerenciamento de dependências via Composer.

## Requisitos

- Docker
- Docker Compose
- Dokku (para implantação em produção)

## Instalação e Execução Local

1. Clone este repositório:
```bash
git clone https://github.com/rafaell1995/wp-dokku-deployment.git
cd wp-dokku-deployment
```

2. Construa e inicie os containers Docker:
```bash
docker-compose up --build
```

3. No primeiro bild precisamos instalar as dependencias do composer dentro do container web:
```sh
docker compose exec web composer install
```

4. Por fim caso tenha um banco de dados, pode importa-lo no container db:
```sh
docker exec -i $(docker compose ps -q db) mysql -p123 wordpress < dump.sql
```

5. Acesse `http://localhost:8000` no seu navegador para configurar o WordPress.

## Implantação em Dokku

Para fazer deploy deste projeto no Dokku, siga estas etapas:

1. No servidor Dokku, crie um novo app:
```bash
dokku apps
nome-do-app
```

2. Faça push do código para o Dokku:
```bash
git push dokku master
```

3. Configure o banco de dados e outras variáveis de ambiente conforme necessário.

Informações completas sobre como fazer o deploy de uma aplicação com Dokku em [Dokku Application Deployment Documentation](https://dokku.com/docs/deployment/application-deployment/)
