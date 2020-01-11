<?php
session_start();
if($_SESSION["AUTH"]==0)
{
header("location:index.php");
}
include("connexion.php");
@$nom=strtoupper(test_input(@$_POST["nom"]));
@$localisation=strtoupper(test_input(@$_POST["localisation"]));
@$description=strtoupper(@$_POST["description"]);
@$prix=strtoupper(@$_POST["prix"]);
@$copies=strtoupper(test_input(@$_POST["copies"]));
@$ERRMESSAGE="";
@$ERR=0;

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(empty($nom) ||!preg_match("#^[a-zA-Z]{3,10}$#",$nom))
    {
        $ERRMESSAGE.="La zone Nom est invalide !<br>";
        $ERR++;
    }
    if(empty($localisation) ||!preg_match("#^[a-zA-Z]{3,20}$#",$localisation))
    {
        $ERRMESSAGE.="La zone loalisation invalide !<br>";
        $ERR++;
    }
    if(empty($description) ||!preg_match("#^[a-zA-Z]{5,100}$#",$description))
    {
        $ERRMESSAGE.="La zone description invalide !<br>";
        $ERR++;
    }
    if(empty($prix) ||!preg_match("#^[0-9]{1,5}[a-zA-Z]{1,5}$#",$prix))
    {
        $ERRMESSAGE.="La zone prix invalide !<br>";
        $ERR++;
    }
    if(empty($copies) ||!preg_match("#^[0-9]{1,5}$#",$copies))
    {
        $ERRMESSAGE.="La zone copies invalide !<br>";
        $ERR++;
    }
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
          $ERRMESSAGE.=".le type de fichier est incorecte !!<br>";
          $ERR++;
        }
        else
        {
          $filepath = "users_images/".$_FILES["imgs"]["name"];
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
       include('connexion.php');
       $result=$cnx->query("SELECT * FROM images");
       if($result)
       {
         while($rows=$result->fetch_assoc())
         {
           if(strtoupper($rows["Nom"])==strtoupper($nom) )
           {
               $ERRMESSAGE.=".le Nom est deja existe !!<br>";
               $ERR++;
           }
         }
       }
    if($ERR==0)
    {
        $result=$cnx->query("insert into  images (Nom,localisation,description,src,prix,copies) VALUES ('".$nom."','".$localisation."','".$description."','".$image."','".$prix."','".$copies."')");
        if(!$result)
        {
            $ERRMESSAGE=".ERROR query !! <br>";
        }
        else
        {
          $ERRMESSAGE="<span style='color:green'>l'insertion bien faite</span>";
        }

    }
      }
      echo $ERRMESSAGE;
   }
  function test_input($data)
{
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
?>