insert into t_categorie values
(1, 'Reve', "Le rêve désigne un ensemble de phénomènes psychiques éprouvés au cours du sommeil. Au cours de l'Histoire, différents domaines de la connaissance se sont intéressés au rêve, y cherchant du sens ou une fonction. Au réveil, le souvenir du rêve est souvent lacunaire, parfois inexistant. Il est cependant possible d'entraîner la remémoration onirique. Les rêves sont les plus élaboés pendant les phases de sommeil paradoxal.", 'Ange.jpg');
insert into t_categorie values
(2, 'Cauchemar', "Un cauchemar cause une forte émotion négative, le plus communément de la peur ou de l'horreur, mais également du désespoir, de l'anxiété ou une grande tristesse. Les cauchemar peuvent impliquer des situations de danger, de mal-être psychologiques ou physiques, de terreur. Suite à un cauchemar l'on se reveil souvent dans un état de détresse, et on peut avoir du mal à retrouver le sommeil durant un certain temps." ,'Demond.jpg');

insert into t_article values
(1, 'Alice au pays des merveille', "Alice, désormais âgée de 19 ans, retourne dans le monde fantastique qu'elle a découvert quand elle était enfant. Elle y retrouve ses amis le Lapin Blanc, Bonnet Blanc et Blanc Bonnet, le Loir, la Chenille, le Chat du Cheshire et, bien entendu, le Chapelier Fou. Alice s'embarque alors dans une aventure extraordinaire où elle accomplira son destin : mettre fin au règne de terreur de la Reine Rouge. ",1,'Alice-aux-pays-des-merveilles.jpg',19);
insert into t_article values
(3, 'Cendrillon', "Le père d’Ella, un marchand, s’est remarié après la mort tragique de la mère de la jeune fille. Pour l’amour de son père, Ella accueille à bras ouverts sa nouvelle belle-mère et les filles de celle-ci, Anastasie et Javotte. Mais lorsque le père d’Ella meurt à son tour, la jeune fille se retrouve à la merci de sa nouvelle famille, jalouse et cruelle. Les trois méchantes femmes font d’elle leur servante, et la surnomment avec mépris Cendrillon parce qu’elle est toujours couverte de cendres. Pourtant, malgré la cruauté dont elle est victime, Ella est déterminée à respecter la promesse faite à sa mère avant de mourir : elle sera courageuse et bonne. Elle ne se laissera aller ni au désespoir, ni au mépris envers ceux qui la maltraitent. Un jour, Ella rencontre un beau jeune homme dans la forêt. Ignorant qu’il s’agit d’un prince, elle le croit employé au palais. Ella a le sentiment d’avoir trouvé l’âme soeur. Une lueur d’espoir brûle dans son coeur, car toutes les jeunes filles du pays ont été invitées à assister à un bal au palais. Espérant y rencontrer à nouveau le charmant Kit, Ella attend avec impatience de se rendre à la fête. Hélas, sa belle-mère lui défend d’y assister et réduit sa robe en pièces… Pendant ce temps, le Grand Duc complote avec la méchante belle-mère pour empêcher le Prince de retrouver celle qu’il aime... Heureusement, comme dans tout bon conte de fées, la chance finira par sourire à Ella : une vieille mendiante fait son apparition, et à l’aide d’une citrouille et de quelques souris, elle va changer le destin de la jeune fille… ",1,'cendrillon.jpg',19);


insert into t_article values
(4, 'Enfer', 'Venez d''écrouvrir votre futur résidence au plus vite nous somme tou impatient de vous retrouver 7 pied sous terre',2,'tenebres.jpg',19);


insert into t_user values
(1, 'admin', 'nom de famille','adresse','38530','Pontcharra','matthieu@gmail.com', 'gqeuP4YJ8hU3ZqGwGikB6+rcZBqefVy+7hTLQkOD+jwVkp4fkS7/gr1rAQfn9VUKWc7bvOD7OsXrQQN5KGHbfg==', 'EDDsl&fBCJB|a5XUtAlnQN8', 'ROLE_ADMIN');

insert into t_comment values
(1, 'Great! Keep up the good work.', 1, 1);
insert into t_comment values
(2, "Thank you, I'll try my best.", 1, 1);

insert into t_basket values
(1,1,1,18);
insert into t_basket values
(2,1,2,4);
insert into t_basket values
(3,1,3,7);
