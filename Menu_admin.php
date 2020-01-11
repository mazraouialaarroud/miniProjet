<?php
@session_start();
if($_SESSION["AUTH"]==0)
{
header("location:index.php");
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
    <link rel="stylesheet" href="./css_js/Menu-adminstyle.css">
    <script src="css_js/js/bootstrap.js"></script>
    <title>Wallper(Menu-admin)</title>
<style>
    #img
    {
        position: static;
        width: 45%;
        height: 65%;
        border-radius: 50%;
        margin-top: -22%;
        margin-left: 27%;
        box-shadow: 0 1px 50px rgb(5, 5, 5);
        border: 4px solid rgba(196, 50, 233, 0.589);
    }
    .box-utti
    {
        width: 25%;
        height: 220px;
        background: none;
        color: white;
      
    }
    .menu{position: fixed;}
    .Aduttti{position: fixed;margin-left: 90%;}
    .lien
    {
      color: rgb(171, 87, 250);
    }
    .user-img
      {
        width:70px;
        height:70px;
        border-radius: 50px;
      }
</style>
</head>
<body style="background: url('images/natural-light-1.jpeg') fixed center;" >
    
   <div class="menu">
       <div class="elements">
           <br>
           <li class="name">
               <i class="fa fa-navicon"></i>
               Menu
               <br><br>
            </li>
            <li class="element"><img class="user-img" src=<?php echo $_SESSION["image"] ?>> <?php echo strtoupper(@$_SESSION["Nom"]);?></li>
        <li class="element"> <a href="" class="lien"><i class="fa fa-user-circle"></i>Profile</a> </li>
        <li class="element"> <a href="" class="lien"><i class="fa fa-users"></i>Utillisateur</a> </li>
        <li class="element"> <a href="Deconnexion.php" class="lien"><i class="fa fa-sign-out"></i>Logout</a> </li>
       </div>
   </div>

          <form action="Ajoute_utti.php" method="post">
           <input type="hidden" name="AUTH" value=<?php echo $_SESSION["AUTH"]?>>
           <button class="Aduttti" type="Submit">
                      <span>+<span>
           </button>
          </form>
   
 
  
  
<br>
<?php
include('connexion.php');
$result=$cnx->query("SELECT * FROM utti");
while($rows=$result->fetch_assoc())
{
  echo"<div  class='box-utti'> 
   <img  id='img'   src='".$rows["src"]."' />
     <br>
  <label for='label'>Nom:</label><span>".strtoupper($rows["Nom"])."</span><br>
  <label for='label'>Prenom:</label><span>".strtoupper($rows["Prenom"])."</span><br>
  <label for='label'>Email:</label><span>".strtoupper($rows["Email"])."</span><br>
  <br>
  <form action='Modifier.php'  action='GET'>
  <input type='hidden' name='ID' value=".$rows["ID"].">
  <input class='btn btn-primary' type='submit' value='Modifier'>
  </form>
  
</div>" ; 
} 
?>
 


</body>
</html>