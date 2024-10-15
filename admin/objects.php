<?php

    //include_once 'db.php';


	class SITE_ADMIN
	{
        //declaração de variaveis 
        public $pdo;
        public $ARRAY_SITEINFO;
        public $ARRAY_USERINFO;
        public $ARRAY_DESCEMPRESAINFO;
        


        function conexao()
        {
            $host = 'localhost';
            $dbname = 'serconeo_dbprod';
            $user = 'serconeo_dbprod';
            $pass = 'dbprodserconeo';

            try {
                $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }


        public function stmtToArray($stmtFunction)
		{		
			$stmtFunction_array = array();							
			while ($row = $stmtFunction->fetch(PDO::FETCH_ASSOC))
			{	
				array_push($stmtFunction_array, $row);	
			}		
	
			return $stmtFunction_array;
		}	
	

        public function getSiteInfo()
        {          
                // Verifica se a conexão já foi estabelecida
                if(!$this->pdo){$this->conexao();}
            
            try{           
                $sql = "SELECT SBI_DCSITE, 
                                SBI_DCDOMAINSITE, 
                                SBI_DTRENEW_REGISTER_DOMAIN,
                                SBI_STSITE
                                FROM SBI_SITEBASEINFO";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $this->ARRAY_SITEINFO = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return ["error" => $e->getMessage()];
            }       
        }

        public function getVarEnvInfo()
        {       
            if(!$this->pdo){$this->conexao();}            
                      
            $sql = "SELECT VEN_IDVARENV, VEN_PARAMETER, VEN_VALUE FROM VEN_VARENV ORDER BY VEN_IDVARENV ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  
            return $result;              
        }

        public function getUserInfo()
        {          
                // Verifica se a conexão já foi estabelecida
                if(!$this->pdo){$this->conexao();}
            
            try{           
                $sql = "SELECT USA_IDUSERADMIN,                                  
                                USA_DCEMAIL, 
                                USA_NMNOME,
                                USA_DCSEXO
                                FROM USA_USERADMIN";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $this->ARRAY_USERINFO = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return ["error" => $e->getMessage()];
            }          
        }

        public function getDescInfo($page,$id)
        {          
                // Verifica se a conexão já foi estabelecida
                if(!$this->pdo){$this->conexao();}
            
            try{            
                $sql = "SELECT PAD_IDPAGEDESCR,                                  
                                PAD_DCTEXT, 
                                PAD_DCTITLE,
                                PAD_NMPAGE
                                FROM PAD_PAGEDESCR
                                WHERE PAD_NMPAGE = '".$page."' AND PAD_IDPAGEDESCR = $id";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return ["error" => $e->getMessage()];
            }          
        }

        public function updateDesc($PAD_DCTITLE, $PAD_DCTEXT, $PAD_IDPAGEDESCR, $PAD_NMPAGE)
        {          
            // Verifica se a conexão já foi estabelecida
            if (!$this->pdo) {
                $this->conexao();
            }
        
            try {
                $sql = "UPDATE PAD_PAGEDESCR 
                        SET PAD_DCTEXT = :PAD_DCTEXT, 
                            PAD_DCTITLE = :PAD_DCTITLE 
                        WHERE PAD_IDPAGEDESCR = :PAD_IDPAGEDESCR AND PAD_NMPAGE = :PAD_NMPAGE";

                $stmt = $this->pdo->prepare($sql);
            
                // Liga os parâmetros aos valores
                $stmt->bindParam(':PAD_DCTEXT', $PAD_DCTEXT, PDO::PARAM_STR);
                $stmt->bindParam(':PAD_DCTITLE', $PAD_DCTITLE, PDO::PARAM_STR);
                $stmt->bindParam(':PAD_IDPAGEDESCR', $PAD_IDPAGEDESCR, PDO::PARAM_INT);
                $stmt->bindParam(':PAD_NMPAGE', $PAD_NMPAGE, PDO::PARAM_STR);
            
                $stmt->execute();
            
                // Retorna uma mensagem de sucesso (opcional)
                return ["success" => "Descrição atualizada com sucesso."];
            } catch (PDOException $e) {
                // Captura e retorna o erro
                return ["error" => $e->getMessage()];
            }
        }

















        
    }