<?php
$message = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Récupérer et nettoyer les champs
    $userName = htmlspecialchars(trim($_POST['userName']));
    $userSurname = htmlspecialchars(trim($_POST['userSurname']));
    $userEmail = htmlspecialchars(trim($_POST['userEmail']));
    $userPassword = $_POST['userPassword'];
    $userAge = !empty($_POST['userAge']) ? (int)$_POST['userAge'] : null;
    $roleId = 3; // rôle User

    // Validation simple
    if (empty($userName) || empty($userSurname) || empty($userEmail) || empty($userPassword)) {
        $message = "Veuillez remplir tous les champs obligatoires.";
    } elseif (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $message = "Adresse email invalide.";
    } elseif (strlen($userPassword) < 4) {
        $message = "Le mot de passe doit contenir au moins 4 caractères.";
    } else {
        try {
            // Vérifier si l'email existe déjà
            $stmt = $pdo->prepare("SELECT iduser FROM user WHERE userEmail=?");
            $stmt->execute([$userEmail]);
            if ($stmt->rowCount() > 0) {
                $message = "Cet email est déjà utilisé.";
            } else {
                // Hachage du mot de passe
                $hashedPwd = password_hash($userPassword, PASSWORD_DEFAULT);

                // Insérer l'utilisateur
                $stmt = $pdo->prepare("INSERT INTO user (userName, userSurname, userEmail, userPwd, userAge, role_iduserRole) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$userName, $userSurname, $userEmail, $hashedPwd, $userAge, $roleId])) {
                $message = "Inscription réussie ! Patientez vous allez être redirigé pour vous connecter";
                echo "<p>$message</p>";
                echo "<script>
                    setTimeout(function(){
                        window.location.href = 'http://localhost:8000/?page=connexion';
                    }, 4000);
                </script>";
            } else {
                    $message = "Erreur lors de l'inscription.";
                }
            }
        } catch (PDOException $e) {
            $message = "Erreur serveur : " . $e->getMessage();
        }
    }
}
?>





<section class="container">
    <div class="logo">
        <img src="/assets/images/Logo.png" alt="logo de la web app 'Garant'IA'" >
    </div>
    <div id="register-title">
        <p>Le Dashboard de garanties qui ne vous fera pas oublier votre argent.</p>
    </div>
    <form action="#" method="POST">
        <h2>Créer un compte</h2>
        <input type="text" name="userName" placeholder="Votre prénom" required value="<?= htmlspecialchars($_POST['userName'] ?? '') ?>">
        <input type="text" name="userSurname" placeholder="Votre nom" required value="<?= htmlspecialchars($_POST['userSurname'] ?? '') ?>">
        <input type="email" name="userEmail" placeholder="Votre email" required value="<?= htmlspecialchars($_POST['userEmail'] ?? '') ?>">
        <input type="password" name="userPassword" placeholder="Votre mot de passe" required>
        <input type="number" name="userAge" placeholder="Votre âge (optionnel)" value="<?= htmlspecialchars($_POST['userAge'] ?? '') ?>">
        <button type="submit" class="register-btn">Créer mon compte</button>
    </form>
    <a href="http://localhost:8000/?page=login">
        <p>J'ai déjà un compte</p>
    </a>

    <?php if($message != "") { echo "<p>$message</p>"; } ?>
</section>