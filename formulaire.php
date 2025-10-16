<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f6fa;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 40px;
            margin: 0;
            background-color: orange
        }

        form {
            background: #fff;
            padding: 20px 30px;
            border: 1px solid #dcdde1;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        h2 {
            text-align: center;
            color: #2f3640;
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #353b48;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #dcdde1;
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            border-color: #00a8ff;
            outline: none;
        }

        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 5px;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #00a8ff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 5px;
            transition: background-color 0.2s ease;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #0097e6;
        }

        .result,
        .errors {
            margin-top: 25px;
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            border: 1px solid #dcdde1;
            width: 350px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        h3 {
            color: #2f3640;
            margin-top: 0;
        }

        ul {
            margin: 0;
            padding-left: 20px;
        }

        li {
            color: #e84118;
        }
    </style>
</head>

<body>
    <div>
        <form method="POST" action="">
            <h2>Formulaire d’informations</h2>

            <label>Nom :</label>
            <input type="text" name="nom" required>

            <label>Âge :</label>
            <input type="number" name="age" required>

            <label>Sexe :</label>
            <input type="radio" name="sexe" value="Homme" required> Homme
            <input type="radio" name="sexe" value="Femme"> Femme
            <br><br>

            <label>Centres d’intérêt :</label>
            <input type="checkbox" name="interet[]" value="Sport"> Sport<br>
            <input type="checkbox" name="interet[]" value="Musique"> Musique<br>
            <input type="checkbox" name="interet[]" value="Lecture"> Lecture<br>
            <input type="checkbox" name="interet[]" value="Voyage"> Voyage<br><br>

            <label>Commentaire :</label>
            <textarea name="message" rows="4" required></textarea>

            <input type="submit" value="Envoyer">
            <input type="reset" value="Réinitialiser">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $erreurs = [];

            $nom = $_POST["nom"];
            $age = $_POST["age"];
            $sexe = $_POST["sexe"] ;
            $interets = $_POST["interet"];
            $message = $_POST["message"];

            if (empty($nom)) $erreurs[] = "Le nom est obligatoire.";
            if (empty($age) || $age < 0) $erreurs[] = "Veuillez entrer un âge valide.";
            if (empty($sexe)) $erreurs[] = "Veuillez sélectionner votre sexe.";
            if (empty($interets)) $erreurs[] = "Veuillez choisir au moins un centre d’intérêt.";
            if (empty($message)) $erreurs[] = "Le commentaire est obligatoire.";
            

            if (empty($erreurs)) {
                echo "<div class='result'>";
                echo "<h3> Merci, vos informations ont bien été envoyées !</h3>";
                echo "<p><strong>Nom :</strong> " . htmlspecialchars($nom) . "</p>";
                echo "<p><strong>Âge :</strong> " . htmlspecialchars($age) . "</p>";
                echo "<p><strong>Sexe :</strong> " . htmlspecialchars($sexe) . "</p>";
                echo "<p><strong>Centres d’intérêt :</strong> " . htmlspecialchars(implode(', ', $interets)) . "</p>";
                echo "<p><strong>Commentaire :</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>";
                echo "</div>";
            } else {
                echo "<div class='errors'>";
                echo "<h3> Veuillez corriger les erreurs suivantes :</h3><ul>";
                foreach ($erreurs as $erreur) {
                    echo "<li>" . htmlspecialchars($erreur) . "</li>";
                }
                echo "</ul></div>";
            }
        }
        ?>
    </div>
</body>

</html>


