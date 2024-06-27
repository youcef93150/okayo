<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Factures</title>
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
    <h1>Liste des Factures</h1>
    <?php
    // Paramètres de connexion à la base de données
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "okayo";

    // Création de la connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    // Requête SQL pour sélectionner les données des factures et le nom des clients
    $sql = "SELECT facture.id, facture.reference, facture.date_facturation, facture.date_echeance, facture.total_ht, facture.total_ttc, client.nom AS NomClient 
            FROM facture
            INNER JOIN facture_prestation ON facture.id = facture_prestation.facture_id
            INNER JOIN client ON facture_prestation.client_id = client.id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID Facture</th>
                    <th>Référence</th>
                    <th>Date de Facturation</th>
                    <th>Date d'Échéance</th>
                    <th>Total HT</th>
                    <th>Total TTC</th>
                    <th>Nom du Client</th>
                </tr>";
        // Afficher les données de chaque ligne
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"]. "</td>
                    <td>" . $row["reference"]. "</td>
                    <td>" . $row["date_facturation"]. "</td>
                    <td>" . $row["date_echeance"]. "</td>
                    <td>" . $row["total_ht"]. "</td>
                    <td>" . $row["total_ttc"]. "</td>
                    <td>" . $row["NomClient"]. "</td>
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
<footer> <a href="accueil.html"> <button>Retour à l'accueil</button></a></footer>
</html>
