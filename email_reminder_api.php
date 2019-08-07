<?php
    if($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["invoice_id"]) && !empty($_POST["to_mail_ids"])
        && !empty($_POST["cc_mail_ids"]) && !empty($_POST["subject"])
        && !empty($_POST["body"])){
        
        $invoice_id = $_POST["invoice_id"];
        $email = $_POST["to_mail_ids"];
        $cc_email = $_POST["cc_mail_ids"];
        $subject = $_POST["subject"];
        $email_body = $_POST["body"];
        

        ini_set('display_errors', 1);

        $url = "https://books.zoho.com/api/v3/invoices/".$invoice_id;
        
        
        $editThisEmail = array(
            "to_mail_ids" => $email,
            "cc_mail_ids" => $cc_email,
            "subject" => $subject,
            "body" => $email_body
        );
        
        $jsonEditThisEmail = json_encode($editThisEmail);
        
        $data = array(
            'JSONString' => $jsonEditThisEmail,
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
        $isEmailSent = curl_exec($curl);
        print_r($isEmailSent);
        curl_close($curl);
    }
    else
        echo "YOU SHOULD NOT BE HERE.";
?>