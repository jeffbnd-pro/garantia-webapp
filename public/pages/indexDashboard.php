<?php
session_start();

if (!isset($_SESSION['iduser'])) {
    echo "Erreur : utilisateur non connecté";
    exit;
}
?>

<div style="padding: 20px;">
    <h1>Dashboard</h1>
    <p>Bienvenue dans votre espace GarantIA.</p>

    <div id="dashboard-content">
        <!-- Contenu dynamique du Dashboard -->
    </div>
</div>