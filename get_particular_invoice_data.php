<?php
    if($_SERVER["REQUEST_METHOD"] === "GET" && !empty($_GET["invoice_id"]) && !empty($_GET["invoice_number"])){
        $invoice_id = $_GET["invoice_id"];
        $invoice_name = $_GET["invoice_number"];
        ini_set('display_errors', 1);

        $url = "https://books.zoho.com/api/v3/invoices/".$invoice_id."?organization_id=677074428";

        $header =['Authorization: Zoho-authtoken 4865853d7d34b1053b2b82f77c362d9b'];

        $curl = curl_init($url);
        curl_setopt_array($curl, array(
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_HTTPGET => 1,
            CURLOPT_RETURNTRANSFER => true
        ));
        $detailed_invoice = curl_exec($curl);
        print_r($detailed_invoice);
    }
    else
        echo "YOU SHOULD NOT BE ON THIS PAGE";
?>