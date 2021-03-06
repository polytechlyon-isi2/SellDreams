<?php
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app['twig'] = $app->share($app->extend('twig', function(Twig_Environment $twig, $app) {
    $twig->addExtension(new Twig_Extensions_Extension_Text());
    return $twig;
}));
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => $app->share(function () use ($app) {
                return new SellDreams\DAO\UserDAO($app['db']);
            }),
        ),
    ),
    
    'security.role_hierarchy' => array(
        'ROLE_ADMIN' => array('ROLE_USER'),
    ),
    'security.access_rules' => array(
        array('^/admin', 'ROLE_ADMIN'),
    ),
    
));
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());

// Register services
$app['dao.basket'] = $app->share(function ($app) {
    return new SellDreams\DAO\BasketDAO($app['db']);
});
$app['dao.article'] = $app->share(function ($app) {
    return new SellDreams\DAO\ArticleDAO($app['db']);
});
$app['dao.categorie'] = $app->share(function ($app) {
    return new SellDreams\DAO\CategorieDAO($app['db']);
});
$app['dao.user'] = $app->share(function ($app) {
    return new SellDreams\DAO\UserDAO($app['db']);
});
$app['dao.comment'] = $app->share(function ($app) {
    $commentDAO = new SellDreams\DAO\CommentDAO($app['db']);
    $commentDAO->setArticleDAO($app['dao.article']);
    $commentDAO->setUserDAO($app['dao.user']);
    return $commentDAO;
});