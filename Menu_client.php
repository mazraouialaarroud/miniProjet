<?php
@session_start();
if($_SESSION["AUTH"]==0)
{
header("location:index.php");
}
include("connexion.php");
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
    <link rel="stylesheet" href="css_js/Menu-clientstyle.css">
    <script src="css_js/js/bootstrap.js"></script>
    <script src="css_js/js/jquery/2.2.2/jquery-2.2.2.js"></script>
    <style>
      i[class="fa fa-download"]
      {
        color :rgb(183, 0, 255);
        width: 150px;
        height: 27px;
        background: none;
        border-radius: 10px;
        border: 2px solid rgb(183, 0, 255);
        font-size: 26px;
      }
      .form_ajoute input[type="file"]
      {
        margin-top: -9%;
        margin-left: 30%;
        opacity: 0;
        width: 120px;
      }
      .file-name
      {
  
        text-align: center;
        display: block;
        margin-top: 3%;
        color:white;
      }
      .bar
      {
        font-size: 10px;
        text-align: center;
        color:  rgb(183, 0, 255);
        display: none;
        border-radius: 10px;
        margin-top: 3%;
        height: 15px;
        background:none;
        border:  2px solid rgb(173, 166, 175); 
      }
      .file_name
      {
        color:  rgb(138, 104, 151);
        text-align: center;
      }
      p{text-align: center;}
      .user-img
      {
        width:70px;
        height:70px;
        border-radius: 50px;
      }
      </style>
    <title>Menu Client</title>
</head>
<body style="background: url('images/natural-light-1.jpeg') fixed center;" onload="Hide_form_edit()">
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
                 <li class="element"> <a href="Deconnexion.php" class="lien"><i class="fa fa-sign-out" ٌ></i>Logout</a> </li>
                </div>
            </div>

            <br><br><br>

          <i  class="fa fa-plus-circle" onclick="show_form_ajoue()"></i>

          <form id="form_ajoute" enctype="multipart/form-data" class="form_ajoute col-md-auto">
              <input type='text' id='nom' name='nom' placeholder='Nom' required >
              <br>
              <input type='text' id='localisation' name='localisation' placeholder='localisation' required>
              <br>
               <textarea id="des" name='description' cols='21' rows='5' placeholder='description' required></textarea>
              <br>
              <span> <i id="download" class="fa fa-download"></i></span>
              <input id="file" class="file" type="file" name="imgs">
              <br>
              <p class="col-xs-3">
                  <span class="file_name"></span>
              </p>
              <br>
              <input type='text' id='prix' name='prix' placeholder='prix' required>
              <input type='text' id='copies' name='copies' placeholder='copies' required>
              <br><br>
              <input id="ajout-btn" type="button" value="Ajouter" >
              <br>
              <div class="bar"></div>
              <span id="ERROR-ajou"  class="ERROR" style="color: red"><?php echo @$ERRMESSAGE?></span>

          </form>

            <?php
            include('connexion.php');
            $result=$cnx->query("SELECT * FROM images");
            while($rows=$result->fetch_assoc())
            {
              echo "<div class='corps'>
                  <i id='icon-edit' class='fa fa-edit' onclick='Show_form_edit(".$rows["ID"].")'></i>
                  <i id='icon-remove' class='fa fa-remove'></i>
              <img src='".$rows["src"]."'/>
              <p>
                ".$rows["description"]." 
                <br>
                <span style='display:inline-block;margin-top:300px'>prix:".$rows["prix"]."</span>
                <span style='margin-left:20px'> copies:".$rows["copies"]."</span>
              </p>
              <form style='margin-top:-150%' method='POST' action='Client_edit_image.php' name='edit' id='".$rows["ID"]."' class='form col-md-10'>
                <input type='text' name='nom' placeholder='Nom' >
                <br>
                <input type='text' name='localisation' placeholder='localisation'>
                <br>
                 <textarea name='description' cols='21' rows='5' placeholder='description'></textarea>
                <br>
                <input class='l' type='file' name='file'>
                <input type='text' name='prix' placeholder='prix'>
                <input type='text' name='copies' placeholder='copies'>
                <input type='hidden' name='id' value=".$rows["ID"].">
                        <button class='check' type='submit'>
                          <i class='fa fa-check' ></i>
                        </button>
              </form>
              </div> ";
            }
            ?>



</body>
<script>

    function Hide_form_edit()
    {
      var edit=document.getElementsByName('edit');
      for(var i=0;i<=edit.length-1;i++)
      {
        edit[i].style.display="none";
      }
    }

  function Show_form_edit(id)
  {
    if(document.getElementById(id).style.display=="none")
    {
      document.getElementById(id).style.display="inline-block";
    }
    else
    {
      document.getElementById(id).style.display="none";
    }

  }
    function show_form_ajoue()
    {
      if(document.getElementById("form_ajoute").style.display=="none")
      {
        document.getElementById('form_ajoute').style.display="inline-block";
      }
      else
      {
        document.getElementById('form_ajoute').style.display="none";
      }

    }
</script>
<script>
  $(document).ready(function(){
    
    $("#ajout-btn").click(function(){
    var formData = $("#form_ajoute")[0];
    var data=new FormData(formData);
    var width=0;
    $.ajax({
        url:"Ajouter_image.php",
        enctype: 'multipart/form-data',
        type: 'POST',
        data: data,
        async: false,
        success: function (data) {
          $(".bar").css('display','block');
          $(".bar").css('background','black');
          y=setInterval(function(){
          width++;
          $(".bar").css('width',width+"%");
          $(".bar").html(width+"%");
          if(width==100)
          {
            width=0;
            clearInterval(y);
            $(".ERROR").html(data);
          }},10);
        },
        cache: false,
        contentType: false,
        processData: false
    });
  
  });

  });

</script>
<script>
  $("#file").change(function(){
    var file=$("#file")[0];
    var name=file.value.split("\\")[2];
    $(".file_name").html(name);
  });
</script>
</html>
