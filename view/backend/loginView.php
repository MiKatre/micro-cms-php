<?php $title='Page de connexion'; ?>

<?php ob_start(); ?>
<div class="mx-auto w-100 text-center">
  <form class="form-signin" action="index.php?action=login" method="POST">
      <?php 
          if(isset($_GET['errorMessage'])) {
              if (!empty($_GET['errorMessage'])) {
                  echo '
                  <div class="alert alert-danger alert-dismissible fade show text-left bad-login" role="alert">
                    <h5 class="alert-heading">Erreur</h5>    
                    <p>' . $_GET['errorMessage'] . ' </p>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>';
              }
          }
      ?>
    <h1 class="font-weight-bold">Jean Forteroche</h1>
    <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h4 mb-3 font-weight-normal">Connexion à l'interface d'administration</h1>
    <label for="email" class="sr-only">Addresse Email</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="Addresse Email" required autofocus>
    <label for="inputPassword" class="sr-only">Mot de Passe</label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Mot de Passe" required>
    <div class="checkbox mb-3">
        <label>
          <input type="checkbox" name="rememberMe" value="rememberMe"> Se souvenir de moi
        </label>
      </div>
    <button class="btn btn-lg btn-success btn-block" type="submit">Connexion</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2018-2019</p>
  </form>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php') ?>