<?php
$nbr = 0;
$bdd = new PDO('mysql:host=127.0.0.1;dbname=bbb;charset=utf8', 'admin', 'pass');
$action = $bdd->query('SELECT * FROM signatures');
while ($val = $action->fetch()){
    $nbr++;
    $lastsend_msg = $val['express'];
}
if(!empty($_GET['e'])){
    $e=$_GET['e'];
    if ($e == 0) $txt = "merci de votre participation";
    else if ($e == 1) $txt = "merci de remplir toute les case marqué par un *";
    else if ($e == 2) $txt = "nous ne conaissont pas votre numeros etudiant, merci de le verifier. si le probleme perssiste SMS au 07.84.01.37.52 (Paul G.)";
    else if ($e == 3) $txt = "votre participation à deja ete enregistrer";
    else if ($e == 4) $txt = "erreur inconue, veuiller retenter ou SMS au 07.84.01.37.52 (Paul G.) ";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fin BBB</title>   
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div id="enTete">
        <h1>Nous demandons la fin de BBB</h1>
        <p class = "ET">BBB ne fonctionne pas et nous perdons du temps, affin de nous permetre de travailler dans de bonne condition, nous demandons de mettre fin à l'utilisation de BBB</p>
        <p class = "ET">cette petition à été signée par : <?php echo $nbr ?> perssones</p>
    </div>
    <div id="form">
        <?php if (!empty($txt)){?>
            <p id = "info"><?php echo $txt; ?></p>
        <?php } ?>
        <form  action="send.php" method="POST">
            <div>
                <label for="name">Nom Prenom * :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div>
                <label for="name">Numero etudiant * (ce Numero seras crypter et perssones n'y auras acces il valide juste votre participation):</label>
                <input type="text" id="num" name="num" required>
            </div>
            <div>
                <label for="msg">Exprimez vous :</label>
                <textarea id="msg" name="msg"></textarea>
            </div>
            <div class="button">
                <button type="submit">signé !</button>
            </div>
        </form>
    </div>
    <div>
        <h2>Dernierre Expression : <?php echo $lastsend_msg; ?></h2>
    </div>
    <p id="cr">Code source disponible : <a href="https://github.fr">githhub.fr</a></p>
</body>
</html>