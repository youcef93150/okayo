<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        h1 {
            text-align: center; /* Centrer le texte du titre */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        footer {
            text-align: center;
            margin-top: auto; /* Place le footer en bas de la page */
            padding: 10px 0; /* Ajoute un peu d'espace autour du footer */
            background-color: #f2f2f2; /* Fond gris clair pour le footer */
        }
        footer button {
            padding: 10px 20px; /* Espacement du bouton */
            font-size: 16px; /* Taille de la police */
            border: none;
            background-color: #007bff; /* Couleur de fond bleue pour le bouton */
            color: white; /* Couleur du texte */
            cursor: pointer;
            border-radius: 5px; /* Coins arrondis pour le bouton */
            text-decoration: none; /* Supprime le soulignement */
        }
        footer button:hover {
            background-color: #0056b3; /* Couleur de fond plus sombre au survol */
        }
    </style>
</head>
<body>
    <h1>Liste des Prestations avec Calcul TTC</h1>
    <?php
    // Paramètres de connexion à la base de données
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "okayo"; // Nom de la base de données mis à jour

    // Création de la connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    // Requête SQL pour sélectionner les données des prestations, factures et TVA
    $sql = "SELECT fp.id AS IdFacturePrestation, fp.quantite AS Quantite, fp.total_ht AS TotalHT, p.designation AS Designation, t.taux AS Taux 
            FROM facture_prestation fp
            INNER JOIN prestation p ON fp.prestation_id = p.id
            INNER JOIN tva t ON p.tva_id = t.id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID Facture Prestation</th>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>HT</th>
                    <th>TVA</th>
                    <th>TTC</th>
                </tr>";
        // Afficher les données de chaque ligne et calculer le TTC
        while($row = $result->fetch_assoc()) {
            $quantite = floatval($row["Quantite"]);
            $totalHT = floatval($row["TotalHT"]);
            $tva = floatval($row["Taux"]) / 100;
            $ttc = $totalHT * $quantite * (1 + $tva);
            
            echo "<tr>
                    <td>" . $row["IdFacturePrestation"]. "</td>
                    <td>" . $row["Designation"]. "</td>
                    <td>" . $quantite. "</td>
                    <td>" . $totalHT. " €</td>
                    <td>" . ($tva * 100). " %</td>
                    <td>" . number_format($ttc, 2). " €</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "0 résultats";
    }
    
    // Fermer la connexion
    $conn->close();
    ?>
</body>
<footer> 
    <a href="accueil.html">
        <button>Retour à l'accueil</button>
    </a>
</footer>
</html>
