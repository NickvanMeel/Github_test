<?php 
            include 'core/init.php'; 
            protected_page();
        if(isset($_GET['p']) === true && empty($_GET['p']) === false){
            $page_id = $_GET['p'];
        }
        ?> 
<!DOCTYPE html>
<html>

    <head>
	<link rel="stylesheet" href="boilerplate.css">
	<link rel="stylesheet" href="dashboard.css">
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0">
	<script>var __adobewebfontsappname__ = "reflow"</script>
	<script src="http://use.edgefonts.net/open-sans:n7,i7,n8,i8,i4,n3,i3,n4,n6,i6:all.js"></script>
    <script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
        tinymce.init({
            selector: "#content",
			plugins: "table",
    		tools: "inserttable"
        });
    </script>
    </head>
    <body>

    <div id="primaryContainer" class="primaryContainer clearfix">
        <div id="Header" class="clearfix">
            <img id="logo" src="img/pastedsvg%207.svg" class="image" />
            <p id="text">
            <span id="textspan">Welkom,</span> <?php echo $user_data['username']; ?>&#x21;
            </p>
            <p id="text1">
                <a href="logout.php">Log uit</a>
            </p>
        </div>
        <div id="Container" class="clearfix">
            <p id="text2">
            PAGINA AANPASSEN
            </p>
            <p id="text3">
                <a href="dashboard.php">DASHBOARD</a>
            </p>
            <p id="text4">
                <a href="paginas.php">UW PAGINA&#x27;S</a>
            </p>
            <?php 
                $user_type = $user_data['type'];
                if($user_type == 1){
            ?>
            <p id="text5">
                <a href="accountbeheer.php">ACCOUNTBEHEER</a>
            </p>
            <?php
                }
            ?>
            <p id="text5">
                <a href="gemeenten.php">GEMEENTEN</a>
            </p>
            <p id="text5">
                <a href="medewerkers.php">MEDEWERKERS</a>
            </p>
            <div id="Content" class="clearfix">
                <p id="text6">
                    <span id="textspan1">
                        <form action="" method="POST">
                            <?php
                                get_page($page_id);
                            ?>
                            <input type="submit" value="" name="btnSave" class='btnOpslaan'>
                        </form>
                        <?php
                            if(isset($_POST['btnSave'])){
                                $title = $_POST['txtTitle'];
                                $content = $_POST['txtContent'];
                                update_page($page_id, $title, $content);
                            }
                        ?>
                    </span><br />
                </p>
            </div>
        </div>
        <div id="Footer" class="clearfix">
            <p id="text7">
            COPYRIGHT <?php echo date("Y"); ?>&nbsp;&copy; LODESTAR
            </p>
        </div>
    </div>
    </body>
</html>