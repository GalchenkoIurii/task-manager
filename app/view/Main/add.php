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
            <form class="w-50 text-center" action="add" method="post">
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="task">Текст задачи</label>
                    <textarea class="form-control" name="task" id="task" rows="3"></textarea>
                </div>
                <input type="submit" class="btn btn-primary" name="addTask" value="Добавить задачу">
            </form>
        </div>
    </div>