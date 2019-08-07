<?php 
    require_once("../DataBase/db.php");

    /* 0 means SUCCESS(LOGIN) 
       1 means ERROR(UNABLE TO LOGIN)
       2 means DB-ERROR(SOME DATABASE ERROR) */
    if($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["rider_id"])){
        $rider_id = $_POST["rider_id"];

        $customerAssignedQuery = "SELECT `customer_name`, `contact_id`, `on_which_day`, `on_which_date` AS date FROM assigned_customer WHERE `rider_id` = '$rider_id' ORDER BY date ASC";
        $isCustomerAssignedExist = mysqli_query($con, $customerAssignedQuery);

        if($isCustomerAssignedExist){
            if(mysqli_num_rows($isCustomerAssignedExist) > 0){
                while($row = mysqli_fetch_array($isCustomerAssignedExist)){
                    $customerAssignedArray[] =  array(
                        "customer_name" => $row[0],
                        'contact_id' => $row[1],
                        'on_which_day' => $row[2],
                        'on_which_date' => $row[3]
                    );
                }
                $customerAssignedJSON = json_encode($customerAssignedArray);
                //print_r($customerAssignedArray);
                print_r($customerAssignedJSON);
            }
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