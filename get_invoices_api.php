<?php
    define("URL", "https://books.zoho.com/api/v3/invoices?organization_id=677074428");

    if($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["contact_id"])){
        $contact_id = $_POST["contact_id"];
        $header = ['Authorization: Zoho-authtoken 4865853d7d34b1053b2b82f77c362d9b'];

        //CURL SCRIPT

        $curl = curl_init(URL);
        curl_setopt_array($curl, array(
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_HTTPGET => 1,
            CURLOPT_RETURNTRANSFER => true
        ));
        $invoices = curl_exec($curl);

        print_r($invoices);
    }

?>