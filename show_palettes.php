<?php
    session_start();
    include('db_connect.php');
    $select_palettes_query = 
                                "SELECT
                                    u.user_name,
                                    p.palette_name,
                                    p.palette_colors,
                                    p.palette_id,
                                    p.website_name
                                FROM cb_users u, cb_palettes p
                                WHERE p.user_id = u.user_id
                                AND u.user_id = '".$_SESSION['logged_in_user_id']."'
                                ORDER BY palette_id DESC";

        $select_palettes_result = mysqli_query($connection,$select_palettes_query);

        function longUrl($x, $length){
                    
                    if(strlen($x)<=$length){
                        echo $x;
                    }else{
                        $y=substr($x,0,$length) . '...';
                        echo $y;
                    }
                }
    
        while($row = mysqli_fetch_array($select_palettes_result,MYSQLI_ASSOC)){
              $ex =  explode(',', $row["palette_colors"]); 
              echo '<div class="col-lg-4">';
              echo   '<p>'.$row["palette_name"].'</p>';
              echo  '<div class="palette_wrap">';
            foreach ($ex as $value) {
              echo '<div title="'.$value.'" style="background-color:' .$value. '; width:70px; height:200px; display:inline-block;">';
              echo '</div>';
                   // echo '<p>'.$value.'</p>';
             }
             unset($value);
              echo  '<p><em><strong>Made from:</strong>'.' '; 
              echo   longUrl($row["website_name"],25);
              echo  '</em></p>';
             echo  '</div>';
             echo  '</div>';    
        }
?>