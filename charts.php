<?php
require_once __DIR__ . '/librairies/database.php';
require 'function.php';
$pdo = db_connect();

$calcul_inc =  calculIncomes($pdo);

$calcul_exp = calculExpenses($pdo);

require_once 'inc/header.php';
?>
<div class="container-fluid">
    <div class="row justify-content-center" id="homeimg">
        <div id="chartjs">
            <h2>Graphique dépenses revenues</h2>
            <canvas id="myChart" width="200" height="200" data-incomes="<?= $calcul_inc ?>" data-expenses="<?= $calcul_exp ?>" ></canvas>
            <p><?= $calcul_inc ?>€ de revenu</p>
            <p><?= $calcul_exp ?>€ de dépense</p>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/inc/footer.php';
