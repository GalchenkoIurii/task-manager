<div class="container">
    <?php if (!empty($errorMessage)) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $errorMessage; ?>
            </div>
    <?php } ?>
    <div class="row d-flex justify-content-center">
        <form class="w-50 text-center" action="login" method="post">
            <div class="form-group">
                <label for="user_name">Имя</label>
                <input type="text" class="form-control" name="user_name" id="user_name" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <input type="submit" class="btn btn-primary" name="login" id="login" value="Войти">
        </form>
    </div>
</div>