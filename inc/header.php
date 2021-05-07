<?php
$class = basename($_SERVER['SCRIPT_FILENAME'], '.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="assets/css/style.css">

</head>

<body class="<?php echo $class ?>">
  <header>
    <nav class="navbar navbar-expand-md">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav_item"> <a class="nav-link" href="index.php" style="color:rgb(128, 122, 122);">Accueil</a></li>
          <li class="nav_item"> <a class="nav-link" href="addUser.php" style="color:rgb(128, 122, 122);">Ajout d'un utilisateur</a></li>
          <li class="nav_item"><a class="nav-link" href="returndeclare.php" style="color:rgb(128, 122, 122);">Déclaration de revenu</a></li>
          <li class="nav_item"><a class="nav-link" href="spentdeclare.php" style="color:rgb(128, 122, 122);">Déclaration de dépense</a></li>
          <li class="nav_item"><a class="nav-link" href="userList.php" style="color:rgb(128, 122, 122);">Liste des utilisateurs</a></li>
          <li class="nav_item"><a class="nav-link" href="charts.php" style="color:rgb(128, 122, 122);">Graphiques</a></li>
        </ul>
      </div>
    </nav>
  </header>