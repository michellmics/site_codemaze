<?php

	class WHMCPANEL_STATUS
	{
        //declaração de variaveis 
        public $token = "4ZES9HJF02MGINRLER9IBHB4J1W36B8A";
        


        public function getDiscUsage()
		{		
			
            $url = "https://localhost:2087/json-api/getdiskusage?api.version=1";
            $token = "4ZES9HJF02MGINRLER9IBHB4J1W36B8A";

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Evita problemas com SSL
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: inartcom:$token"
            ]);

            $response = curl_exec($ch);
            curl_close($ch);

            return $response;           

		}	
	

    }

?>