<?php
declare(strict_types=1);

session_start();

require_once 'public/db/connection.php';

try {

    // Récupérer 1 seule produit en fct de l'id
    if (empty($_GET['code'])) {
        throw new Exception("Product code was not provided");
    }

    $code = $_GET['code'];

    $stmt = $pdo->prepare('SELECT productCode, productName, buyPrice FROM products WHERE productCode = ?');
    $stmt->execute([$code]);

    $product = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    echo $e->getMessage();
}

// Afficher la page produit
include 'public/views/includes/header.view.php';
include 'public/views/includes/product.view.php';
include 'public/views/includes/footer.view.php';
