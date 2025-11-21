<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $brandWarranty   = htmlspecialchars(trim($_POST['brandWarranty']));
    $nameWarranty  = htmlspecialchars(trim($_POST['nameWarranty']));
    $purchaseDate   = $_POST['purchaseDate'];
    $warrantyTime   = $_POST['warrantyTime'];
    $userId         = $_SESSION['iduser'];

    if (empty($brandWarranty) || empty($nameWarranty) || empty($purchaseDate) || empty($warrantyTime)) {
        $message = "Veuillez remplir tous les champs.";
    } else {
        try {
            $sql = "INSERT INTO `Warranty` (`brandWarranty`, `nameWarranty`, `purchaseDate`, `warrantyTime`, `user_iduser`) VALUES (?,?,?,?,?);";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$brandWarranty, $nameWarranty, $purchaseDate, $warrantyTime, $userId])) {
               return true;
            } else {
                $message = "Erreur lors de l'ajout de la garantie : " . implode(", ", $stmt->errorInfo());
            }
        } catch (PDOException $e) {
            $message = "Erreur serveur : " . $e->getMessage();
        }
    }
}
?>
