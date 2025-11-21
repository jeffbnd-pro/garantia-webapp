<?php
session_start();
$pdo = include_once '../../config/db.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['iduser'])) {
    echo "Erreur : utilisateur non connecté";
    exit;
}

$iduser = $_SESSION['iduser'];

// Requête : garanties qui expirent dans < 30 jours et non expirées
$sql = "
    SELECT idWarranty, brandWarranty, nameWarranty, purchaseDate, warrantyTime, pdfWarranty_idPdfWarranty
    FROM Warranty
    WHERE user_iduser = :iduser
    AND warrantyTime > CURDATE()                      -- pas encore expirée
    AND warrantyTime <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)  -- expire dans < 30 jours
    ORDER BY warrantyTime ASC
";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':iduser', $iduser, PDO::PARAM_INT);
$stmt->execute();

$alerts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
    <meta charset="UTF-8">
    <title>Alertes - Garanties bientôt expirées</title>
    <style>
        #container-alert{
            margin-bottom: 110px;
        }

        .alert-card {
            border: 1px solid #ffbbbb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background: #ffecec;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .alert-card h3 {
            margin: 0 0 10px 0;
            color: #c00;
        }
        .days-left {
            font-weight: bold;
            color: #c00;
        }
    </style>
</head>


<h1>Alertes Garantie</h1>
<p>Voici les garanties qui expirent bientôt (moins de 30 jours).</p>

<section id="container-alert">
<?php if (!empty($alerts)): ?>

    <?php foreach ($alerts as $row): ?>

        <?php
        // Calcul du nombre de jours restants
        $today = new DateTime();
        $endDate = new DateTime($row['warrantyTime']);
        $interval = $today->diff($endDate);
        $daysLeft = $interval->days;
        ?>

        <div class="alert-card">

            <h3><?= htmlspecialchars($row['nameWarranty']) ?></h3>

            <p><strong>Marque :</strong>
                <?= htmlspecialchars($row['brandWarranty']) ?>
            </p>

            <p><strong>Fin de garantie :</strong>
                <?= htmlspecialchars($row['warrantyTime']) ?>  
            </p>

            <p class="days-left">
                ⏳ Il reste **<?= $daysLeft ?> jours** avant expiration.
            </p>

            <?php if (!empty($row['pdfWarranty_idPdfWarranty'])): ?>
                <p><strong>ID facture associée :</strong>
                    <?= htmlspecialchars($row['pdfWarranty_idPdfWarranty']) ?>
                </p>
            <?php endif; ?>

        </div>

    <?php endforeach; ?>

<?php else: ?>

    <p>Aucune garantie n'expire dans les 30 prochains jours. 👍</p>

<?php endif; ?>
</section>