# Descrição

Docker utilizando o compose, arquivo de configuração com variáveis de ambiente, criando um container nginx 1.13.3 e um container php 7.1.9-fpm ligados através de um link e criando um container mysql 5.7.19.

Laravel versão 5.5.22

Documentação sugerida do Passport(Oauth): https://laravel.com/docs/5.5/passport

# Observação

Para a versão do laravel que está sendo utilizada, a versão 5.0 do passport(padrão no momento da criação do repositório) não está sendo instalada.
A versão deve ser informada no comando de execução. Ex: composer require laravel/passport "4.0"

# Configuração Container Nginx

1. Exposição de portas

	80 e 443

2. Volume (Obs: verificar se na configuração do docker -> drivers compartilhados, as unidades c: e/ou d: estão habilitadas)

	Aplicação: htdocs -> /var/www/html
	
	Logs: nginx/logs -> /var/log/nginx
	
	Virtual Host: nginx/sites -> /etc/nginx/conf.d

# Configuração Container Php

1. Exposição de portas

	9000

2. Volume (Obs: verificar se na configuração do docker -> drivers compartilhados, as unidades c: e/ou d: estão habilitadas)

	Aplicação: htdocs -> /var/www/html
	
3. Bibliotecas

	Habilitação de bibliotecas do php através de arquivo de configuração. Ex: MBSTRING, GD, MCRYPT, PDO_MYSQL, etc.
	
# Configuração Container Mysql

1. Exposição de portas

	3306

2. Volume (Obs: verificar se na configuração do docker -> drivers compartilhados, as unidades c: e/ou d: estão habilitadas)

	Aplicação: mysql/data -> /var/lib/mysql

3. Configuração para conexão

	- MYSQL_DATABASE      = default
	
    - MYSQL_USER          = default
	
    - MYSQL_PASSWORD      = secret
	
    - MYSQL_ROOT_PASSWORD = root
	
    - MYSQL_PORT          = 3306
	
# Como utitilizar

1. Clone o repositório usando o comando:

   git clone https://github.com/danielnogueira-dev/LaravelAutenticacaoApi.git

2. Entre na pasta Docker-Compose-Nginx-Php-Laravel-Mysql e copie o arquivo env-example para .env.

   cp env-example .env

3. Rode seu container:

   docker-compose up -d

4. Adicione os domínios no arquivo de hosts do windows.

   127.0.0.1 localhost

5. Acessar o shell do container:
    
	winpty docker exec -it nginx bash

	winpty docker exec -it php-fpm bash
	
	winpty docker exec -it mysql bash
   
6. Instruções iniciais para rodar o Laravel no localhost:

	Acessar a pasta: cd /var/www/html
	
	Executar comando para criar pasta vendor do laravel: composer install
	
	Executar comando para criar arquivo de variáveis de ambiente do laravel: cp .env.example .env
	
	Executar comando para gerar chaves necessarias para rodar o laravel: php artisan key:generate

	Executar comandos para instalar nodejs:

		curl -sL https://deb.nodesource.com/setup_9.x | bash -
		
		apt-get install nodejs
	
	Executar comando para compilar assets (laravel mix): npm install
	
7. Abra no navegador

   http://localhost

8. Acessar o banco de dados dentro do container Mysql

	mysql -u root -p

9. Comandos básicos para utilizar o banco de dados

	show databases;

	CREATE DATABASE autenticacao;
	
	use autenticacao;
	
	show tables;

10. Informações sobre o Passport
	
	Para utilizar as views do oauth, é preciso executar o comando: php artisan make:auth
    Cadastra-se e faça o login no sistema, isso irá evitar o erro 401.
	
	Sempre que for feita alguma alteração no Vue, executar comando para recompilar assets para as telas de client do passaporte: npm run dev
	
	Comando para conseguir autorização do oauth para o client via password, de forma específica: php artisan passport:client --password