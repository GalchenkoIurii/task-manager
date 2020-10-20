<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <?= $this->getMeta(); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
</head>
<body>
<header>
    <div class="bg-dark collapse show mb-5" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4><a href="<?= PATH; ?>" class="text-white">Task Manager</a></h4>
                    <p class="text-muted">Test web app</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <ul class="list-unstyled">
                        <?php if (!empty($user)) { ?>
                            <li class="mb-3"><span class="text-white"><?= $user['name']; ?></span></li>
                            <li><a href="logout" class="btn btn-primary" role="button">Выйти</a></li>
                        <?php } else { ?>
                            <li><a href="login" class="btn btn-primary" role="button">Авторизоваться</a></li>
                        <?php } ?>
                        <li><a href="add" class="btn btn-primary mt-3" role="button">Добавить задачу</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<main role="main">
    <?= $content; ?>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>