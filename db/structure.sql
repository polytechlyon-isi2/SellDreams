drop table if exists t_reve;
create table t_reve (
reve_id integer not null primary key auto_increment,
reve_title varchar(100) not null,
reve_content varchar(2000) not null,
reve_categorie varchar(100) not null,
reve_img varchar(100) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

drop table if exists t_categorie;
create table t_categorie (
cat_id integer not null primary key auto_increment,
cat_title varchar(100) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

drop table if exists t_comment;
create table t_comment (
com_id integer not null primary key auto_increment,
com_content varchar(20000) not null,
com_reve_id integer,
com_user_id integer
) engine=innodb character set utf8 collate utf8_unicode_ci;

/*
drop table if exists t_utilisateur;
create table t_utilisateur (
user_id integer not null primary key auto_increment,
user_name varchar(100) not null,
user_pwd varchar(100) not null,
user_salt varchar(100) not null,
user_role varchar(100) not null,
) engine=innodb character set utf8 collate utf8_unicode_ci;
*/