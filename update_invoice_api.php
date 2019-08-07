<?php
    if($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["customer_id"]) && !empty($_POST["invoice_id"])
        && !empty($_POST["invoice_number"]) && !empty($_POST["product_id"])
        && !empty($_POST["product_name"]) && !empty($_POST["product_description"]) 
        && !empty($_POST["product_quantity"]) && !empty($_POST["product_price"])){
        
        $invoice_id = $_POST["invoice_id"];
        $customer_id = $_POST["customer_id"];
        $invoice_number = $_POST["invoice_number"];
        $product_id = $_POST["product_id"];
        $product_name = $_POST["product_name"];
        $product_description = $_POST["product_description"];
        $product_quantity = $_POST["product_quantity"];
        $product_price = $_POST["product_price"];


        ini_set('display_errors', 1);

        $url = "https://books.zoho.com/api/v3/invoices/".$invoice_id;
        
        
        $editThisInvoices = array(
            "customer_id" => $customer_id,
            "invoice_number" => $invoice_number,
            "line_items" => array(
                array(
                    "item_id" => (string)$product_id,
                    "name" => $product_name,
                    "description" => $product_description,
                    "quantity" => $product_quantity,
                    "rate" => $product_price 
                )
            )
        );
        
        $jsonEditThisInvoice = json_encode($editThisInvoices);
        
        $data = array(
            'JSONString' => $jsonEditThisInvoice,
            "organization_id"  => '677074428',
            "send" => 'false'
        );
        $curl = curl_init($url);
        curl_setopt_array($curl, array(
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_HTTPHEADER => array('Authorization: Zoho-authtoken 4865853d7d34b1053b2b82f77c362d9b',"Content-Type: application/x-www-form-urlencoded")
        ));
        $isInvoiceUpdated = curl_exec($curl);
        print_r($isInvoiceUpdated);
        curl_close($curl);
    }
    else
        echo "YOU SHOULD NOT BE HERE.";
?>