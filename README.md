# Biblioteca de Musica
Projeto desenvolvido para RunWeb

## Começando
Essas instruções farão com que você tenha uma cópia do projeto em execução na sua máquina local para fins de desenvolvimento e teste. O projeto está na pasta app:

## Pré-requisitos
* 1 - Xampp
* 2 - Laravel 5.6
* 3 - Composer 1.7.2
* 3 - Php 7.2.8

## Instalando
- Baixar o [Xampp](https://www.apachefriends.org/xampp-files/7.2.8/xampp-win32-7.2.8-0-VC15-installer.exe) e executar o apache e o mysql.
- Baixar o [Composer](https://getcomposer.org/Composer-Setup.exe) e executar.
- Entrar no site http://localhost/phpmyadmin/ criar um banco com o nome de bibmusica no formato utf8_unicode_ci
- Copiar o banco na basta '\app\bancoLimpo' e importar no MySql, para o banco bibmusica. O banco limpo contem usuário admin padrão.
- Login admin padrão: admin@admin.com.br
- Senha admin padrão: admin1234
- Abrir o arquivo .env dentro da pasta '\app' e verificar se o nome do banco, usuario, e senha estão corretos.
- Abrir janela de comando na pasta raiz, e executar o comando php artisan serve

## Construído com
 * [Laravel 5.6](https://laravel.com/) - O framework web usado.
 * [PHP 7.2.8](http://php.net/) - A linguagem usada.
 * [Mysql/MariaDB](https://www.mysql.com/) - O Banco usado.
 * [Bootstrap 4.1](https://getbootstrap.com/) - O componente front-end.
 
 ## Autores
 * **Gustavo Maciel** - [GustavoBMaciel](https://github.com/GustavoBMaciel)
 
 ## Observações
 No projeto utilizei o docker compose como solicitado, porem nunca tive contato com ele, consegui um exemplo de como utilizar, mas não sei se foi configurado corretamente. Espero que consigam avaliar utilizando as orientações acima.

