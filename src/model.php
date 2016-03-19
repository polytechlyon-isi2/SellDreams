<?php

// Return all articles
function getArticles() {
    $bdd = new PDO('mysql:host=localhost;dbname=selldreams;charset=utf8', 'selldreams_user', 'MonSecret');
	$articles = $bdd->query('select * from t_article order by art_id desc');
    return $articles;
}