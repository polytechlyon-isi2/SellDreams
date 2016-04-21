<?php
use Symfony\Component\HttpFoundation\Request;
use SellDreams\Domain\Comment;
use SellDreams\Domain\Article;
use SellDreams\Domain\User;
use SellDreams\Domain\Basket;
use SellDreams\Form\Type\CommentType;
use SellDreams\Form\Type\ArticleType;
use SellDreams\Form\Type\UserType;
use SellDreams\Form\Type\UserAdmin;
use SellDreams\Form\Type\BasketType;

//Categorie page
$app->get('/categorie/{id}', function ($id) use ($app) {
    $categorie = $app['dao.categorie']->find($id);
    $articles = $app['dao.article']->findAllByCategorie($id);
    return $app['twig']->render('categorie.html.twig', array('articles' => $articles, 'categorie' => $categorie));
})->bind('categorie');

// Home page
$app->get('/', function () use ($app) {
    $categories = $app['dao.categorie']->findAll();
    return $app['twig']->render('index.html.twig', array('categories' => $categories));
})->bind('home');

// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');

// Admin home page
$app->get('/admin', function() use ($app) {
    $articles = $app['dao.article']->findAll();
    $comments = $app['dao.comment']->findAll();
    $users = $app['dao.user']->findAll();
    return $app['twig']->render('admin.html.twig', array(
        'articles' => $articles,
        'comments' => $comments,
        'users' => $users));
})->bind('admin');

// Article details with comments and basket
$app->match('/article/{id}', function ($id, Request $request) use ($app) {
    $article = $app['dao.article']->find($id);
    $commentFormView = null;
    $basketFormView = null;
    if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY')) {
        // A user is fully authenticated : he can add comments and article
        $user = $app['user'];
        $comment = new Comment();
        $comment->setArticle($article);
        $comment->setAuthor($user);
        $commentForm = $app['form.factory']->create(new CommentType(), $comment);
        $commentForm->handleRequest($request);
        $tmp = 2;
        $basket = $app['dao.basket']->findByUsrArt($user->getId(), $article->getId());
        if($basket == null){
            $tmp = 1;
            $basket = new Basket();
            $basket->setUsrid($user->getId());
            $basket->setArtid($article->getId());
        }
        $basketForm = $app['form.factory']->create(new BasketType(), $basket);
        $basketForm->handleRequest($request);
        
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $app['dao.comment']->save($comment);
            $app['session']->getFlashBag()->add('success', 'Votre commentaire a bien été ajouté');
        }
        if ($basketForm->isSubmitted() && $basketForm->isValid()) {
            if($tmp!=1){
                $app['dao.basket']->update($basket);
                $app['session']->getFlashBag()->add('success', "L'article a bien été modifié dans le panier");
            }else{
                $app['dao.basket']->save($basket);
                $app['session']->getFlashBag()->add('success', "L'article a bien été ajouté au panier");
            }
            
        }
        $commentFormView = $commentForm->createView();
        $basketFormView = $basketForm->createView();
    }
    $comments = $app['dao.comment']->findAllByArticle($id);
    return $app['twig']->render('article.html.twig', array(
        'article' => $article, 
        'comments' => $comments,
        'commentForm' => $commentFormView,
        'basketForm' => $basketFormView));
})->bind('article');

/*-----------------------------------------------------------------------------------
----------------------------------------- USER --------------------------------------
-----------------------------------------------------------------------------------*/
// Edit an existing user when user is admin
$app->match('/admin/user/{id}/edit', function($id, Request $request) use ($app) {
    $user = $app['dao.user']->find($id);
    $userForm = $app['form.factory']->create(new UserAdmin(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        $plainPassword = $user->getPassword();
        // find the encoder for the user
        $encoder = $app['security.encoder_factory']->getEncoder($user);
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password); 
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', "L'utilisateur a correctement été mis à jour");
    }
    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'Edit user',
        'userForm' => $userForm->createView()));
})->bind('admin_user_edit');

// Edit an existing user when user is not admin
$app->match('/user/edit', function(Request $request) use ($app) {
    $user = $app['user'];
    $userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        $plainPassword = $user->getPassword();
        // find the encoder for the user
        $encoder = $app['security.encoder_factory']->getEncoder($user);
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password); 
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', "L'utilisateur a correctement été mis à jour");
    }
    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'Edit user',
        'userForm' => $userForm->createView()));
})->bind('user_edit');

// Add a user
$app->match('/user/add', function(Request $request) use ($app) {
    $user = new User();
    $userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        // generate a random salt value
        $salt = substr(md5(time()), 0, 23);
        $user->setSalt($salt);
        $plainPassword = $user->getPassword();
        // find the default encoder
        $encoder = $app['security.encoder.digest'];
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password); 
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', "L'utilisateur a correctement été créé.");
    }
    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'New user',
        'userForm' => $userForm->createView()));
})->bind('user_add');

