<?php

    if($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["customer_id"]) && !empty($_POST["payment_mode"]) && !empty($_POST["amount"]) 
    && !empty($_POST["invoice_items_json"])){
    
        $customer_id = $_POST["customer_id"];
        $payment_mode = $_POST["payment_mode"];
        $amount = $_POST["amount"];
        $invoice_items_json = $_POST["invoice_items_json"];
        
        $invoice_items = json_decode($invoice_items_json, true);
        $payment_date = date("Y-m-d");
        $new_payment = array(
            "customer_id" => $customer_id,
            "payment_mode" => $payment_mode,
            "amount" => $amount,
            "date" => $payment_date,
            "invoices" => $invoice_items
        );

        $json_new_payment = json_encode($new_payment);

        $url = 'https://books.zoho.com/api/v3/customerpayments';
        $data = array(
            'JSONString' => $json_new_payment,
            "organization_id"  => '677074428',
            "send" => 'false'
        );
        $curl = curl_init($url);
        curl_setopt_array($curl, array(
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => array('Authorization: Zoho-authtoken 4865853d7d34b1053b2b82f77c362d9b',"Content-Type: application/x-www-form-urlencoded")
        ));
        $isNewInvoiceCreated = curl_exec($curl);
        print_r($isNewInvoiceCreated);
        curl_close($curl);
       
    
    
    }
    else
        echo "YOU SHOULD NOT BE HERE";
?>