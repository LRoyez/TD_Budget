<?php
require_once __DIR__ . '/librairies/database.php';
require 'function.php';
$pdo = db_connect();


$exp_id = (int) $_GET['exp_id'];
// Pour récupérer l'id dans l'url

$user_id = (int) $_GET['user_id'];

// initialiser les valeurs inputs

$user_infos = user_details($pdo, $user_id);

$expenses = exp_details($pdo, $exp_id);


$users = user_list_san_tunas($pdo);

$inc_cats = cat_list($pdo);

$errors = [];

if (!empty($_POST)) {
    if (empty($_POST['exp_amount'])) {
        $errors['exp_amount'] = 'Le champ est requis';
    }
    if (empty($_POST['user_id'])) {
        $errors['user_id'] = 'Le champ est requis';
    } else if (!filter_var($_POST['user_id'], FILTER_VALIDATE_INT)) {
        $errors['user_id'] = 'La valeur renseignée est incorrecte !';
    }
    if (empty($_POST['exp_date'])) {
        $errors['exp_date'] = 'Le champ est requis';
    }
    
    if (empty($errors)) {
        
        $exp_id =  htmlentities($_GET['exp_id']);
        $exp_amount = htmlentities($_POST['exp_amount']);
        $exp_date = htmlentities($_POST['exp_date']);
        if (updateexpAmount($pdo, $exp_id, $exp_amount, $exp_date)) {
            header('location: userList.php');
            exit();
        }
    }
}

require_once 'inc/header.php';
?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <?php if (isset($success)) : ?>
        <?php endif ?>
        <div class="col-md-4">
            <h2 id="update-title" class="text-center">Modification des montants de <?= $user_infos['first_name'] . ' ' . $user_infos['last_name'] ?></h2>
            <form id="form-update" class="text-center" action="" method="post">
                <div class="mb-3">
                    <label class="mb-3" for="inc_amount">Revenu</label>
                    <input name="exp_amount" class="form-control" id="exp_amount" type="number" value="<?= $expenses['exp_amount'] ?>">
                    <p class="mb-0 text-danger"><?= $errors['exp_amount'] ?? '' ?></p>
                </div>
                <div class="mb-3 mx-auto" style="width:200px;">
                    <label for="inputDate" class="col-sm-8 col-form-label">Date</label>
                    <input type="date" value="<?= date('Y-m-d',strtotime($expenses['exp_date'])) ?>" name="exp_date" class="form-control">
                    <p class="mb-0 text-danger"><?= $errors['exp_date'] ?? '' ?></p>
                </div>

                <input type="hidden" name="user_id" value="<?= htmlentities($user_id) ?>">
                <input class="btn btn-primary " type="submit" value="Enregister">
            </form>
        </div>
    </div>
</div>


<?php require_once __DIR__ . '/inc/footer.php';