// Remove a user
$app->get('/admin/user/{id}/delete', function($id) use ($app) {
    // Delete all associated comments
    $app['dao.comment']->deleteAllByUser($id);
    // Delete the user
    $app['dao.user']->delete($id);
    $app['session']->getFlashBag()->add('success', "L'utilisateur a correctement été supprimé.");
    // Redirect to admin home page
    return $app->redirect($app['url_generator']->generate('admin'));
})->bind('admin_user_delete');

/*-----------------------------------------------------------------------------------
--------------------------------------- COMMENT -------------------------------------
-----------------------------------------------------------------------------------*/
// Edit an existing comment
$app->match('/admin/comment/{id}/edit', function($id, Request $request) use ($app) {
    $comment = $app['dao.comment']->find($id);
    $commentForm = $app['form.factory']->create(new CommentType(), $comment);
    $commentForm->handleRequest($request);
    if ($commentForm->isSubmitted() && $commentForm->isValid()) {
        $app['dao.comment']->save($comment);
        $app['session']->getFlashBag()->add('success', "Le commentaire a correctement été mis à jour");
    }
    return $app['twig']->render('comment_form.html.twig', array(
        'title' => 'Edit comment',
        'commentForm' => $commentForm->createView()));
})->bind('admin_comment_edit');

// Remove a comment
$app->get('/admin/comment/{id}/delete', function($id, Request $request) use ($app) {
    $app['dao.comment']->delete($id);
    $app['session']->getFlashBag()->add('success', "Le commentaire a correctement été supprimé.");
    // Redirect to admin home page
    return $app->redirect($app['url_generator']->generate('admin'));
})->bind('admin_comment_delete');


/*-----------------------------------------------------------------------------------
--------------------------------------- ARTICLE -------------------------------------
-----------------------------------------------------------------------------------*/
// Add a new article
$app->match('/admin/article/add', function(Request $request) use ($app) {
    $article = new Article();
    $articleForm = $app['form.factory']->create(new ArticleType(), $article);
    $articleForm->handleRequest($request);
    if ($articleForm->isSubmitted() && $articleForm->isValid()) {
        $app['dao.article']->save($article);
        $app['session']->getFlashBag()->add('success', "L'article a correctement été créé.");
    }
    return $app['twig']->render('article_form.html.twig', array(
        'title' => 'New article',
        'articleForm' => $articleForm->createView()));
})->bind('admin_article_add');

// Edit an existing article
$app->match('/admin/article/{id}/edit', function($id, Request $request) use ($app) {
    $article = $app['dao.article']->find($id);
    $articleForm = $app['form.factory']->create(new ArticleType(), $article);
    $articleForm->handleRequest($request);
    if ($articleForm->isSubmitted() && $articleForm->isValid()) {
        $app['dao.article']->save($article);
        $app['session']->getFlashBag()->add('success', "L'article a correctement été mis à jour.");
    }
    return $app['twig']->render('article_form.html.twig', array(
        'title' => 'Edit article',
        'articleForm' => $articleForm->createView()));
})->bind('admin_article_edit');

// Remove an article
$app->get('/admin/article/{id}/delete', function($id, Request $request) use ($app) {
    // Delete all associated comments
    $app['dao.comment']->deleteAllByArticle($id);
    // Delete the article
    $app['dao.article']->delete($id);
    $app['session']->getFlashBag()->add('success', "L'article a correctement été supprimé.");
    // Redirect to admin home page
    return $app->redirect($app['url_generator']->generate('admin'));
})->bind('admin_article_delete');

/*-----------------------------------------------------------------------------------
--------------------------------------- BASKET -------------------------------------
-----------------------------------------------------------------------------------*/
// Remove an basket
$app->get('/basket/{id}/delete', function($id, Request $request) use ($app) {
    // Delete the article
    $app['dao.basket']->delete($id);
    $app['session']->getFlashBag()->add('success', "L'article a correctement été supprimé de votre panier");
    // Redirect to admin home page
    return $app->redirect($app['url_generator']->generate('basket'));
})->bind('basket_delete');

// Basket page
$app->get('/basket', function () use ($app) {
    $user = $app['user'];
    $baskets = $app['dao.basket']->findAllByUser($user->getId());
    $somme = $app['dao.basket']->sommeQuantity($baskets);
    return $app['twig']->render('basket.html.twig', array(
        'baskets' => $baskets,
        'somme' => $somme));
})->bind('basket');