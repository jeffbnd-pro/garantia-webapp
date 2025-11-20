<?php
session_start();

if (!isset($_SESSION['iduser'])) {
    echo "Erreur : utilisateur non connecté";
    exit;
}
?>

<div style="padding: 20px;">
    <h2>Alertes</h2>
    <p>Voici les garanties proches de leur expiration.</p>

    <div id="alert-content">
        <!-- Liste des garanties bientôt expirées -->
    </div>
</div>