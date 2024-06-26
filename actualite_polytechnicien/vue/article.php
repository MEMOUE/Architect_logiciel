<?php include 'inc/entete.php'; ?>
<?php include 'inc/menu.php'; ?>
<div class="container">
    <?php if (!empty($articles)): ?>
        <?php foreach ($articles as $article): ?>
            <div class="article">
                <h2><?php echo htmlspecialchars($article['titre']); ?></h2>
                <p><?php echo htmlspecialchars($article['contenu']); ?></p>
                <small>Publié le <?php echo htmlspecialchars($article['dateCreation']); ?></small>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun article trouvé.</p>
    <?php endif; ?>
</div>
