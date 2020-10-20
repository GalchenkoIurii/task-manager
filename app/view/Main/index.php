 <div class="container">
     <?php if (isset($pagination->currentPage)) {
         $currentPage = 'page=' . $pagination->currentPage . '&';
     }?>
     <div class="row mb-5 justify-content-center align-items-center">
         <span class="align-bottom mr-5">Сортировать:</span>
         <div class="btn-group mr-5">
             <button type="button" class="btn btn-primary">По имени</button>
             <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <span class="sr-only">Toggle Dropdown</span>
             </button>
             <div class="dropdown-menu">
                 <a class="dropdown-item" href="?<?= $currentPage; ?>sort=nameasc">По возрастанию</a>
                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item" href="?<?= $currentPage; ?>sort=namedesc">По убыванию</a>
             </div>
         </div>
         <div class="btn-group mr-5">
             <button type="button" class="btn btn-primary">По email</button>
             <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <span class="sr-only">Toggle Dropdown</span>
             </button>
             <div class="dropdown-menu">
                 <a class="dropdown-item" href="?<?= $currentPage; ?>sort=emailasc">По возрастанию</a>
                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item" href="?<?= $currentPage; ?>sort=emaildesc">По убыванию</a>
             </div>
         </div>
         <div class="btn-group">
             <button type="button" class="btn btn-primary">По статусу</button>
             <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <span class="sr-only">Toggle Dropdown</span>
             </button>
             <div class="dropdown-menu">
                 <a class="dropdown-item" href="?<?= $currentPage; ?>sort=statusasc">По возрастанию</a>
                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item" href="?<?= $currentPage; ?>sort=statusdesc">По убыванию</a>
             </div>
         </div>
     </div>
        <div class="row mb-5">
            <div class="card-deck">
                <?php foreach ($tasks as $task) { ?>
                <div class="card">
                    <h5 class="card-header"><?= $task['user_name']; ?></h5>
                    <div class="card-body">
                        <h6 class="card-title"><?= $task['user_email']; ?></h6>
                        <p class="card-text"><?= $task['task_description']; ?></p>
                    </div>
                    <div class="card-footer">
                        <?php if ($task['status']) { ?>
                            <p>Статус: <span class="badge badge-success">Выполнено</span></p>
                        <?php } else { ?>
                            <p>Статус: <span class="badge badge-warning">В процессе</span></p>
                        <?php } ?>
                        <?php if ($task['edited'] && $user['name'] === 'admin') { ?>
                            <span class="badge badge-danger">Отредактировано администратором</span></p>
                        <?php } ?>
                        <?php if (!empty($user) && $user['name'] === 'admin') { ?>
                            <a href="edit?id=<?= $task['id']; ?>" class="btn btn-primary">Редактировать</a>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
     <div class="row mb-5 justify-content-center">
         <?php if ($pagination->pagesCount > 1) { ?>
             <nav>
                 <ul class="pagination">
                     <?= $pagination; ?>
                 </ul>
             </nav>
         <?php } ?>
     </div>
 </div>