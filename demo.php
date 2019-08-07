<?php
    //define("URL", "https://books.zoho.com/api/v3/invoices?organization_id=677074428");
    
        $customer_id = "1589518000000069309";
        $invoice_number = "INV-10505";
        $product_id = "1589518000000075001";
        $product_name = "Hard Disk";
        $product_description = "Apple Ipod Silver Color";
        $product_quantity = 2;
        $product_price = "₹50000";
        

        $invoices = array(
            "customer_id" => $customer_id,
            "invoice_number" => $invoice_number,
            "line_items" => array(
                array(
                    "item_id" => $product_id,
                    "name" => $product_name 
                )
            )
        );

        $jsoninvoice = json_encode($invoices);
        
        $url = 'https://books.zoho.com/api/v3/invoices';
        $data = array(           
            'JSONString' => $jsoninvoice,
            "organization_id"  => '677074428',
            // "send" => 'false'
        );

        $ch = curl_init($url);

        curl_setopt_array($ch, array(
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => array('Authorization: Zoho-authtoken 4865853d7d34b1053b2b82f77c362d9b',"Content-Type: application/x-www-form-urlencoded")
        ));
        $response = curl_exec($ch);
        curl_close($ch);

        print_r($response);
        echo "<br><br>";
        //Without true it will be decoded as an Object of stdClass
        $jsondeO = json_decode($response);
        echo gettype($jsondeO);
        echo $jsondeO->message;
        echo "<br>---------------------<br>";
        //With true it will  be decoded as an Array.
        $jsondeA = json_decode($response, true);
        echo gettype($jsondeA);
        echo $jsondeA["message"];
?>