<?php
function delete_gemeente($delete_id){
    mysql_query("DELETE FROM gemeenten WHERE id = $delete_id");
    header("Location: gemeenten.php");
}

function warning_gemeente($gemeente_id){
    $query = mysql_query("SELECT * FROM gemeenten WHERE id = $gemeente_id");
    
    while($row = mysql_fetch_assoc($query)){
        $type = $row['type'];
        $naam = $row['name'];
        echo "Weet u zeker dat u <b>$type $naam</b> wilt verwijderen?";
        echo "<form method='POST' action=''>
                <table class='no-border'><tr><td><input type='submit' name='btnGemeenteJa' value='Ja'></td>
                <td><input type='submit' name='btnGemeenteNee' value='Nee'></td></tr></table>
                </form>";
    }
}

function update_gemeente($gemeente_id, $txtType, $txtNaam, $txtUrl){
	$txtType =  sanitize($txtType);
	$txtNaam =  sanitize($txtNaam);
	$txtUrl =  sanitize($txtUrl);
    mysql_query("UPDATE gemeenten SET type = '$txtType', name = '$txtNaam', url = '$txtUrl' WHERE id = $gemeente_id") or die(mysql_error());
    header("Location: gemeenten.php");
}

function get_gemeente($gemeente_id){
    $query = mysql_query("SELECT * FROM gemeenten WHERE id = $gemeente_id");
    
    while($row = mysql_fetch_assoc($query)){
        $type = $row['type'];
        $name = $row['name'];
        $url = $row['url'];
        
        echo "<tr><td>Type:</td><td><input type='text' name='txtType' value='$type'></td></tr>
                                    <tr><td>Naam:</td><td><input type='text' name='txtNaam' value='$name'></td></tr>
                                    <tr><td>Url:</td><td><input type='text' name='txtUrl' value='$url'></td></tr>";
                                    
    }
}

function insert_gemeente($txtType, $txtNaam,$txtUrl){
	
	$txtType = sanitize($txtType);
	$txtNaam = sanitize($txtNaam);
	$txtUrl = sanitize($txtUrl);

    mysql_query("INSERT INTO gemeenten VALUES('','$txtType', '$txtNaam', '$txtUrl')") or die(mysql_error());
    echo "<b>$txtType $txtNaam</b> is toegevoegd aan gemeenten";
}

function update_medewerker($mede_id, $txtNaam, $txtGsm, $txtEmail, $txtWerkzaam, $txtFunctie){
	
	$txtNaam = sanitize($txtNaam);
	$txtGsm = sanitize($txtGsm);
	$txtEmail = sanitize($txtEmail);
	$txtWerkzaam = sanitize($txtWerkzaam);
	$txtFunctie = sanitize($txtFunctie);
	
    mysql_query("UPDATE medewerkers SET naam = '$txtNaam', gsm = '$txtGsm', email = '$txtEmail', werkzaam = '$txtWerkzaam', functie = '$txtFunctie' WHERE id = $mede_id") or die(mysql_error());
    header("Location: medewerkers.php");
}
    
function get_medewerker($mede_id){
    $query = mysql_query("SELECT * FROM medewerkers WHERE id = $mede_id");
    
    while($row = mysql_fetch_assoc($query)){
        $naam = $row['naam'];
        $gsm = $row['gsm'];
        $email = $row['email'];
        $werkzaam = $row['werkzaam'];
        
        echo "<tr><td>Naam:</td><td><input type='text' name='txtNaam' value='$naam'></td></tr>
                                    <tr><td>GSM:</td><td><input type='text' name='txtGsm' value='$gsm'></td></tr>
                                    <tr><td>Email:</td><td><input type='text' name='txtEmail' value='$email'></td></tr>
                                    <tr><td>Werkzaam:</td><td><input type='text' name='txtWerkzaam' value='$werkzaam'></td></tr>
                                    <tr><td>Functie:</td><td><select name='opFunctie'>";
                                            get_functies();
        echo "
                                        </select></td>
                                    </tr>";
    }
}

function delete_medewerker($delete_id){
    mysql_query("DELETE FROM medewerkers WHERE id = $delete_id");
    header("Location: medewerkers.php");
}

function warning_medewerker($delete_id){
     $query = mysql_query("SELECT * FROM medewerkers WHERE id = $delete_id");
    
    while($row = mysql_fetch_assoc($query)){
        $naam = $row['naam'];
        echo "Weet u zeker dat u <b>$naam</b> wilt verwijderen?";
        echo "<form method='POST' action=''>
                <table class='no-border'><tr><td><input type='submit' name='btnMedeJa' value='Ja'></td>
                <td><input type='submit' name='btnMedeNee' value='Nee'></td></tr></table>
                </form>";
    }
}

function insert_medewerker($txtNaam, $txtGsm, $txtEmail, $txtWerkzaam, $txtFunctie){
	
	$txtNaam = sanitize($txtNaam);
	$txtGsm = sanitize($txtGsm);
	$txtEmail = sanitize($txtEmail);
	$txtWerkzaam = sanitize($txtWerkzaam);
	$txtFunctie = sanitize($txtFunctie);
	
    mysql_query("INSERT INTO medewerkers VALUES('','$txtNaam','$txtGsm','$txtEmail','$txtWerkzaam','$txtFunctie')");
    echo "$txtNaam is toegevoegd aan medewerkers!";
}

