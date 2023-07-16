<?php

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$cnpj = $_POST['cnpj'];
$message = $_POST['message'];
$recaptcha = $_POST['g-recaptcha-response'];
$response_recaptcha = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdX6LgmAAAAAGJtx3hmwGhRGJs2ToI9c78WAi0e&response=" . $recaptcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);

/* print_r($response_recaptcha);
exit(); */

//CLEAN PHONE NUMBER
$phone =  str_replace("(", "", $phone);
$phone =  str_replace(")", "", $phone);
$phone =  str_replace("-", "", $phone);
$phone =  str_replace(" ", "", $phone);

//$response_recaptcha['success'] = TRUE;

if ($response_recaptcha['success'] == true) {

    try {
        /* TOKEN PIPEDRIVE */
        $api_token = '32bf6633d8212a83df97ab4a414c98d9fb59d04a';

        /* Cria a pessoa - PERSON */
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://intertechrio.pipedrive.com/v1/persons?api_token=$api_token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
    "name": "'.$name.'",
    "owner_id": 14265490,
    "email": [
        {
        "value": "'.$email.'",
        "primary": "true",
        "label": "form Encoder"
        }
    ],
    "phone": [
        {
        "value": "'.$phone.'",
        "primary": "true",
        "label": "mobile"
        }
    ]
    }',
        CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Cookie: __cf_bm=Jncw52BvHZSU9vP1AiwaAlzQnXk4qv9iitqO08X9F4U-1688433673-0-AZkhwbB5pZqaPkfBaUIzuebj8KQM37PetJEovHj9/6v2nqHFDWhaeSG+uVD/KGST9QW/j19KUu2qF0yXf0haLUk='
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        /* Trata o retorno da criação da pessoa */
        $response = json_decode($response, true);

        // Se a pessoa for cadastrada
        if ($response['success'] == true) {
            /* Cria o lead - LEAD */
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://intertechrio.pipedrive.com/v1/leads?api_token=$api_token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "title": "'.$name.' - '.' LP West 6100 '.'",
            "owner_id": 14265490,
            "person_id": '.$response['data']['id'].'
        }',
            CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Accept: application/json',
                    'Cookie: __cf_bm=Jncw52BvHZSU9vP1AiwaAlzQnXk4qv9iitqO08X9F4U-1688433673-0-AZkhwbB5pZqaPkfBaUIzuebj8KQM37PetJEovHj9/6v2nqHFDWhaeSG+uVD/KGST9QW/j19KUu2qF0yXf0haLUk='
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            /* Trata o retorno da criação da pessoa */
            $response = json_decode($response, true);

            if($response['success'] == true) {
               header('Location: success.php');
            } else {
                header('Location: error.php');
            }
        }
    } catch (\Throwable $th) {
        throw $th;
    }
}
