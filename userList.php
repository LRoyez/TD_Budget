<?php
require_once __DIR__ . '/librairies/database.php';
require 'function.php';
$pdo = db_connect();

$user_Lists = user_list($pdo);

if (isset($_GET['inc_id'])) {
    $inc_id = (int) $_GET['inc_id'];

    if (delete_user($pdo, $inc_id) && (delete_user($pdo, $inc_id) > 0)) {
        $success = true;
    }
}

require_once __DIR__ . '/inc/header.php';
?>
<div class="container">
    <h3>Liste des utilisateurs:</h3>
    <img class="imguserlist" src="assets\img\undraw_Charts_re_5qe9.svg" alt="">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Revenu généré</th>
                    <th>Dépense</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user_Lists as $user_List) : ?>
                <tr>
                    
                    <td><?= ucfirst($user_List['last_name']) ?> <a href="Update.php?user_id=<?= $user_List['user_id'] ?>"><i class="fas fa-user-edit"></i></a></td>
                    <td><?= ucfirst($user_List['first_name']) ?></td>
                    <td><?= $user_List['inc_amount'] ?> <a href="updateincomes.php?user_id=<?= $user_List['user_id']?>&inc_id=<?= $user_List['inc_id']?>"><i class="fas fa-edit"></i></a></td>
                    <td><?= $user_List['exp_amount'] ?><a href="updateexpenses.php?user_id=<?= $user_List['user_id']?>&exp_id=<?= $user_List['exp_id']?>"><i class="fas fa-edit"></i></a></td>
                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>

<?php require_once __DIR__ . '/inc/footer.php';