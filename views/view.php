<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <link href="microcms.css" rel="stylesheet" />
    <title>SellDreams - Home</title>
</head>
<body>
    <header>
        <h1>SellDreams</h1>
    </header>
    <?php
    foreach ($articles as $article): ?>
    <article>
        <h2><?php echo $article->getTitle() ?></h2>
		<p><?php echo $article->getContent() ?></p>
    </article>
    <?php endforeach ?>
    <footer class="footer">
        SellDreams
    </footer>
</body>
</html>