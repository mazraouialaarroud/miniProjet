<?php
session_start();
if($_SESSION["AUTH"]==0)
{
header("location:index.php");
}
@$Nom=strtoupper(test_input(@$_POST["Nom"]));
@$Prenom=strtoupper(test_input(@$_POST["Prenom"]));
@$Email=strtoupper(@$_POST["Email"]);
@$Motdepass=strtoupper(@$_POST["Motdepass"]);
@$Admin=strtoupper(test_input(@$_POST["Admin"]));
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
        $ERR++;
    }

    if($ERR==0)
    {
        if($Admin=="OUI")
        {
          $Admin=1;
        }
        else
        {
            $Admin=0;
        }
        include('connexion.php');
        $result=$cnx->query("SELECT * FROM utti");
        if($result)
        {
          while($rows=$result->fetch_assoc())
          {
            if(strtoupper($rows["Email"])==strtoupper($Email) )
            {
                $ERRMESSAGE.=".l'Email est deja exist !!<br>";
                $ERR++;
    
            }
          }
        }
        if($ERR==0)
        {
            $result=$cnx->query("insert into utti (Nom,Prenom,Email,Modepass,admin,src) VALUES ('".$Nom."','".$Prenom."','".$Email."','".md5($Motdepass)."','".$Admin."','".$image."')");
            if($result)
            {
                 header("location:Menu_admin.php");
            }
            else
            {
                $ERRMESSAGE.="REUQET ERRO !!!";
            }
        }
     
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css_js/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css_js/css/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="css_js/Ajouter_utti_style.css">
    <script src="css_js/js/bootstrap.js"></script>

    <title>Ajouter_utillisateur</title>
    <style>
        .form-control
        {
            background: none;
            color: white;
        }
        .image-upload > input
       {
        display: none;
       }
      .image-upload img
       {
          width: 80px;
          cursor: pointer;
       }
    </style>
</head>
<body  style="background: url('images/natural-light-1.jpeg') fixed center; color:white">
    <div class="card col-md-4 col-sm-4">
      
    <form action="Ajoute_utti.php" enctype="multipart/form-data" method="Post">    
   
  <div class="image-upload">
        <label for="file-input">
                <div class="Aduttti">
                        <span>+<span>
                    </div>
        </label>
    
        <input type="file"  id="file-input"  name="imgs"/>
    </div>
    
    <br>
  
   <span>Nom:</span>
        <input class="form-control" type="text" name="Nom" id="Nom" value=<?php echo $Nom?>>
        <br>
        <span>Prenom:</span>
        <input class="form-control" type="text" name="Prenom" id="Prenom" value=<?php echo $Prenom?>>
        <br>
        <span>Email:</span>
        <input class="form-control" type="text" name="Email" id="Email" value=<?php echo $Email?>>
        <br>
        <span>Motdepass:</span>
        <input class="form-control" type="text" name="Motdepass" id="Motdepass" value=<?php echo $Motdepass?>>
        <br>
        <span>Admin:</span>
        oui <input  type="radio" name="Admin" value="oui" id="oui">
        non <input type="radio" name="Admin"  value="non"  id="non">
        <br>
        <input class="btn btn-primary btn-block" name="submit" type="submit" value="Ajouter">
        <input class="btn btn-primary btn-block" type="reset" value="Annuler">
         <span style="color: red;"><?php echo ($ERRMESSAGE);?></span>
   </form>
       
    </div>
</body>

</html>