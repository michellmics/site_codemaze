<?php

    //include_once 'db.php';


	class SITE_ADMIN
	{
        //declaração de variaveis 
        public $pdo;
        public $ARRAY_SITEINFO;
        public $ARRAY_USERINFO;
        public $ARRAY_USERINFOBYID;
        public $ARRAY_DESCEMPRESAINFO;
        public $ARRAY_CLIENTINFO;
        public $ARRAY_PRODUCTINFO;
        


        function conexao()
        {
            $host = 'localhost';
            $dbname = 'codemaze_dbprod';
            $user = 'codemaze_dbprod';
            $pass = 'dbprodcodemaze';

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

        public function getClientInfo()
        {          
                // Verifica se a conexão já foi estabelecida
                if(!$this->pdo){$this->conexao();}
            
            try{           
                $sql = "SELECT CLI_IDCLIENT,                                  
                                CLI_NMNAME, 
                                CLI_DCEMAIL,
                                CLI_DCCPFCNPJ,
                                CLI_DCRSOCIAL,
                                CLI_DCCITY,
                                CLI_DCSTATE,
                                CLI_STSTATUSPENDING,
                                CLI_STSTATUS,
                                CLI_DCCEP
                                FROM CLI_CLIENT
                                ORDER BY CLI_STSTATUSPENDING ASC";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $this->ARRAY_CLIENTINFO = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return ["error" => $e->getMessage()];
            }          
        }

        public function getProductInfo()
        {          
                // Verifica se a conexão já foi estabelecida
                if(!$this->pdo){$this->conexao();}
            
            try{           
                $sql = "SELECT PRS_IDPRODUTO_SERVICO,                                  
                                PRS_NMNOME, 
                                PRS_DCTIPO,
                                PRS_DCINVESTIMENTO,
                                PRS_DCDESCRICAO,
                                PRS_STSTATUS
                                FROM PRS_PRODUTO_SERVICO
                                ORDER BY PRS_NMNOME ASC";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $this->ARRAY_PRODUCTINFO = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return ["error" => $e->getMessage()];
            }          
        }

        public function getProductInfoBySearch($search)
        {          
                // Verifica se a conexão já foi estabelecida
                if(!$this->pdo){$this->conexao();}
            
            try{           
                $sql = "SELECT PRS_IDPRODUTO_SERVICO,                                  
                                PRS_NMNOME, 
                                PRS_DCTIPO,
                                PRS_DCINVESTIMENTO,
                                PRS_DCDESCRICAO,
                                PRS_STSTATUS
                                FROM PRS_PRODUTO_SERVICO
                                WHERE PRS_NMNOME LIKE :search
                                OR PRS_DCTIPO LIKE :search
                                OR PRS_DCDESCRICAO LIKE :search
                                OR PRS_STSTATUS LIKE :search
                                ORDER BY PRS_NMNOME ASC";

                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
                $stmt->execute();
                $this->ARRAY_PRODUCTINFO = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return ["error" => $e->getMessage()];
            }          
        }

        public function getClientInfoBySearch($search)
        {          
                // Verifica se a conexão já foi estabelecida
                if(!$this->pdo){$this->conexao();}
            
            try{           
                $sql = "SELECT CLI_IDCLIENT,                                  
                                CLI_NMNAME, 
                                CLI_DCEMAIL,
                                CLI_DCCPFCNPJ,
                                CLI_DCRSOCIAL,
                                CLI_DCCITY,
                                CLI_DCSTATE,
                                CLI_STSTATUSPENDING,
                                CLI_STSTATUS
                                FROM CLI_CLIENT
                                WHERE CLI_NMNAME LIKE :search
                                OR CLI_DCEMAIL LIKE :search
                                OR CLI_DCCPFCNPJ LIKE :search
                                OR CLI_DCCITY LIKE :search
                                OR CLI_DCSTATE LIKE :search
                                OR CLI_STSTATUSPENDING LIKE :search
                                OR CLI_STSTATUS LIKE :search";

                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
                $stmt->execute();
                $this->ARRAY_CLIENTINFO = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return ["error" => $e->getMessage()];
            }          
        }

        public function getClientInfoById($ID)
        {          
                // Verifica se a conexão já foi estabelecida
                if(!$this->pdo){$this->conexao();}
            
            try{           
                $sql = "SELECT *
                                FROM CLI_CLIENT
                                WHERE CLI_IDCLIENT = $ID";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $this->ARRAY_CLIENTINFO = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return ["error" => $e->getMessage()];
            }          
        }

        
        public function getProductInfoById($ID)
        {          
                // Verifica se a conexão já foi estabelecida
                if(!$this->pdo){$this->conexao();}
            
            try{           
                $sql = "SELECT *
                                FROM PRS_PRODUTO_SERVICO
                                WHERE PRS_IDPRODUTO_SERVICO = $ID";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $this->ARRAY_PRODUCTINFO = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return ["error" => $e->getMessage()];
            }          
        }

        public function getUserInfo()
        {          
                // Verifica se a conexão já foi estabelecida
                if(!$this->pdo){$this->conexao();}
            
            try{           
                $sql = "SELECT USA_IDUSERADMIN,                                  
                                USA_DCEMAIL, 
                                USA_DCNOME,
                                USA_DCSEXO
                                FROM USA_USERADMIN";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $this->ARRAY_USERINFO = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return ["error" => $e->getMessage()];
            }          
        }

        public function getUserInfoById($ID)
        {          
                // Verifica se a conexão já foi estabelecida
                if(!$this->pdo){$this->conexao();}
            
            try{           
                $sql = "SELECT USA_IDUSERADMIN,                                  
                                USA_DCEMAIL, 
                                USA_DCNOME,
                                USA_DCSEXO,
                                USA_DCSENHA
                                FROM USA_USERADMIN WHERE USA_IDUSERADMIN = $ID";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $this->ARRAY_USERINFOBYID = $stmt->fetch(PDO::FETCH_ASSOC);
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

        public function updateClientInfo($CLI_NMNAME, $CLI_DCCPFCNPJ, $CLI_DCRSOCIAL, $CLI_DCEMAIL, $CLI_DCTEL1, $CLI_DCTEL2, $CLI_DCADDRESS, $CLI_DCSTATE, $CLI_DCCITY, $CLI_DCOBS, $CLI_STSTATUS, $ID, $CLI_DCCEP)
        {          
            // Verifica se a conexão já foi estabelecida
            if (!$this->pdo) {
                $this->conexao();
            }

            try {
                $sql = "UPDATE CLI_CLIENT
                        SET CLI_NMNAME = :CLI_NMNAME,
                        CLI_DCCPFCNPJ = :CLI_DCCPFCNPJ,
                        CLI_DCRSOCIAL = :CLI_DCRSOCIAL,
                        CLI_DCEMAIL = :CLI_DCEMAIL,
                        CLI_DCTEL1 = :CLI_DCTEL1,
                        CLI_DCTEL2 = :CLI_DCTEL2,
                        CLI_DCADDRESS = :CLI_DCADDRESS,
                        CLI_DCSTATE = :CLI_DCSTATE,
                        CLI_DCCITY = :CLI_DCCITY,
                        CLI_DCOBS = :CLI_DCOBS,
                        CLI_STSTATUS = :CLI_STSTATUS,
                        CLI_DCCEP = :CLI_DCCEP
                        WHERE CLI_IDCLIENT = :CLI_IDCLIENT";
                        
                $stmt = $this->pdo->prepare($sql);
            
                // Liga os parâmetros aos valores
                $stmt->bindParam(':CLI_NMNAME', $CLI_NMNAME, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCCPFCNPJ', $CLI_DCCPFCNPJ, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCRSOCIAL', $CLI_DCRSOCIAL, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCEMAIL', $CLI_DCEMAIL, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCTEL1', $CLI_DCTEL1, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCTEL2', $CLI_DCTEL2, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCADDRESS', $CLI_DCADDRESS, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCSTATE', $CLI_DCSTATE, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCCITY', $CLI_DCCITY, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCOBS', $CLI_DCOBS, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_STSTATUS', $CLI_STSTATUS, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_IDCLIENT', $ID, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCCEP', $CLI_DCCEP, PDO::PARAM_STR);
                
                $stmt->execute();
            
                // Retorna uma mensagem de sucesso (opcional)
                return ["success" => "Cliente inserido com sucesso."];
            } catch (PDOException $e) {
                // Captura e retorna o erro
                return ["error" => $e->getMessage()];
            }
        }

        public function insertUserInfo($USA_DCEMAIL, $USA_DCNOME, $USA_DCSEXO, $USA_DCSENHA)
        {          
            // Verifica se a conexão já foi estabelecida
            if (!$this->pdo) {
                $this->conexao();
            }
        
            try {
                $sql = "INSERT INTO USA_USERADMIN 
                        (USA_DCEMAIL, USA_DCNOME, USA_DCSEXO, USA_DCSENHA) 
                        VALUES (:USA_DCEMAIL, :USA_DCNOME, :USA_DCSEXO, :USA_DCSENHA)";

                $stmt = $this->pdo->prepare($sql);
            
                // Liga os parâmetros aos valores
                $stmt->bindParam(':USA_DCEMAIL', $USA_DCEMAIL, PDO::PARAM_STR);
                $stmt->bindParam(':USA_DCNOME', $USA_DCNOME, PDO::PARAM_STR);
                $stmt->bindParam(':USA_DCSEXO', $USA_DCSEXO, PDO::PARAM_STR);
                $stmt->bindParam(':USA_DCSENHA', $USA_DCSENHA, PDO::PARAM_STR);
            
                $stmt->execute();
            
                // Retorna uma mensagem de sucesso (opcional)
                return ["success" => "Usuário adm inserido com sucesso."];
            } catch (PDOException $e) {
                // Captura e retorna o erro
                return ["error" => $e->getMessage()];
            }
        }

        public function insertClientInfo($CLI_NMNAME, $CLI_DCCPFCNPJ, $CLI_DCRSOCIAL, $CLI_DCEMAIL, $CLI_DCTEL1, $CLI_DCTEL2, $CLI_DCADDRESS, $CLI_DCSTATE, $CLI_DCCITY, $CLI_DCOBS, $CLI_DCCEP)
        {          
            // Verifica se a conexão já foi estabelecida
            if (!$this->pdo) {
                $this->conexao();
            }
            $CLI_STSTATUS = "ATIVO";
            $CLI_DTDATA_INSERT = date('Y-m-d H:i:s'); // Formato: 2024-10-17 08:30:00
            $CLI_STSTATUSPENDING = "Recebido";
            try {
                $sql = "INSERT INTO CLI_CLIENT 
                        (CLI_NMNAME, CLI_DCCPFCNPJ, CLI_DCRSOCIAL, CLI_DCEMAIL, CLI_DCTEL1, CLI_DCTEL2, CLI_DCADDRESS, CLI_DCSTATE, CLI_DCCITY, CLI_DCOBS, CLI_DTDATA_INSERT, CLI_STSTATUSPENDING, CLI_STSTATUS, CLI_DCCEP) 
                        VALUES (:CLI_NMNAME, :CLI_DCCPFCNPJ, :CLI_DCRSOCIAL, :CLI_DCEMAIL, :CLI_DCTEL1, :CLI_DCTEL2, :CLI_DCADDRESS, :CLI_DCSTATE, :CLI_DCCITY, :CLI_DCOBS, :CLI_DTDATA_INSERT, :CLI_STSTATUSPENDING, :CLI_STSTATUS, :CLI_DCCEP)";

                $stmt = $this->pdo->prepare($sql);
            
                // Liga os parâmetros aos valores
                $stmt->bindParam(':CLI_NMNAME', $CLI_NMNAME, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCCPFCNPJ', $CLI_DCCPFCNPJ, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCRSOCIAL', $CLI_DCRSOCIAL, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCEMAIL', $CLI_DCEMAIL, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCTEL1', $CLI_DCTEL1, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCTEL2', $CLI_DCTEL2, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCADDRESS', $CLI_DCADDRESS, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCSTATE', $CLI_DCSTATE, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCCITY', $CLI_DCCITY, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCOBS', $CLI_DCOBS, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DTDATA_INSERT', $CLI_DTDATA_INSERT, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_STSTATUSPENDING', $CLI_STSTATUSPENDING, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_STSTATUS', $CLI_STSTATUS, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_DCCEP', $CLI_DCCEP, PDO::PARAM_STR);
                
                $stmt->execute();
            
                // Retorna uma mensagem de sucesso (opcional)
                return ["success" => "Cliente inserido com sucesso."];
            } catch (PDOException $e) {
                // Captura e retorna o erro
                return ["error" => $e->getMessage()];
            }
        }

        public function insertProductInfo($PRS_NMNOME, $PRS_DCTIPO, $PRS_DCINVESTIMENTO, $PRS_STSTATUS, $PRS_DCDESCRICAO)
        {          
            // Verifica se a conexão já foi estabelecida
            if (!$this->pdo) {
                $this->conexao();
            }
            
            try {
                $sql = "INSERT INTO PRS_PRODUTO_SERVICO 
                        (PRS_NMNOME, PRS_DCTIPO, PRS_DCINVESTIMENTO, PRS_STSTATUS, PRS_DCDESCRICAO) 
                        VALUES (:PRS_NMNOME, :PRS_DCTIPO, :PRS_DCINVESTIMENTO, :PRS_STSTATUS, :PRS_DCDESCRICAO)";

                $stmt = $this->pdo->prepare($sql);
            
                // Liga os parâmetros aos valores
                $stmt->bindParam(':PRS_NMNOME', $PRS_NMNOME, PDO::PARAM_STR);
                $stmt->bindParam(':PRS_DCTIPO', $PRS_DCTIPO, PDO::PARAM_STR);
                $stmt->bindParam(':PRS_DCINVESTIMENTO', $PRS_DCINVESTIMENTO, PDO::PARAM_STR);
                $stmt->bindParam(':PRS_DCDESCRICAO', $PRS_DCDESCRICAO, PDO::PARAM_STR);
                $stmt->bindParam(':PRS_STSTATUS', $PRS_STSTATUS, PDO::PARAM_STR);

                $stmt->execute();
            
                // Retorna uma mensagem de sucesso (opcional)
                return ["success" => "Produto inserido com sucesso."];
            } catch (PDOException $e) {
                // Captura e retorna o erro
                return ["error" => $e->getMessage()];
            }
        }

        public function notifyEmail($SUBJECT, $MSG)
        {
            // Configurações do e-mail
            $to = "suporte@codemaze.com.br"; 
            $subject = "ATENÇÃO: $SUBJECT";
            $body = "Nome: $MSG\n";

            // Adiciona cabeçalhos para o e-mail
            $headers = "From: no-reply@codemaze.com.br\r\n";
            $headers .= "Reply-To: no-reply@codemaze.com.br\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n"; // Define a codificação como UTF-8
            $headers .= "MIME-Version: 1.0\r\n";
            
            mail($to, $subject, $body, $headers);        
        }
    }