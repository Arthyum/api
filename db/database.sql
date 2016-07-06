create database if not exists api character set utf8 collate utf8_unicode_ci;
use api;

grant all privileges on api.* to 'api_user'@'localhost' identified by 'secret';
