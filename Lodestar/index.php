        <?php 
            include 'core/init.php';
            logged_in_redirect();
        ?>
<!DOCTYPE html>
<html>

    <head>
	<link rel="stylesheet" href="boilerplate.css">
	<link rel="stylesheet" href="page.css">
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0">
	<script>var __adobewebfontsappname__ = "reflow"</script>
	<script src="http://use.edgefonts.net/open-sans:n7,i7,n8,i8,i4,n3,i3,n4,n6,i6:all.js"></script>
    </head>
    <body>

    <div id="primaryContainer" class="primaryContainer clearfix">
        <div id="box" class="clearfix">
            <img id="image" src="img/pastedsvg%204.svg" class="image" />
            <form action="" method="POST">
            <label id="formgroup">
                <p id="text">
                INLOGNAAM
                </p>
                <input id="textinput" name="username" type="text" value=""></input>
            </label>
            <label id="formgroup1">
                <p id="text1">
                WACHTWOORD
                </p>
                <input id="textinput1" name="password" type="password" value=""></input>
            </label>
            <div id="box1" class="clearfix">
                <input id="input" type="submit" name="login" value="GO"></input>
            </form>
            </div>
        <?php
            
            if(isset($_POST['login'])){
                $username = $_POST['username'];
                $password = $_POST['password'];
                login($username, $password);
            }        
        ?>
        </div>
    </div>
    </body>
</html>