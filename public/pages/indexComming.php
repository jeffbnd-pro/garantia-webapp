<?php
session_start();

if (!isset($_SESSION['iduser'])) {
    echo "Erreur : utilisateur non connecté";
    exit;
}
?>

<div style="padding: 20px;">
    <h2>Coming Soon</h2>
    <p>Cette fonctionnalité arrive bientôt !</p>

    <div id="coming-content">
        <!-- Placeholder futur -->
    </div>
</div>