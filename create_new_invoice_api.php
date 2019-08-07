<?php

    if($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["customer_id"]) && !empty($_POST["invoice_number"]) 
    && !empty($_POST["product_list_json_format"]) && !empty($_POST["sub_total"]) && !empty($_POST["tax_total"])
    && !empty($_POST["total"])){
        
        $customer_id = $_POST["customer_id"];
        $invoice_number = $_POST["invoice_number"];
        $product_list_json = $_POST["product_list_json_format"];
        $product_list = json_decode($product_list_json,true);
        $sub_total = $_POST["sub_total"];
        $tax_amount = $_POST["tax_total"];
        $total_after_tax = $_POST["total"];

        $invoice_create_date = date("Y-m-d");
        $due_date = date('Y-m-d', strtotime("+30 days"));
        $new_invoices = array(
            "customer_id" => $customer_id,
            "invoice_number" => $invoice_number,
            "date" => $invoice_create_date,
            "due_date" => $due_date,
            "line_items" => $product_list,
            "sub_total"=> $sub_total,
            "tax_total"=> $tax_amount,
            "total"=> $total_after_tax,
            "allow_partial_payments"=> true,
            "last_modified_time" => $invoice_create_date
        );

        $json_new_invoice = json_encode($new_invoices);

        $url = 'https://books.zoho.com/api/v3/invoices';
        $data = array(
            'JSONString' => $json_new_invoice,
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