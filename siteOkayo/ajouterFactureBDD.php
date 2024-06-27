<?php
// Vérification si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Paramètres de connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "okayo";

    // Récupération des données du formulaire
    $reference = $_POST['reference'];
    $date_facturation = $_POST['date_facturation'];
    $date_echeance = $_POST['date_echeance'];
    $total_ht = $_POST['total_ht'];
    $total_ttc = $_POST['total_ttc'];
    $id = $_POST['id'];

    // Création de la connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    // Préparation de la requête SQL pour insérer une nouvelle facture
    $sql = "INSERT INTO facture (reference, date_facturation, date_echeance, total_ht, total_ttc, id) 
            VALUES (?, ?, ?, ?, ?, ?)";

    // Préparation de la requête
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Erreur lors de la préparation de la requête : " . $conn->error);
    }

    // Lier les paramètres
    $stmt->bind_param("ssssdi", $reference, $date_facturation, $date_echeance, $total_ht, $total_ttc, $id);

    // Exécuter la requête
    if ($stmt->execute()) {
        // Redirection en cas de succès
        header("Location: formulaireAjouterFacture.php?success=true");
        exit();
    } else {
        // Redirection en cas d'erreur lors de l'insertion dans facture
        header("Location: formulaireAjouterFacture.php?error=" . urlencode($stmt->error));
        exit();
    }

    // Fermeture de la requête et de la connexion
    $stmt->close();
    $conn->close();
}
?>
