<?php
session_start();
if($_SESSION["AUTH"]==0)
{
header("location:index.php");
}

include("connexion.php");
@$ID=$_GET["ID"];
if($_SERVER["REQUEST_METHOD"]=="GET")
{
    $result=$cnx->query("SELECT * FROM utti WHERE ID=$ID");
    while($rows=$result->fetch_assoc())
    {
         @$Nom=$rows["Nom"];
         @$Prenom=$rows["Prenom"];
         @$Email=$rows["Email"];
     
    }
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
      
    <form action="Modifier_utti.php" enctype="multipart/form-data" method="Post">    
   
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
        <input class="form-control" type="text" name="Motdepass" id="Motdepass" >
        <br>
        <span>Admin:</span>
        oui <input  type="radio" name="Admin" value="oui" id="oui">
        non <input type="radio" name="Admin"  value="non"  id="non">
        <br>
        <input class="btn btn-primary btn-block" name="submit" type="submit" value="Modifier">
        <input class="btn btn-primary btn-block" type="reset" value="Annuler">
        <input type="hidden" name="ID" value=<?php echo $ID?>>
         <span style="color: red;"><?php echo (@$ERRMESSAGE);?></span>
   </form>
       
    </div>
</body>
</html>