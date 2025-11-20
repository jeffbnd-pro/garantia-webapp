<?php
session_start();

if (!isset($_SESSION['iduser'])) {
    echo "Erreur : utilisateur non connecté";
    exit;
}
?>

<div style="padding: 20px;">
    <h2>Utilisateur</h2>
    <p>Informations de votre compte.</p>

    <div id="user-content">
        <!-- Informations du profil utilisateur -->
    </div>
</div>