<?php

class haruTest {


    public function login() {
      
        $url = 'https://clientapi.mrrodz.com/auth/login';
        $data = [
            'email' => 'michell.oliveira1602@gmail.com',
            'password' => '123456'
        ];

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'accept: */*',
            'x-client-id: 1',
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return curl_error($ch);
        } else {
            curl_close($ch);
            return $response;
        }

    }



}




?>