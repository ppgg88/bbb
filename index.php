<?php
$nbr = 0;
$bdd = new PDO('mysql:host=127.0.0.1;dbname=bbb;charset=utf8', 'admin', '***');
$action = $bdd->query('SELECT * FROM signatures');
while ($val = $action->fetch()){
    $nbr++;
    $lastsend_msg = $val['express'];
}
if(!empty($_GET['e'])){
    $e=$_GET['e'];
    if ($e == 0) $txt = "merci de votre participation";
    else if ($e == 1) $txt = "merci de remplir toutes les cases marquées par un *";
    else if ($e == 2) $txt = "Nous ne connaissons pas votre numéro étudiant, merci de le vérifier, si le problème persiste SMS au 07.84.01.37.52 (Paul G.)";
    else if ($e == 3) $txt = "Votre participation a déjà été enregistrée";
    else if ($e == 4) $txt = "Erreur inconnue, veuillez retenter ou SMS au 07.84.01.37.52 (Paul G.) ";
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
        <p class = "ET">BBB ne fonctionne pas et nous perdons du temps, afin de nous permettre de travailler dans de bonnes conditions, nous demandons de mettre fin à l'utilisation de BBB</p>
        <p class = "ET">Cette pétition à été signée par : <?php echo $nbr ?> personnes</p>
    </div>
    <div id="form">
        <?php if (!empty($txt)){?>
            <p id = "info"><?php echo $txt; ?></p>
        <?php } ?>
        <form  action="send.php" method="POST">
            <div>
                <label for="name">Nom Prénom * :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div>
                <label for="name">Numéro étudiant * (ce numéro sera crypté et personne n'y aura accès il valide juste votre participation):</label>
                <input type="text" id="num" name="num" required>
            </div>
            <div>
                <label for="msg">Exprimez vous :</label>
                <textarea id="msg" name="msg"></textarea>
            </div>
            <div class="button">
                <button type="submit">Signé !</button>
            </div>
        </form>
    </div>
    <div>
        <h2>Dernière expression : <?php echo $lastsend_msg; ?></h2>
    </div>
    <p id="cr">Code source disponible : <a href="https://github.com/ppgg88/bbb">github.com</a></p>
</body>
</html>