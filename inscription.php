<?php
if (isset($_POST['inscription'])) {
    $pseudo = $_POST['pseudo'] ?? '';
    $mail = $_POST['mail'] ?? '';
    $password = $_POST['password'] ?? '';
    $cpassword = $_POST['cpassword'] ?? '';

    if (!empty($pseudo) && !empty($mail) && !empty($password) && !empty($cpassword)) {
        if ($password === $cpassword) {
            $options = [
                'cost' => 12,
            ];

            $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);

            require_once '_db/database.php';
            $db->prepare("INSERT INTO utilisateur(pseudo, email, password)
            VALUES(:pseudo, :email, :password)")
                ->execute([
                    'pseudo' => $pseudo,
                    'email' => $mail,
                    'password' => $hashpass
                ]);
        } else {
            // afficher un message d'erreur si les mots de passe ne correspondent pas
            echo "Les mots de passe ne correspondent pas";
        }
    } else {
        // afficher un message d'erreur si des champs sont vides
        echo "Tous les champs sont obligatoires";
    }
}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <?php
    require_once('_menu/menu.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>Inscription</h1>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Pseudo</label>
                        <input type="text" class="form-control" name="pseudo" id="pseudo" value="" placeholder="Pseudo" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mail</label>
                        <input type="email" class="form-control" name="mail" id="mail" value="" placeholder="Mail" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="password" value="" placeholder="Mot de passe" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="cpassword" id="cpassword" value="" placeholder="Mot de passe" />
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="inscription" class="btn btn-primary">Inscription</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    require_once('_footer/footer.php');
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>