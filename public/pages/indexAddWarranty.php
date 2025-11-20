<?php
session_start();

if (!isset($_SESSION['iduser'])) {
    echo "Erreur : utilisateur non connecté";
    exit;
}

$message = "";

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Récupérer et nettoyer les données
    $nameWarranty   = htmlspecialchars(trim($_POST['nameWarranty']));
    $brandWarranty  = htmlspecialchars(trim($_POST['brandWarranty']));
    $purchaseDate   = $_POST['purchaseDate'];
    $warrantyTime   = $_POST['warrantyTime'];
    $userId         = $_SESSION['iduser'];


    if (empty($nameWarranty) || empty($brandWarranty) || empty($purchaseDate) || empty($warrantyTime)) {
        $message = "Veuillez remplir tous les champs.";
    } else {
        try {
            // Préparer la requête
            $stmt = $pdo->prepare("
                INSERT INTO `Warranty` (`brandWarranty`, `nameWarranty`, `purchaseDate`, `warrantyTime`, `user_iduser`) VALUES (?, ?, ?, ?, ?);
            ");

            // Exécuter la requete
            if ($stmt->execute([$nameWarranty, $brandWarranty, $purchaseDate, $warrantyTime, $userId])) {
                $message = "Garantie ajoutée avec succès !";

                // (Optionnel) vider le formulaire apres ajout
                $nameWarranty = $brandWarranty = $purchaseDate = $warrantyTime = "";
            } else {
                $message = "Erreur lors de l'ajout de la garantie.";
            }
        } catch (PDOException $e) {
            $message = "Erreur serveur : " . $e->getMessage();
        }
    }
}
?>

<h2>Ajouter une garantie</h2>

<?php if ($message !== ""): ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form action="#" method="POST">
    <label>Nom du produit</label>
    <input type="text" name="nameWarranty" required value="<?= htmlspecialchars($nameWarranty ?? '') ?>">

    <label>Marque</label>
    <input type="text" name="brandWarranty" required value="<?= htmlspecialchars($brandWarranty ?? '') ?>">

    <label>Date d'achat</label>
    <input type="date" name="purchaseDate" required value="<?= htmlspecialchars($purchaseDate ?? '') ?>">

    <label>Date fin de garantie</label>
    <input type="date" name="warrantyTime" required value="<?= htmlspecialchars($warrantyTime ?? '') ?>">

    <button type="submit">Ajouter</button>
</form>
