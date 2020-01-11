
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css_js/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css_js/css/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="./css_js/loginstyle.css">
    <script src="css_js/js/bootstrap.js"></script>
    <title>Login</title>
    <style>
        label
        {
            color: white;
        }
        input[type="text"],input[type="password"]
        {
            color: rgb(255, 255, 255);
            font-size: 120%;
        } 
    </style>
</head>
<body style="background: url('images/natural-light-1.jpeg') fixed center;" >
<div class="card col-md-4">
    <div  class="login">
               <form action="Test_Login.php" method="POST">
                <h1> Login </i></h1>
                <label for="label">Email</label>
                <input class="form-control" type="text" id="Email" name="Email" id="Email" onblur="test()" value=<?php echo @$email ?> >
                

                <span  class="border_liner"></span>
                <span id="err-email"></span>
                <br>
                <label for="label">Motdepass</label>
                    <input class="form-control" type="password" id="Motdepass" name="Motdepass" id="Motdepass" onblur="test()" value=<?php echo @$Modepass ?>  >
                    <i  id="eye" class="fa fa-eye"></i>
                    <span class="border_liner"></span>
                    <span id="err-Modepass"></span>
                    <br>
                    <br>
                    <input id="btn" class="btn btn-block" type="submit" value="Connecter" >
                    <div 
                    style="color: red;font-size: 10px;margin-top: 2%;">
                            <?php echo(@$ERR)?>
                    </div>
                    <br>
               </form>   
                <br>
    </div>
</div>
        <script>
            document.getElementById("btn").addEventListener("click",test);
            document.getElementById("eye").addEventListener("click",toglle);
            var Email=document.getElementById("Email");
            var Motdepass=document.getElementById("Motdepass");
            function test()
            {
                if(Email.value=="")
                {
                    document.getElementById("err-email").innerHTML="<h6>le champ Email est vide</h6>";
                }
                else
                {
                    document.getElementById("err-email").innerHTML="";   
                }

                if(Motdepass.value=="")
                {
                    document.getElementById("err-Modepass").innerHTML="<h6 class='col xs-6'>le champ Modepass est vide</h6>";
                }
                else
                {
                    document.getElementById("err-Modepass").innerHTML="";
                }

                    
            }
            function toglle()
            {
                var eye=document.getElementById("eye");
                var pass=document.getElementById("Motdepass");
                if(eye.className=="fa fa-eye")
                {
                    eye.className="fa fa-eye-slash";
                    pass.type="text";
            
                }
                else
                {
                    eye.className="fa fa-eye";
                    pass.type="Password";
                }
                
            }
        </script>
</body>
</html>
