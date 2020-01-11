<?php
session_start();
@$ERR=" ";
$NOERROR=0;
@$_SESSION["Email"];
@$_SESSION["Modepass"];
@$_SESSION["Nom"];
@$_SESSION["Admin"]=0;
@$_SESSION["AUTH"]=false;
@$_SESSION["image"];
include('connexion.php');
if($_SERVER["REQUEST_METHOD"]==="POST")
{
    @$email=strtoupper($_POST["Email"]);
    @$Modepass=strtoupper($_POST["Motdepass"]);
    if(empty($email))
    {
      $ERR=".La Zonne Email est Vide ?<br>";
      $NOERROR++;
    }
    if(empty($Modepass))
    {
     $ERR.=".la Zonne Modepass est Vide ?<br>";
     $NOERROR++;
    }
    if (!preg_match(strtoupper("#^[a-z0-9._-]+@(hotmail|live|msn|gmail).[a-z]{2,4}$#"),$email))
    {
      $ERR.=".Email invalide ?<br>";
      $NOERROR++;
    }
    if($NOERROR==0)
    {
      $result=$cnx->query("SELECT * FROM utti");
      
      if($result)
      {
        while($rows=$result->fetch_assoc())
        {
          if(strtoupper($rows["Email"])==$email && ($rows["Modepass"])== md5($Modepass))
          {

            @$_SESSION["Email"]=$rows["Email"];
            @$_SESSION["Modepass"]=$rows["Modepass"];
            @$_SESSION["Nom"]=$rows["Nom"];
            @$_SESSION["AUTH"]=true;
            @$_SESSION["image"]=$rows["src"];
            break; 
          }
        }
        if($_SESSION["AUTH"]== false)
        {
          $ERR.=".Le Motdepass ou Email est inncorecte<br>";
          include("index.php");
        }
        else
        {
            if($rows["admin"]==1)
            {
              @$_SESSION["Admin"]=1;
              header("location:Menu_admin.php");
           
            }
            else
            {
              @$_SESSION["Admin"]=0;
              header("location:Menu_client.php");
            }
        }

      }
      else
      {
        $ERR.=".".$result->error_get_last."<br>";
      }

    }
    else
    {
      include("index.php");
    }
    
  }
?>