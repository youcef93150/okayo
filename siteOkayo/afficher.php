<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients</title>
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
    <h1>Liste des Clients</h1>
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

    // Requête SQL pour sélectionner les données des clients
    $sql = "SELECT id, nom, adresse, code_client FROM client";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID Client</th>
                    <th>Nom</th>
                    <th>Adresse</th>
                    <th>Code Client</th>
                </tr>";
        // Afficher les données de chaque ligne
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"]. "</td>
                    <td>" . $row["nom"]. "</td>
                    <td>" . $row["adresse"]. "</td>
                    <td>" . $row["code_client"]. "</td>
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
