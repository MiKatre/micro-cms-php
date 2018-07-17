<?php setlocale(LC_TIME, "fr_FR");?>
<?php $title = 'À Propos' ?>
<?php ob_start(); ?>

<div id="main" class="mt-4 px-3 pb-3">

    <div class="news">
        <small class="text-muted">
            L'auteur
        </small>
        <h2 class="font-weight-bold">
            Jean Forteroche
        </h2>
        <div >
            <div class="float-left mt-2 pr-3"><img src="static/img/forteroche.jpg" width="160" class="rounded border border-primary"/></div>
            <h5>Acteur et Écrivain</h5>
            <p> <strong>J'ai commencé ma carrière en tant que Sed convallis. </strong> Neque ac ullamcorper sagittis. Etiam accumsan tempor eros eu sagittis. Duis lacus felis, dictum eu pulvinar et, semper vitae nulla. Mauris augue massa, condimentum sit amet massa vel, mollis semper erat. Vivamus lobortis consequat diam quis posuere. Proin luctus vehicula mollis. Nulla ut mi non neque porttitor placerat.Quisque gravida odio vitae quam bibendum fermentum. Sed non nulla semper justo molestie mollis quis non lectus. Mauris eu aliquet sem. Vivamus mattis velit vel nisl lobortis dignissim. Integer at hendrerit ligula, in condimentum mauris. In vel tincidunt sem, sit amet pharetra nunc. Donec non lacus tincidunt, ornare odio sed, convallis nisi. Curabitur ac turpis eu mi suscipit auctor.</p>
            <ol>
                <li> Neque ac ullamcorper sagittis.</li>
                <li> Neque ac ullamcorper sagittis.</li>
                <li> Neque ac ullamcorper sagittis.</li>
                <li> Neque ac ullamcorper sagittis.</li>
                <li> Neque ac ullamcorper sagittis.</li>
                <li> Neque ac ullamcorper sagittis.</li>
            </ol>
            <p>Morbi eleifend molestie dui tempor efficitur. Integer sit amet tincidunt dolor. Praesent laoreet ligula a ultricies porta. Pellentesque dictum porttitor quam, et venenatis sapien interdum eleifend. Mauris accumsan libero id felis dapibus blandit. Ut sed posuere turpis, at scelerisque dolor. Ut vel feugiat elit. Phasellus euismod tellus at tempus maximus. Donec sollicitudin posuere lacus non sollicitudin. </p>
            <small> Mauris accumsan libero id felis dapibus blandit. Ut sed posuere turpis, at scelerisque dolor. Ut vel feugiat elit. Phasellus euismod tellus at tempus maximus. Donec sollicitudin posuere lacus non sollicitudin. </small>
            <div class="text-center my-4">
                <a href="index.php" type="button" class="btn btn-success text-white mt-3">Lire le Blog</a>
            </div>
        </div>


    </div>
</div>
   
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
