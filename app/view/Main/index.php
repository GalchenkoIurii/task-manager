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
 </div>