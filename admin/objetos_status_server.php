<?php

	class WHMCPANEL_STATUS
	{
        //declaração de variaveis 
        public $token = "L12T1GH3J4AD272VVQMX3WTN6RAUBRAZ";
        


        public function getDiscUsage()
		{		
			
            $url = "https://r210us.hmservers.net:2087/json-api/getdiskusage?api.version=1";
            

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Evita problemas com SSL
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: inartcom:$this->token"
            ]);

            $response = curl_exec($ch);
            curl_close($ch);

            return $response;           

		}	
	

    }

?>