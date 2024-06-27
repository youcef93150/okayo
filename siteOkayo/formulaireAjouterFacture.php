<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Facture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: calc(100% - 10px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        .form-group input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: #ff0000;
            font-size: 14px;
            margin-top: 5px;
        }
        .success-message {
            color: #28a745;
            font-size: 16px;
            margin-top: 10px;
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
    <div class="container">
        <h2 style="text-align: center;">Ajouter une Facture</h2>
        <form action="ajouterFactureBDD.php" method="post">
            <div class="form-group">
                <label for="reference">Référence :</label>
                <input type="text" id="reference" name="reference" required>
            </div>
            <div class="form-group">
                <label for="date_facturation">Date de Facturation :</label>
                <input type="date" id="date_facturation" name="date_facturation" required>
            </div>
            <div class="form-group">
                <label for="date_echeance">Date d'Échéance :</label>
                <input type="date" id="date_echeance" name="date_echeance" required>
            </div>
            <div class="form-group">
                <label for="total_ht">Total HT :</label>
                <input type="number" id="total_ht" name="total_ht" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="total_ttc">Total TTC :</label>
                <input type="number" id="total_ttc" name="total_ttc" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="id">Client :</label>
                <select id="id" name="id" required>
                    <option value="">Sélectionnez un client</option>
                    <?php
                    // Connexion à la base de données
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "okayo";

                    // Création de la connexion
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Vérification de la connexion
                    if ($conn->connect_error) {
                        die("Connexion échouée : " . $conn->connect_error);
                    }

                    // Requête SQL pour récupérer tous les clients
                    $sql = "SELECT id, nom FROM client";
                    $result = $conn->query($sql);

                    // Affichage des options du select
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["id"] . '">' . $row["nom"] . '</option>';
                        }
                    }

                    // Fermeture de la connexion
                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Ajouter Facture">
            </div>
        </form>
    </div>
</body>
<footer>
    <a href="accueil.html">
        <button>Retour à l'accueil</button>
    </a>
</footer>
</html>
