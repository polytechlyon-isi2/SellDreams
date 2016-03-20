<?php

// Home page
$app->get('/categorie/{id}', function ($id) use ($app) {
	$categorie = $app['dao.categorie']->find($id);
    $articles = $app['dao.article']->findAllByCategorie($id);
    return $app['twig']->render('categorie.html.twig', array('articles' => $articles, 'categorie' => $categorie));
})->bind('categorie');

$app->get('/', function () use ($app) {
    $categories = $app['dao.categorie']->findAll();
    return $app['twig']->render('index.html.twig', array('categories' => $categories));
})->bind('home');

// Article details with comments
$app->get('/article/{id}', function ($id) use ($app) {
    $article = $app['dao.article']->find($id);
    $comments = $app['dao.comment']->findAllByArticle($id);
    return $app['twig']->render('article.html.twig', array('article' => $article, 'comments' => $comments));
})->bind('article');

// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');