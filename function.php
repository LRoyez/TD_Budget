<?php
function addUser($pdo, $first_name, $last_name, $birth_date)
{
    $sql = "INSERT INTO `users`(`first_name`,`last_name`,`birth_date`) VALUES (:first_name, :last_name, :birth_date)";

    $req = $pdo->prepare($sql);
    $req->bindValue(':first_name', $first_name, PDO::PARAM_STR);
    $req->bindValue(':last_name', $last_name, PDO::PARAM_STR);
    $req->bindValue(':birth_date', $birth_date, PDO::PARAM_STR);

    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->rowCount();
    } catch (PDOException $e) {
        return false;
    }
}

function user_list($pdo)
{
    $sql = "SELECT 
    users.`user_id`,
    `last_name`,
    `first_name`,
    `inc_amount`,
    `exp_amount`,
    `inc_id`, 
    `exp_id`
FROM 
    `users`
LEFT JOIN `incomes` ON `incomes`.`user_id` = `users`.`user_id`
LEFT JOIN `expenses` ON `expenses`.`user_id` = `users`.`user_id`";

    $req = $pdo->query($sql);

    $users = $req->fetchALL(PDO::FETCH_ASSOC);
    return $users;
}
function user_list_san_tunas($pdo)
{
    $sql = "SELECT `user_id`, `first_name`, `last_name`, `birth_date` FROM `users`";
    $req = $pdo->query($sql);

    $users = $req->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}
function add_inc($pdo, $inc_amount, $inc_receipt_date, $inc_cat_id, $user_id)
{
    $sql = "INSERT INTO `incomes`(`inc_amount`, `inc_receipt_date`, `inc_cat_id`, `user_id`) VALUES (:inc_amount, :inc_receipt_date, :inc_cat_id, :user_id )";

    $req = $pdo->prepare($sql);

    $req->bindValue(':inc_amount', $inc_amount, PDO::PARAM_STR);
    $req->bindValue(':inc_receipt_date', $inc_receipt_date, PDO::PARAM_STR);
    $req->bindValue(':inc_cat_id', $inc_cat_id, PDO::PARAM_INT);
    $req->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    

    try {

        $req-> execute();

        return $req->rowCount();
    } catch(PDOException $e) {
        
        return false;
    }
}
function cat_list($pdo) {
    $sql = "SELECT * FROM incomes_categories";
    $req = $pdo->query($sql);

    return $req->fetchAll(PDO::FETCH_ASSOC);
}
function cat_list_spent($pdo) {
    $sql = "SELECT * FROM expenses";
    $req = $pdo->query($sql);

    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function add_exp($pdo, $exp_amount, $exp_date, $exp_label, $user_id)
{
    $sql = "INSERT INTO `expenses`(`exp_amount`, `exp_date`, `exp_label`, `user_id`) VALUES (:exp_amount, :exp_date, :exp_label, :user_id )";

    $req = $pdo->prepare($sql);

    $req->bindValue(':exp_amount', $exp_amount, PDO::PARAM_STR);
    $req->bindValue(':exp_date', $exp_date, PDO::PARAM_STR);
    $req->bindValue(':exp_label', $exp_label, PDO::PARAM_INT);
    $req->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    

    try {

        $req-> execute();

        return $req->rowCount();
    } catch(PDOException $e) {
        
        return false;
    }
}
function user_details($pdo, $user_id) {
    $sql = "SELECT `first_name`, `last_name`, `birth_date` FROM `users` WHERE `user_id` = :user_id";

    $req = $pdo->prepare($sql);
    $req->bindValue(':user_id', $user_id,  PDO::PARAM_INT);

    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        return false;
    }
}
function updateUser($pdo, $user_id, $first_name, $last_name, $birth_date){
    $sql = "UPDATE `users` SET `first_name` = :first_name, `last_name` = :last_name, `birth_date` = :birth_date WHERE `user_id` = :user_id";

    $req = $pdo->prepare($sql);
    $req->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $req->bindValue(':first_name', $first_name, PDO::PARAM_STR);
    $req->bindValue(':last_name', $last_name, PDO::PARAM_STR);
    $req->bindValue(':birth_date', $birth_date, PDO::PARAM_STR);

    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->rowCount();
    }catch(PDOException $e){
        return false;
    }
}


function updateAmount($pdo, $inc_id, $inc_amount, $inc_receipt_date, $inc_cat_id){
    $sql = "UPDATE `incomes` SET `inc_amount` = :inc_amount, `inc_receipt_date` = :inc_receipt_date, `inc_cat_id` = :inc_cat_id WHERE `inc_id` = :inc_id";

    $req = $pdo->prepare($sql);
    $req->bindValue(':inc_id', $inc_id, PDO::PARAM_INT);
    $req->bindValue(':inc_amount', $inc_amount, PDO::PARAM_STR);
    $req->bindValue(':inc_receipt_date', $inc_receipt_date, PDO::PARAM_STR);
    $req->bindValue(':inc_cat_id', $inc_cat_id, PDO::PARAM_INT);
    try {
        $req->execute();
        return $req->rowCount();
    }catch(PDOException $e){
        return false;
    }
}
function updateexpAmount($pdo, $exp_id, $exp_amount, $exp_date){
    $sql = "UPDATE `expenses` SET `exp_amount` = :exp_amount, `exp_date` = :exp_date WHERE `exp_id` = :exp_id";

    $req = $pdo->prepare($sql);
    $req->bindValue(':exp_id', $exp_id, PDO::PARAM_INT);
    $req->bindValue(':exp_amount', $exp_amount, PDO::PARAM_STR);
    $req->bindValue(':exp_date', $exp_date, PDO::PARAM_STR);
    try {
        $req->execute();
        return $req->rowCount();
    }catch(PDOException $e){
        return false;
    }
}
function inc_details($pdo, $inc_id) {
    $sql = "SELECT `inc_amount`, `inc_receipt_date`, `inc_cat_id` FROM `incomes` WHERE `inc_id` = :inc_id";

    $req = $pdo->prepare($sql);
    $req->bindValue(':inc_id', $inc_id,  PDO::PARAM_INT);

    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        return false;
    }
}
function exp_details($pdo, $exp_id) {
    $sql = "SELECT `exp_amount`, `exp_date` FROM `expenses` WHERE `exp_id` = :exp_id";

    $req = $pdo->prepare($sql);
    $req->bindValue(':exp_id', $exp_id,  PDO::PARAM_INT);

    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        return false;
    }
}
function calculIncomes($pdo) {
    $sql = "SELECT SUM(`inc_amount`) as totalInc FROM incomes";
    $req = $pdo->query($sql);

    $incomes = $req->fetchColumn();
    return $incomes;
}
function calculExpenses($pdo) {
    $sql = "SELECT SUM(`exp_amount`) as totalExp FROM expenses";
    $req = $pdo->query($sql);

    $expenses = $req->fetchColumn();
    return $expenses;
}

