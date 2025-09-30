# Usa uma imagem oficial do PHP com Apache
FROM php:8.2-apache

# Habilita o módulo de reescrita do Apache
RUN a2enmod rewrite

# Instala as extensões necessárias e depois limpa o cache para otimizar o tamanho
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

# Copia todos os arquivos da aplicação para o diretório web do Apache
COPY . /var/www/html/

# (NOVO) Garante que o servidor Apache tenha permissão para escrever na pasta de imagens
RUN chown -R www-data:www-data /var/www/html/img

# Define o diretório de trabalho
WORKDIR /var/www/html/

# Expondo a porta padrão do Apache
EXPOSE 80

# Comando padrão para iniciar o Apache
CMD ["apache2-foreground"]