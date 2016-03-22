insert into t_categorie values
(1, 'Reve', 'Venait voyager dans nos pays merveilleux', '/imge/existe/pas');
insert into t_categorie values
(2, 'Cauchemard', 'Mouahahaha vous etes modie', '/imge/existe/pas');
insert into t_categorie values
(3, 'Maison', 'Une grande maison', '/imge/existe/pas');
insert into t_categorie values
(4, 'Travail', 'Bcp de travail', '/imge/existe/pas');

insert into t_article values
(1, 'Alice au pays des merveille', 'Très beau voyage dans un compte de fée',1,'/adresse/bidon/');
insert into t_article values
(2, 'Les sept nains', 'Venez voyager au milieu de nos 7 nains tous plus gentil les un que les autres',1,'/adresse/bidon/');
insert into t_article values
(3, 'Cendrillon', "Venez voyager au pays de cendrillon",1,'/adresse/bidon/');
insert into t_article values
(4, 'Enfer', "Venez d'écrouvrir votre futur résidence au plus vite nous somme tou impatient de vous retrouver 7 pied sous terre",2,'/adresse/bidon/');

/* raw password is 'john' */
insert into t_user values
(1, 'JohnDoe', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER');
/* raw password is 'jane' */
insert into t_user values
(2, 'JaneDoe', 'EfakNLxyhHy2hVJlxDmVNl1pmgjUZl99gtQ+V3mxSeD8IjeZJ8abnFIpw9QNahwAlEaXBiQUBLXKWRzOmSr8HQ==', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER');
/* raw password is '@dm1n' */
insert into t_user values
(3, 'admin', 'gqeuP4YJ8hU3ZqGwGikB6+rcZBqefVy+7hTLQkOD+jwVkp4fkS7/gr1rAQfn9VUKWc7bvOD7OsXrQQN5KGHbfg==', 'EDDsl&fBCJB|a5XUtAlnQN8', 'ROLE_ADMIN');

insert into t_comment values
(1, 'Great! Keep up the good work.', 1, 1);
insert into t_comment values
(2, "Thank you, I'll try my best.", 1, 2);
