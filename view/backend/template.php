<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <link href="static/thirdParty/bootstrap.min.css" rel="stylesheet" /> 
    <link href="static/css/backend.css" rel="stylesheet" /> 
    <script src="static/thirdParty/tinymce/tinymce.min.js"></script>
    <script src="static/thirdParty/tinymce/jquery.tinymce.min.js"></script>
  </head>
        
  <body>

  <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Tableau de bord</a>
    <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="index.php?action=logout">
          Déconnexion
        </a>
      </li>
    </ul>
  </nav>

  <?= ($_GET['action'] == 'showDashboardPosts') ? 'active' : '' ?>

  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a 
              class="nav-link <?= ($_GET['action'] == 'showDashboard') ? 'active' : '' ?>" 
              href="index.php?action=showDashboard">
                <span data-feather="home"></span>
                Tableau de bord <span>
              </a>
            </li>
            <li class="nav-item">
              <a 
              class="nav-link <?= ($_GET['action'] == 'showDashboardPosts') ? 'active' : '' ?>" 
              href="index.php?action=showDashboardPosts">
                <span data-feather="file"></span>
                Articles
              </a>
            </li>
            <li class="nav-item">
              <a 
              class="nav-link <?= ($_GET['action'] == 'showDashboardComments') ? 'active' : '' ?>" 
              href="index.php?action=showDashboardComments">
                <span data-feather="message-square"></span>
                Commentaires
              </a>
            </li>
          </ul>
        </div>
      </nav>

    <?= $content ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="static/thirdParty/jquery-3.3.1.min.js"><\/script>')</script>
    <script src="static/thirdParty/bootstrap.bundle.min.js"></script>
    <script src="static/js/main.js"></script>

        <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
    
  </body>
</html>