function get_functies(){
    $query = mysql_query("SELECT * FROM functies");
    
    while($row = mysql_fetch_assoc($query)){
        $id = $row['id'];
        $functie = $row['functie'];
        $functie_id = $row['functie_id'];
        
        echo "<option value='$functie_id' selected>$functie</option>";
    }
}

function get_medewerkers(){
    $query = mysql_query("SELECT * FROM medewerkers ORDER BY functie") or die(mysql_error());
    
    while($row = mysql_fetch_assoc($query)){
        $id = $row['id'];
        $naam = $row['naam'];
        $gsm = $row['gsm'];
        $email = $row['email'];
        $werkzaam = $row['werkzaam'];
        $functie = $row['functie'];
        if($functie == 1){
            $functie_txt = "Directeur";
        }
        else if($functie == 2){
            $functie_txt = "Adjunct-Directeur";
        }
        else if($functie == 3){
            $functie_txt = "Senior Inkoopadviseur";
        }
        else if($functie == 4){
            $functie_txt = "Inkoopadviseur";
        }
        else{
            $functie_txt = "Secretariaat";
        }
        echo "<tr><td>$naam</td><td>$gsm</td><td>$email</td><td>$werkzaam</td><td>$functie_txt</td><td><a href='medewerker_aanpassen.php?id=$id'><img src='Icons/ls_bewerken.png'></a></td><td><a href='delete.php?p=medewerkers&id=$id'><img src='Icons/ls_delete.png'></a></td></tr>";
    }
}

function get_gemeenten(){
    $query = mysql_query("SELECT * FROM gemeenten ORDER BY name") or die(mysql_error());
    
    while($row = mysql_fetch_assoc($query)){
        $id = $row['id'];
        $type = $row['type'];
        $name = $row['name'];
        $url = $row['url'];
        
        echo "<tr><td>$type</td><td>$name</td><td>$url</td><td><a href='gemeenten_aanpassen.php?id=$id'><img src='Icons/ls_bewerken.png'></a></td><td><a href='delete.php?p=gemeenten&id=$id'><img src='Icons/ls_delete.png'></a></td></tr>";
    }
}
function update_page($page_id, $title, $content){
    mysql_query("UPDATE pages SET title = '$title', content = '$content' WHERE id = $page_id") or die(mysql_error());
    header("Location: paginas.php");
}

function get_page($page_id){
    $query = mysql_query("SELECT * FROM pages WHERE id = $page_id");
    
    while($row = mysql_fetch_assoc($query)){
        $title = $row['title'];
        $content = $row['content'];
        echo "<b>Titel</b><br>";
        echo "<input type='text' value='$title' name='txtTitle'><br>";
        echo "<textarea name='txtContent' rows='20' cols='100' id='content'>$content</textarea><br>";
    }
}

function get_pages(){
    $query = mysql_query("SELECT * FROM pages ORDER BY id") or die(mysql_error());
    
    while($row = mysql_fetch_assoc($query)){
        $id = $row['id'];
        $title = $row['title'];
        $content = $row['content'];
        
        $content = substr($content, 0 , 100);
        $content = $content . "...";
        
        echo "<tr><td>$title</td><td>$content</td><td><a href='aanpassen.php?p=$id'><img src='Icons/ls_bewerken.png'></a></td></tr>";
    }
          
}

function admin_only($user_type){
    if($user_type != 1){
        header("Location: dashboard.php");
    }
}

function logged_in_redirect(){
    if(logged_in()){
        header("Location: dashboard.php");
    }
}

function protected_page(){

   if(!logged_in()){
    header("Location: index.php");
   }
    
}

function logged_in(){
        return (isset($_SESSION['id'])) ? true : false;
}

function user_data($user_id){
        $data = array();
        $user_id = (int)$user_id;
        
        $func_num_args = func_num_args();
        $fun_get_args = func_get_args();
        
        if($func_num_args > 1){
            unset($func_get_args[0]);
            
            $fields = '`' . implode('`, `', $func_get_args). '`';
            
            $data = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$user_id'"));
            
            return $data;
        }
    }

function login($username, $password){
    $username = sanitize($username);
    $password = sanitize($password);
    $password = sha1($password);
    $sql =  mysql_query("SELECT * FROM users WHERE username = '$username'") or die(mysql_error());
    
    while($row = mysql_fetch_assoc($sql)){
        $id = $row['id'];
        $usernameDb = $row['username'];
        $passwordDb = $row['password'];
    }
    
    if($username == $usernameDb && $password == $passwordDb){
        $_SESSION['id'] = $id;
        header("Location: dashboard.php");
    }
    else{
        echo "<pre>Gebruikersnaam of wachtwoord is incorrect!</pre><br>";
    }
}

function sanitize($data){
	   return htmlentities(strip_tags(mysql_real_escape_string($data)));
}