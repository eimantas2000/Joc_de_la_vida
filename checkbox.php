<?php
$cookie_name = "x";
$cookie_value = $x = $_GET['cellules_horiz'];
setcookie($cookie_name, $cookie_value); 
$cookie_name_y = "y";
$cookie_value_y = $y = $_GET['cellules_vert'];
setcookie($cookie_name_y, $cookie_value_y);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="css.css"rel="stylesheet" type="text/css">
   
</head>
<body>
    <h1 class="h1_celules">Selecciona les cel·lules vives</h1>
    <div class="container_checbox">
    <form action="joc.php" method="POST">
<?php
    $y = $_GET['cellules_horiz'];
    $x = $_GET['cellules_vert'];

    for($i=0;$i<$x;$i++){
        echo "<br>";
        for($z=0;$z<$y;$z++){
            echo '<label><input type="checkbox" name="cel[]" value="'.$i.','.$z.'"/><span></span></label>';
        }
    }
    ?>
    
        <button class="button boto_enviar_checbox">enviar</button>
    </form>
    </div>
</body>
</html>