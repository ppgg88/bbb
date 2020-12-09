<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=bbb;charset=utf8', 'admin', '*******');
if(!empty($_POST['nom']) AND !empty($_POST['num'])){

    $nom = htmlspecialchars($_POST['nom']);
    $num = htmlspecialchars($_POST['num']);
    $msg = '';
    if (!empty($_POST['msg'])){
        $msg = htmlspecialchars($_POST['msg']);
    }
    $requser = $bdd->prepare("SELECT * FROM etu WHERE num = ?");
    $requser->execute(array($num));
    $userexist = $requser->rowCount();
    if($userexist==1){
        $num=sha1($num);
        $req = $bdd->prepare("SELECT * FROM signatures WHERE netu = ?");
        $req->execute(array($num));
        $user = $req->rowCount();
        if($user==0){
            $insert = $bdd->prepare("INSERT INTO signatures(nom, netu, express) VALUES(?, ?, ?)");
            if ($insert->execute(array($nom, $num, $msg))){
                $erreur = 0;  //tout est OK
                echo "tout est OK";
            }
            else $erreur = 4; //erreur d'ecriture
        }
        else $erreur = 3; //participation multiple
    }
    else $erreur = 2; //num etu inconue
}
else $erreur = 1; //manque de case
header("location: index.php?e=$erreur");
 ?>