<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="static/thirdParty/bootstrap.min.css" rel="stylesheet" /> 
        <link href="static/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <div id="main" class="container">
            <div class="row">
                <div class="mx-2">
                    <?= $content ?>
                </div>
            </div>
        </div>

        <script src="static/thirdParty/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="static/js/main.js"></script>
    </body>
</html>