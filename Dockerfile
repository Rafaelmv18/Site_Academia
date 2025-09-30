Usa uma imagem oficial do PHP com Apache
FROM php:8.2-apache

Instala as extensões necessárias (pdo_pgsql é CRUCIAL para o Supabase)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && a2enmod rewrite

Copia todos os arquivos da aplicação para o diretório web do Apache
COPY . /var/www/html/

Define o diretório de trabalho
WORKDIR /var/www/html/

Expondo a porta padrão do Apache
EXPOSE 80

Comando padrão para iniciar o Apache
CMD ["apache2-foreground"]