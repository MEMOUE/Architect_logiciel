<?php

$servername = "localhost";
$username = "root";
$password = "";
@$dbname = "test"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}


$nomErr = $prenomErr = $loginErr = $passwordErr = "";
$nom = $prenom = $login = $password = "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    if (empty($_POST["nom"])) {
        $nomErr = "Le nom est requis";
    } else {
        $nom = test_input($_POST["nom"]);
    }

    
    if (empty($_POST["prenom"])) {
        $prenomErr = "Le prénom est requis";
    } else {
        $prenom = test_input($_POST["prenom"]);
    }


    if (empty($_POST["login"])) {
        $loginErr = "Le login est requis";
    } else {
        $login = test_input($_POST["login"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Le mot de passe est requis";
    } else {
        $password = test_input($_POST["password"]);
    }

   
    if (empty($nomErr) && empty($prenomErr) && empty($loginErr) && empty($passwordErr)) {
        $stmt = $conn->prepare("INSERT INTO clients (nom, prenom, login, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nom, $prenom, $login, password_hash($password, PASSWORD_DEFAULT));
        if ($stmt->execute()) {
            echo "Inscription réussie!";
        } else {
            echo "Erreur: " . $stmt->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <style>
        .error {color: #FF0000;}
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>

<h2>Page d'inscription</h2>
<p><span class="error">* Champ requis</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo $nom;?>">
        <span class="error">* <?php echo $nomErr;?></span>
    </div>
    <div class="form-group">
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $prenom;?>">
        <span class="error">* <?php echo $prenomErr;?></span>
    </div>
    <div class="form-group">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" value="<?php echo $login;?>">
        <span class="error">* <?php echo $loginErr;?></span>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" value="<?php echo $password;?>">
        <span class="error">* <?php echo $passwordErr;?></span>
    </div>
    <button type="submit">S'inscrire</button>
</form>

</body>
</html>
