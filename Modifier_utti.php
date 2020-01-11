<?php
@$Nom=strtoupper(test_input(@$_POST["Nom"]));
@$Prenom=strtoupper(test_input(@$_POST["Prenom"]));
@$Email=strtoupper(@$_POST["Email"]);
@$Motdepass=strtoupper(@$_POST["Motdepass"]);
@$Admin=strtoupper(test_input(@$_POST["Admin"]));
@$ID=$_POST["ID"];
@$ERRMESSAGE="";
@$ERR=0;
$ISNotIMG=0;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
 
    if(@$_FILES["imgs"]["size"]>=50000000)
    {
        $ERRMESSAGE.=".la taille de votre fichier est suppirieur a 50MB ! <br>";
        $ERR++;
    }
    else
    {
        $tab=array("GIF","PNG","JPG","JPEG","TIIF");
        $filename=@$_FILES["imgs"]["name"];
        $extention=pathinfo($filename,PATHINFO_EXTENSION);
        if(!in_array(strtoupper($extention),$tab))
        {
          $ERRMESSAGE.= "le type de fichier est incorecte !!<br>";
          $ERR++;
        }  
        else
        {
          $filepath = "users_images/" . $_FILES["imgs"]["name"];
          if(move_uploaded_file($_FILES["imgs"]["tmp_name"], $filepath)) 
          {
          $image= $filepath;
          } 
          else 
          {
          $ERRMESSAGE.= "Vous Devez sectione une image !!<br>";
          $ERR++;
          }
  
          }
    }
                 
    if(empty($Nom) || !preg_match("#^[a-zA-Z]{3,10}$#",$Nom))
    {
        $ERRMESSAGE.=".le Champs Nom est Invalide !<br>";
        $ERR++;
    }
    if(empty($Prenom)|| !preg_match(strtoupper("#^[a-zA-Z]{3,10}$#"),$Prenom))
    {
        $ERRMESSAGE.=".le Champs Prenom est Invalide !<br>";
        $ERR++;
    }
    if(empty($Email)  || !preg_match(strtoupper("#^[a-z0-9._-]+@(hotmail|live|msn|gmail).[a-z]{2,4}$#"),$Email))
    {
        $ERRMESSAGE.=".le Champs Email est Vide !<br>";
        $ERR++;
    }
    if(empty($Admin))
    {
        $ERRMESSAGE.=".Vous devez selection un choix(Admin .oui .nom ) !<br>";
        $ERR++;
    }
    if(empty($Motdepass) || !preg_match(strtoupper("#^[a-zA-Z]{3,10}[0-9]{2,3}[@/*-_(&|^!?]{1}#"),$Motdepass))
    {
        $ERRMESSAGE.=".le Champs Motdepass est Invalide vous devez suiver la form:(a-zA-Z {3,10} 0-9 {2,3} @/*-_(&|^!?]{1}) !<br>";
    }
    if($Admin=="OUI")
    {
      $Admin=1;
    }
    else
    {
        $Admin=0;
    }
    if($ERR==0)
    {
        include("connexion.php");
        $result=$cnx->query("update  utti set Nom='".$Nom."',Prenom='".$Prenom."' ,Email='".$Email."' ,Modepass='".md5($Motdepass)."' ,admin='".$Admin."' ,src='".$image."'where utti.ID=".$ID);
        if($result)
        {
             header("location:Menu_admin.php");
        }
        else
        {
            $ERRMESSAGE.="REUQET ERRO !!!";
            include("Modifier.php");
        }
    }
    else
    {
        include("Modifier.php");
    }


}
function test_input($data)
{
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
?>