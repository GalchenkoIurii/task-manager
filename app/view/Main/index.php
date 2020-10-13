 <div class="container">
     <?= $_GET['id']; ?>
        <div class="row mb-5">
            <div class="card-deck">
                <?php foreach ($tasks as $task) { ?>
                <div class="card">
                    <h5 class="card-header"><?= $task['user_name']; ?></h5>
                    <div class="card-body">
                        <h6 class="card-title"><?= $task['user_email']; ?></h6>
                        <p class="card-text"><?= $task['task_description']; ?></p>
                        <?php if ($task['status']) { ?>
                            <p><span class="badge badge-success">Выполнено</span></p>
                        <?php } else { ?>
                            <p><span class="badge badge-warning">В процессе</span></p>
                        <?php } ?>
                        <a href="?id=<?= $task['id']; ?>" class="btn btn-primary">Смотреть</a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <form class="w-50 text-center">
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="task">Текст задачи</label>
                    <textarea class="form-control" id="task" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Добавить задачу</button>
            </form>
        </div>
    </div>