create database if not exists selldreams character set utf8 collate utf8_unicode_ci;
use selldreams;

grant all privileges on selldreams.* to 'selldreams_user'@'localhost' identified by 'secret';