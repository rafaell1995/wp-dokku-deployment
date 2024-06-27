#!/bin/sh
# Cria o diretório de destino se ele não existir
mkdir -p public/wp-content/mu-plugins/

# Copia o arquivo para o diretório de destino
cp packages/mu-plugins/s3-endpoint.php public/wp-content/mu-plugins/s3-endpoint.php