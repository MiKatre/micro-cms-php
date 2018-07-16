<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="static/thirdParty/bootstrap.min.css" rel="stylesheet" /> 
        <link href="static/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>

        <div id="" class="container-fluid">
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
                                <a class="nav-link" href="#">Blog</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#">À Propos</a>
                            </li>
                            <li class="nav-item ml-auto">
                                <a class="nav-link" target="_blank" rel="noopener" href="index.php?action=showLogin">Connexion</a>
                            </li>

                            </ul>
                        </div>
                    </nav>

                    <?= $content ?>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="static/thirdParty/bootstrap.bundle.min.js"></script>
        <script src="static/js/main.js"></script>
    </body>
</html>