 <div class="container">
     <?php if (isset($successMessage)) { ?>
         <div class="alert alert-success" role="alert">
             <?= $successMessage; ?>
         </div>
     <?php } elseif (isset($errorMessages)) {
         foreach ($errorMessages as $errorMessage) { ?>
             <div class="alert alert-danger" role="alert">
                 <?= $errorMessage; ?>
             </div>
         <?php } ?>
     <?php } elseif (isset($dbErrorMessage)) { ?>
         <div class="alert alert-danger" role="alert">
             <?= $dbErrorMessage; ?>
         </div>
     <?php } ?>
        <div class="row d-flex justify-content-center">
            <form class="w-50 text-center" action="<?= $formAction; ?>" method="post">
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?= $task['user_name']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= $task['user_email']; ?>">
                </div>
                <div class="form-group">
                    <label for="task">Текст задачи</label>
                    <textarea class="form-control" name="task" id="task" rows="3"><?= $task['task_description']; ?></textarea>
                </div>
                <?php if (!empty($user) && $user['name'] === 'admin') { ?>
                    <div class="form-group form-check">
                        <label class="form-check-label mr-5" for="status">Выполнено</label>
                        <input type="checkbox" class="form-check-input" name="status" id="status" <?php if ($task['status']) echo 'checked'?>>
                    </div>
                <?php } ?>
                <input type="hidden" id="taskId" name="taskId" value="<?= $task['id']; ?>">
                <input type="submit" class="btn btn-primary" name="addTask" value="<?= ($formAction === 'add') ? 'Добавить' : 'Редактировать'?> задачу">
            </form>
        </div>
    </div>