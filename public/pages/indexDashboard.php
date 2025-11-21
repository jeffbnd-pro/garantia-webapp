<?php
session_start();

// Import de l'objet PDO depuis ton fichier db.php
$pdo = include_once '../../config/db.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['iduser'])) {
    echo "Erreur : utilisateur non connecté";
    exit;
}

$iduser = $_SESSION['iduser'];

// Requête PDO pour récupérer les garanties liées à l'utilisateur
$sql = "SELECT idWarranty, brandWarranty, nameWarranty, purchaseDate, warrantyTime, pdfWarranty_idPdfWarranty 
        FROM Warranty 
        WHERE user_iduser = :iduser
        ORDER BY purchaseDate DESC";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':iduser', $iduser, PDO::PARAM_INT);
$stmt->execute();

// On récupère toutes les garanties sous forme de tableau associatif
$warranties = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard GarantIA</title>
    <style>
        #container-warranty{
            margin-bottom: 110px;
        }

        .warranty-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .warranty-card h3 { 
            margin: 0 0 10px 0; 
            color: #333;
        }
    </style>
</head>

<body>

<h1>Dashboard</h1>
<p>Bienvenue dans votre espace GarantIA.</p>

<h2>Vos garanties</h2>

<section id="container-warranty">
<?php if (!empty($warranties)): ?>

    <?php foreach ($warranties as $row): ?>
        <div class="warranty-card">

            <h3><?= htmlspecialchars($row['nameWarranty']) ?></h3>

            <p><strong>Marque :</strong> 
                <?= htmlspecialchars($row['brandWarranty']) ?>
            </p>

            <p><strong>Date d'achat :</strong> 
                <?= htmlspecialchars($row['purchaseDate']) ?>
            </p>

            <p><strong>Fin de garantie :</strong>
                <?= htmlspecialchars($row['warrantyTime']) ?>
            </p>

            <?php if (!empty($row['pdfWarranty_idPdfWarranty'])): ?>
                <p><strong>ID facture associée :</strong>
                    <?= htmlspecialchars($row['pdfWarranty_idPdfWarranty']) ?>
                </p>
            <?php endif; ?>

        </div>
    <?php endforeach; ?>

<?php else: ?>

    <p>Aucune garantie enregistrée pour le moment.</p>

<?php endif; ?>
</section>