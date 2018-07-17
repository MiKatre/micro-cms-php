<?php setlocale(LC_TIME, "fr_FR");?>
<?php $title = 'Blog de Jean Forteroche'; ?>
<?php ob_start(); ?>


<div id="main" class="px-3 ">

<h1 class="main-title pt-3 pb-5">BLOG</h1>


<?php
foreach($posts as $post) {
?>
    <div class="news">
        <h3 class="mb-0">
            <a href="index.php?action=post&amp;id=<?= $post->id(); ?>">
                <?= htmlspecialchars($post->title()) ?>
            </a>
        </h3>
        
        <small class="text-muted"><?= strftime("%A %d %B %Y", strtotime($post->date()))?></small>
        <p>
        <?= strip_tags(htmlspecialchars_decode($post->excerpt())) ?>
        </p>
    </div>
<?php } ?>

      <?php
        if ($totalPages > 1) {
          include 'view/partials/pagination.php';
        }
      ?>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>