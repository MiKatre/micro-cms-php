<?php $title='Page de connexion'; ?>

<?php ob_start(); ?>
<div class="mx-auto w-100 text-center">
  <form class="form-signin">
    <h1 class="font-weight-bold">Jean Forteroche</h1>
    <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h4 mb-3 font-weight-normal">Connexion à l'interface d'administration</h1>
    <label for="inputEmail" class="sr-only">Addresse Email</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Addresse Email" required autofocus>
    <label for="inputPassword" class="sr-only">Mot de Passe</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Mot de Passe" required>
    <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Se souvenir de moi
        </label>
      </div>
    <button class="btn btn-lg btn-success btn-block" type="submit">Connexion</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2018-2019</p>
  </form>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php') ?>