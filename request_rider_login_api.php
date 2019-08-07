<?php 
    require_once("../DataBase/db.php");

    /* 0 means SUCCESS(LOGIN) 
       1 means ERROR(UNABLE TO LOGIN)
       2 means DB-ERROR(SOME DATABASE ERROR) */
    if($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["rider_id"])&& !empty($_POST["mobile_num"])){
        $rider_id = $_POST["rider_id"];
        $rider_mob_num = $_POST["mobile_num"];


        $loginQuery = "SELECT `rider_name` FROM rider WHERE `rider_id` = '$rider_id' AND `rider_number` = '$rider_mob_num'";
        $isRiderAbleToLogin = mysqli_query($con, $loginQuery);

        if($isRiderAbleToLogin){
            if(mysqli_num_rows($isRiderAbleToLogin) > 0)
                echo "0";
            else
                echo "1";
        }
        else
            echo "2";
    }
    else
        print "
            <p>You shouldn't be here..</p>
        ";
    


?>