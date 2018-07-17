<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="static/thirdParty/bootstrap.min.css" rel="stylesheet" /> 
        <link href="static/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="w-100">
                    <div class="header">
                        <a href="index.php">
                            <h1 class="font-weight-bold">Jean Forteroche</h1>
                            <h4 class="text-muted">Billet simple pour l'Alaska</h4>
                        </a>
                    </div>

                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100 sticky-top">
                        <a class="navbar-brand" href="index.php">Accueil</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav d-flex">
                                <li class="nav-item ">
                                    <a class="nav-link" href="index.php?action=showBlog">Blog</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="index.php?action=showAbout">À Propos</a>
                                </li>
                            </ul>   
                        </div>
                    </nav>

                    <?= $content ?>
                </div>
            </div>
        </div>

    <footer class="container-fluid py-5 bg-dark">
      <div class="row main-size">
        <div class="col-sm-4 text-white">
            <a href="index.php?action=showLogin" target="_blank" class="text-light">
            Jean Forteroche
            </a>
            <small class="d-block mb-3 text-muted">© 2017-2018</small>
        </div>
        <div class="col-sm-3">
          <h5 class="text-light">Pages</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="index.php">Accueil</a></li>
            <li><a class="text-muted" href="index.php?action=showBlog">Blog</a></li>
          </ul>
        </div>
        <div class="col-sm-4">
          <h5 class="text-light">À Propos</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="index.php?action=showAbout">À propos</a></li>
          </ul>
        </div>
      </div>
    </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="static/thirdParty/bootstrap.bundle.min.js"></script>
        <script src="static/js/main.js"></script>
    </body>
</html>