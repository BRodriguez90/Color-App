<?php
    session_start();
    include('db_connect.php');
    if($mysqli->error){
        print ("Error connecting!  Message:  ".$mysqli->error);
    } elseif(($mysqli->error) == false){

    }

    $palette_name = $_POST['palette_name'];
    $palette =  $_POST['palette'];
    $website = $_POST['website'];
   if ($palette_name != ''){
    $query_add_palette = "
                    INSERT
                        INTO
                            cb_palettes
                                (palette_name, palette_colors, user_id, website_name)
                        VALUES('".htmlspecialchars(addslashes($palette_name))."','$palette',".$_SESSION['logged_in_user_id'].",'".htmlspecialchars(addslashes($website))."')";

        if($mysqli->query($query_add_palette) === TRUE){
            echo "Palette added successfully.";
        } else{
            echo $mysqli->error;
        }
   }
/*

    $stmt = $mysqli->prepare("INSERT INTO cb_colors (hex_code) VALUES (?)");
    $stmt->bind_param("s", $hex_code);

    // set parameters and execute

    foreach ($_POST['hex_code'] as $value) {

        $firstname = $value;
        $stmt->execute();
    }*/



?>
