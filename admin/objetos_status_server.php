<?php

    class WHMCPANEL_STATUS
	{
        //declaração de variaveis 
        private $token = "G3T065AP3A15QZ22FKYSF7NO30Y5ROT4";
        private $user = "codemaze";
                

        public function getInfoWebServer($apiApp)
	{
	        $user = "codemaze";
                        
	        $query = "https://127.0.0.1:2087/json-api/$apiApp?api.version=1";
	        //$query = "https://127.0.0.1:2087/json-api/loadavg?api.version=1";
	        //$query = "https://127.0.0.1:2087/json-api/get_disk_usage?api.version=1";
	        //$query = "https://127.0.0.1:2087/json-api/showbw?api.version=2";
                        
                        
	        $curl = curl_init();
	        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
	        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
	        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
                        
	        $header[0] = "Authorization: whm $this->user:$this->token";
	        curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
	        curl_setopt($curl, CURLOPT_URL, $query);
                        
	        $result = json_decode(curl_exec($curl));
	        $result = json_encode($result)  
	        curl_close($curl);
                    
                return $result;
        }		

    }

?>