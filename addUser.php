<?php
require_once __DIR__ . '/librairies/database.php';
require 'function.php';
$pdo = db_connect();

$error = [];
if (!empty($_POST)) {
    if (empty($_POST['first_name'])) {
        $error = true;
    }

    if (!$error) {
        $first_name = htmlentities($_POST['first_name']);
        $last_name = htmlentities($_POST['last_name']);
        $birth_date = htmlentities($_POST['birth_date']);
        if (addUser($pdo, $first_name, $last_name, $birth_date)) {
            $success = true;
        }
    }
}

require_once 'inc/header.php';
?>
<div class="container-fluid">
    <div class="row justify-content-end">
        <?php if(isset($success)) : ?>
            <?php endif ?>
        <div class="col-md-4">
            <h2 class="text-center">Ajouter un nouvel utilisateur</h2>
            <form class="text-center ms-auto" method="post">
                <div class="mb-3 mx-auto" style="width:200px;">
                    <label for="inputFirstname" class="col-sm-8 col-form-label">Prénom</label>
                    <input type="text" name="first_name" class="form-control" placeholder="Virgil" aria-label="First name">
                    <p class="mb-0 text-danger"><?= $error ? 'Le champ est requis' : '' ?></p>
                </div>
                <div class="mb-3 mx-auto" style="width:200px;">
                    <label for="inputLastname" class="col-sm-8 col-form-label">Nom</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Zanardi" aria-label="Last name">
                    <p class="mb-0 text-danger"><?= $error ? 'Le champ est requis' : '' ?></p>
                </div>
                <div class="mb-3 mx-auto" style="width: 200px;">
                    <label for="inputDate" class="col-sm-8 col-form-label">Date de naissance</label>
                    <input type="date" id="start" class="form-control" name="birth_date" min="1900-01-01" max="2021-12-31">
                </div>
                <div class="mb-3 mx-auto" style="width: 200px;">
                    <button class="btn btn-add" type="submit">Ajouter</button>
                </div>

            </form>
        </div>
    </div>
</div>


<?php require_once __DIR__ . '/inc/footer.php';