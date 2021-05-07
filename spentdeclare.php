<?php
require_once __DIR__ . '/librairies/database.php';
require 'function.php';
$pdo = db_connect();

$spent_cats = cat_list_spent($pdo);

$users = user_list($pdo);

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
    if (empty($_POST['exp_amount'])) {
        $errors['exp_amount'] = 'Le champ est requis';
    } 
    
    if (empty($errors)) {
        
        $exp_amount =  htmlentities($_POST['exp_amount']);
        $exp_date = htmlentities($_POST['exp_date']);
        $exp_label = htmlentities($_POST['exp_label']);
        $user_id = htmlentities($_POST['user_id']);
        if (add_exp($pdo, $exp_amount, $exp_date, $exp_label, $user_id)) {
            $success = true;
        }
    }
}



require_once __DIR__ . '/inc/header.php';
?>
<div class="container-fluid">
    <div class="row justify-content-end">
        <div class="col-md-4">
            <h2 class="text-center">Déclarer une nouvelle dépense</h2>
            <form class="text-center ms-auto" method="post">
            <?php if (isset($success)) : ?>
                <?php endif ?>
                <div class="mb-3 mx-auto" style="width:200px;">
                    <label for="inputAmount" class="col-sm-8 col-form-label">Montant</label>
                    <input type="number" name="exp_amount" class="form-control">
                    <p class="mb-0 text-danger"><?= $errors['exp_amount'] ?? '' ?></p>
                </div>
                <div class="mb-3 mx-auto" style="width:200px;">
                    <label for="inputDate" class="col-sm-8 col-form-label">Date</label>
                    <input type="date" name="exp_date" class="form-control">
                    <p class="mb-0 text-danger"><?= $errors['exp_date'] ?? '' ?></p>
                </div>
                <div class="mb-3 mx-auto" style="width:200px;">
                    <label for="inputCat" class="col-sm-8 col-form-label">Catégorie</label>
                    <select name="exp_label" class="form-select" id="exp">
                        <?php foreach ($spent_cats as $spent_cat) : ?>
                            <option value="<?= $spent_cat['exp_id'] ?>"><?= $spent_cat['exp_label'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="mb-3 mx-auto" style="width: 200px;">
                    <label for="form-select">Selectionner un utilisateur</label>
                    <select class="form-select" name="user_id" id="user">
                        <?php foreach ($users as $user) : ?>
                            <option value="<?= $user['user_id'] ?>"><?= ucfirst($user['last_name'])   . ' ' . ucfirst($user['first_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3 mx-auto" style="width: 200px;">
                    <button class="btn btn-declare-spent" type="submit">Déclarer</button>
                </div>

            </form>
        </div>
    </div>
</div>


<?php require_once __DIR__ . '/inc/footer.php';