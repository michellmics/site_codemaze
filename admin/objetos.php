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
        public $ARRAY_CONTRATOINFO;    
        public $ARRAY_LIQUIDACAOFINANCEIRA; 


        function conexao()
        {
            /*
                load fiule config.cfg

                [DATA DB]
                host = localhost
                dbname = dbname
                user = dbuser
                pass = dbpass
            */

            $configPath = '/home/codemaze/config.cfg';

            if (!file_exists($configPath)) {
                die("Erro: Arquivo de configuração não encontrado.");
            }

            $configContent = parse_ini_file($configPath, true);  // true para usar seções

            if (!$configContent) {
                die("Erro: Não foi possível ler o arquivo de configuração.");
            }

            $host = $configContent['DATA DB']['host'];
            $dbname = $configContent['DATA DB']['dbname'];
            $user = $configContent['DATA DB']['user'];
            $pass = $configContent['DATA DB']['pass'];

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

        public function getContratoInfo()
        {          
                // Verifica se a conexão já foi estabelecida
                if(!$this->pdo){$this->conexao();}
            
            try{           
                $sql = "SELECT *
                                FROM VW_TABLE_GESTAO_CONTRATO
                                WHERE GEC_STCONTRATO <> 'INATIVO'
                                ORDER BY GEC_IDGESTAO_CONTRATO ASC";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $this->ARRAY_CONTRATOINFO = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return ["error" => $e->getMessage()];
            }          
        }

        public function getLiquidacaoFinanceiraInfo()
        {          
                // Verifica se a conexão já foi estabelecida
                if(!$this->pdo){$this->conexao();}
            
            try{           
                $sql = "SELECT *
                                FROM VW_TABLE_LIQUIDACAOFINANCEIRA
                                ORDER BY LFI_DTVENCIMENTO DESC";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $this->ARRAY_LIQUIDACAOFINANCEIRA = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return ["error" => $e->getMessage()];
            }          
        }

        public function getPendenciaInfo($GEC_IDGESTAO_CONTRATO)
        {          
                // Verifica se a conexão já foi estabelecida
                if(!$this->pdo){$this->conexao();}
            
            try{           
                $sql = "SELECT *
                                FROM VW_TABLE_LIQUIDACAOFINANCEIRA
                                WHERE GEC_IDGESTAO_CONTRATO = :GEC_IDGESTAO_CONTRATO
                                ORDER BY LFI_STPAGAMENTO DESC";

                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':GEC_IDGESTAO_CONTRATO', $GEC_IDGESTAO_CONTRATO, PDO::PARAM_STR);
                $stmt->execute();
                $arrayResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if(count($arrayResult) == 0){return "Sem Dados";}
                
                foreach ($arrayResult as $contrato)
                {
                    $now = new DateTime(); 
                    $vencimento = new DateTime($contrato['LFI_DTVENCIMENTO']); 
                    
                    // Calcula a diferença em dias
                    $diferenca = (int)$now->diff($vencimento)->format('%r%a');

                    if ($diferenca < -5 && $contrato['LFI_STPAGAMENTO'] != "LIQUIDADO"){return "PENDENTE";}  
                }
                return "EM DIA";
            } catch (PDOException $e) {
                return ["error" => $e->getMessage()];
            }          
        }

        public function getLiquidacaoFinanceiraInfoBySearch($search)
        {          
                // Verifica se a conexão já foi estabelecida
                if(!$this->pdo){$this->conexao();}
            
            try{           
                $sql = "SELECT *
                                FROM VW_TABLE_LIQUIDACAOFINANCEIRA
                                WHERE
                                GEC_IDGESTAO_CONTRATO LIKE :search                                
                                OR CLI_NMNAME LIKE :search
                                OR PRS_NMNOME LIKE :search
                                OR LFI_DTVENCIMENTO LIKE :search
                                OR LFI_STPAGAMENTO LIKE :search
                                ORDER BY LFI_DTVENCIMENTO DESC";

                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
                $stmt->execute();
                $this->ARRAY_LIQUIDACAOFINANCEIRA = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return ["error" => $e->getMessage()];
            }          
        }

        public function updateLiquidacaoFinanceiraById($LFI_IDLIQUIDACAOFINANCEIRA, $ACAO, $LFI_DTPAGAMENTO)
        {          
            // Verifica se a conexão já foi estabelecida
            if (!$this->pdo) {
                $this->conexao();
            }
            $now = new DateTime(); 
            $DATA = $now->format('Y-m-d');

            if($ACAO == "ABERTO"){$LFI_DTPAGAMENTO = "";}
            
            try {
                $sql = "UPDATE LFI_LIQUIDACAOFINANCEIRA 
                        SET LFI_STPAGAMENTO = :LFI_STPAGAMENTO,
                        LFI_DTPAGAMENTO = :LFI_DTPAGAMENTO
                        WHERE LFI_IDLIQUIDACAOFINANCEIRA = :LFI_IDLIQUIDACAOFINANCEIRA";

                $stmt = $this->pdo->prepare($sql);
            
                // Liga os parâmetros aos valores
                $stmt->bindParam(':LFI_IDLIQUIDACAOFINANCEIRA', $LFI_IDLIQUIDACAOFINANCEIRA, PDO::PARAM_STR);
                $stmt->bindParam(':LFI_STPAGAMENTO', $ACAO, PDO::PARAM_STR);
                $stmt->bindParam(':LFI_DTPAGAMENTO', $LFI_DTPAGAMENTO, PDO::PARAM_STR);

                $stmt->execute();
            
                return ["success" => "Produto atualizado com sucesso."];
            } catch (PDOException $e) {
                // Captura e retorna o erro
                return ["error" => $e->getMessage()];
            }
        }

        public function getContratoInfoBySearch($search)
        {          
                // Verifica se a conexão já foi estabelecida
                if(!$this->pdo){$this->conexao();}
            
            try{           
                $sql = "SELECT *
                                FROM VW_TABLE_GESTAO_CONTRATO
                                WHERE GEC_STCONTRATO <> 'INATIVO' AND 
                                (
                                GEC_IDGESTAO_CONTRATO LIKE :search                                
                                OR PRS_NMNOME LIKE :search
                                OR CLI_NMNAME LIKE :search
                                OR GEC_STCONTRATO LIKE :search
                                OR GEC_DCVALOR LIKE :search
                                OR GEC_DCPERIODOCOBRANCA LIKE :search
                                )
                                ORDER BY GEC_IDGESTAO_CONTRATO ASC";

                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
                $stmt->execute();
                $this->ARRAY_CONTRATOINFO = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

        public function getContratoInfoById($ID)
        {          
                // Verifica se a conexão já foi estabelecida
                if(!$this->pdo){$this->conexao();}
            
            try{           
                $sql = "SELECT *
                                FROM GEC_GESTAO_CONTRATO
                                WHERE GEC_IDGESTAO_CONTRATO = '".$ID."'";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $this->ARRAY_CONTRATOINFO = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

        public function updateProductInfo($PRS_NMNOME, $PRS_DCTIPO, $PRS_DCINVESTIMENTO, $PRS_STSTATUS, $PRS_DCDESCRICAO, $ID)
        {          
            // Verifica se a conexão já foi estabelecida
            if (!$this->pdo) {
                $this->conexao();
            }
            
            try {
                $sql = "UPDATE PRS_PRODUTO_SERVICO 
                        SET PRS_NMNOME = :PRS_NMNOME,
                        PRS_DCTIPO = :PRS_DCTIPO,
                        PRS_DCINVESTIMENTO = :PRS_DCINVESTIMENTO,
                        PRS_STSTATUS = :PRS_STSTATUS,
                        PRS_DCDESCRICAO = :PRS_DCDESCRICAO
                        WHERE PRS_IDPRODUTO_SERVICO = :PRS_IDPRODUTO_SERVICO";

                $stmt = $this->pdo->prepare($sql);
            
                // Liga os parâmetros aos valores
                $stmt->bindParam(':PRS_NMNOME', $PRS_NMNOME, PDO::PARAM_STR);
                $stmt->bindParam(':PRS_DCTIPO', $PRS_DCTIPO, PDO::PARAM_STR);
                $stmt->bindParam(':PRS_DCINVESTIMENTO', $PRS_DCINVESTIMENTO, PDO::PARAM_STR);
                $stmt->bindParam(':PRS_DCDESCRICAO', $PRS_DCDESCRICAO, PDO::PARAM_STR);
                $stmt->bindParam(':PRS_STSTATUS', $PRS_STSTATUS, PDO::PARAM_STR);
                $stmt->bindParam(':PRS_IDPRODUTO_SERVICO', $ID, PDO::PARAM_STR);

                $stmt->execute();
            
                return ["success" => "Produto atualizado com sucesso."];
            } catch (PDOException $e) {
                // Captura e retorna o erro
                return ["error" => $e->getMessage()];
            }
        }

        public function updateClientFinStatus($CLI_IDCLIENT, $CLI_STSTATUSPENDING)
        {          
            // Verifica se a conexão já foi estabelecida
            if (!$this->pdo) {
                $this->conexao();
            }
            
            try {
                $sql = "UPDATE CLI_CLIENT 
                        SET CLI_STSTATUSPENDING = :CLI_STSTATUSPENDING
                        WHERE CLI_IDCLIENT = :CLI_IDCLIENT";

                $stmt = $this->pdo->prepare($sql);
            
                // Liga os parâmetros aos valores
                $stmt->bindParam(':CLI_STSTATUSPENDING', $CLI_STSTATUSPENDING, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_IDCLIENT', $CLI_IDCLIENT, PDO::PARAM_STR);

                $stmt->execute();
            
                return ["success" => "Cliente atualizado com sucesso."];
            } catch (PDOException $e) {
                // Captura e retorna o erro
                return ["error" => $e->getMessage()];
            }
        }

        public function updateContratoInfo($GEC_IDGESTAO_CONTRATO,
        $CLI_IDCLIENT, 
        $PRS_IDPRODUTO_SERVICO, 
        $GEC_DTINICONTRATO, 
        $GEC_DTENDCONTRATO, 
        $GEC_STCONTRATO, 
        $GEC_DCPERIODOCOBRANCA, 
        $GEC_DCFORMAPAGAMENTO, 
        $GEC_DCEMAILCOBRANCA, 
        $GEC_DCTELEFONECOBRANCA, 
        $GEC_DCDESCRICAO,
        $GEC_DTCONTRATACAO, 
        $GEC_DTPRAZOENTREGA, 
        $GEC_DCPERIODO_CARENCIA, 
        $GEC_DCDESCONTO, 
        $GEC_DCPERIODO_DESCONTO, 
        $GEC_DTVENCIMENTO, 
        $GEC_DCPARCELAMENTO, 
        $GEC_DCVALOR)
        {          

            // Conversão das datas para o formato YYYY-MM-DD
            function convertDate($date) {
                $dateObj = DateTime::createFromFormat('d/m/Y', $date);
                return $dateObj ? $dateObj->format('Y-m-d') : null;  // Retorna null se a data for inválida
            }

            // Converte as datas recebidas do formulário
            $GEC_DTINICONTRATO = convertDate($GEC_DTINICONTRATO);
            $GEC_DTENDCONTRATO = convertDate($GEC_DTENDCONTRATO);
            $GEC_DTCONTRATACAO = convertDate($GEC_DTCONTRATACAO );
            $GEC_DTPRAZOENTREGA = convertDate($GEC_DTPRAZOENTREGA);
            $GEC_DTVENCIMENTO = convertDate($GEC_DTVENCIMENTO );

            // Verifica se a conexão já foi estabelecida
            if (!$this->pdo) {
                $this->conexao();
            }
            try {
                $sql = "UPDATE GEC_GESTAO_CONTRATO SET GEC_DTINICONTRATO = :GEC_DTINICONTRATO,
                                        GEC_DTENDCONTRATO = :GEC_DTENDCONTRATO,
                                        GEC_STCONTRATO = :GEC_STCONTRATO,
                                        GEC_DCPERIODOCOBRANCA = :GEC_DCPERIODOCOBRANCA,
                                        GEC_DCFORMAPAGAMENTO = :GEC_DCFORMAPAGAMENTO,
                                        GEC_DCEMAILCOBRANCA = :GEC_DCEMAILCOBRANCA,
                                        GEC_DCTELEFONECOBRANCA = :GEC_DCTELEFONECOBRANCA,
                                        GEC_DCDESCRICAO = :GEC_DCDESCRICAO,
                                        GEC_DTCONTRATACAO = :GEC_DTCONTRATACAO,
                                        GEC_DTPRAZOENTREGA = :GEC_DTPRAZOENTREGA,
                                        GEC_DCPERIODO_CARENCIA = :GEC_DCPERIODO_CARENCIA,
                                        GEC_DCDESCONTO = :GEC_DCDESCONTO,
                                        GEC_DCPERIODO_DESCONTO = :GEC_DCPERIODO_DESCONTO,
                                        GEC_DTVENCIMENTO = :GEC_DTVENCIMENTO,
                                        GEC_DCPARCELAMENTO = :GEC_DCPARCELAMENTO,
                                        GEC_DCVALOR = :GEC_DCVALOR
                                    WHERE GEC_IDGESTAO_CONTRATO = :GEC_IDGESTAO_CONTRATO";

                $stmt = $this->pdo->prepare($sql);

            
                // Liga os parâmetros aos valores
                $stmt->bindParam(':GEC_IDGESTAO_CONTRATO', $GEC_IDGESTAO_CONTRATO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DTINICONTRATO', $GEC_DTINICONTRATO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DTENDCONTRATO', $GEC_DTENDCONTRATO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_STCONTRATO', $GEC_STCONTRATO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCPERIODOCOBRANCA', $GEC_DCPERIODOCOBRANCA, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCFORMAPAGAMENTO', $GEC_DCFORMAPAGAMENTO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCEMAILCOBRANCA', $GEC_DCEMAILCOBRANCA, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCTELEFONECOBRANCA', $GEC_DCTELEFONECOBRANCA, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCDESCRICAO', $GEC_DCDESCRICAO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DTCONTRATACAO', $GEC_DTCONTRATACAO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DTPRAZOENTREGA', $GEC_DTPRAZOENTREGA, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCPERIODO_CARENCIA', $GEC_DCPERIODO_CARENCIA, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCDESCONTO', $GEC_DCDESCONTO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCPERIODO_DESCONTO', $GEC_DCPERIODO_DESCONTO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DTVENCIMENTO', $GEC_DTVENCIMENTO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCPARCELAMENTO', $GEC_DCPARCELAMENTO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCVALOR', $GEC_DCVALOR, PDO::PARAM_STR);
                
                $stmt->execute();
            
                // Retorna uma mensagem de sucesso (opcional)
                return ["success" => "Contrato atualizado com sucesso1."];
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

        public function insertContratoInfo($GEC_IDGESTAO_CONTRATO,
        $CLI_IDCLIENT, 
        $PRS_IDPRODUTO_SERVICO, 
        $GEC_DTINICONTRATO, 
        $GEC_DTENDCONTRATO, 
        $GEC_STCONTRATO, 
        $GEC_DCPERIODOCOBRANCA, 
        $GEC_DCFORMAPAGAMENTO, 
        $GEC_DCEMAILCOBRANCA, 
        $GEC_DCTELEFONECOBRANCA, 
        $GEC_DCDESCRICAO,
        $GEC_DTCONTRATACAO, 
        $GEC_DTPRAZOENTREGA, 
        $GEC_DCPERIODO_CARENCIA, 
        $GEC_DCDESCONTO, 
        $GEC_DCPERIODO_DESCONTO, 
        $GEC_DTVENCIMENTO, 
        $GEC_DCPARCELAMENTO, 
        $GEC_DCVALOR)
        {          

            // Conversão das datas para o formato YYYY-MM-DD
            function convertDate($date) {
                $dateObj = DateTime::createFromFormat('d/m/Y', $date);
                return $dateObj ? $dateObj->format('Y-m-d') : null;  // Retorna null se a data for inválida
            }

            // Converte as datas recebidas do formulário
            $GEC_DTINICONTRATO = convertDate($GEC_DTINICONTRATO);
            $GEC_DTENDCONTRATO = convertDate($GEC_DTENDCONTRATO);
            $GEC_DTCONTRATACAO = convertDate($GEC_DTCONTRATACAO );
            $GEC_DTPRAZOENTREGA = convertDate($GEC_DTPRAZOENTREGA);
            $GEC_DTVENCIMENTO = convertDate($GEC_DTVENCIMENTO );

            // Verifica se a conexão já foi estabelecida
            if (!$this->pdo) {
                $this->conexao();
            }
            try {
                $sql = "INSERT INTO GEC_GESTAO_CONTRATO 
                        (GEC_IDGESTAO_CONTRATO,
                                        CLI_IDCLIENT, 
                                        PRS_IDPRODUTO_SERVICO, 
                                        GEC_DTINICONTRATO, 
                                        GEC_DTENDCONTRATO, 
                                        GEC_STCONTRATO, 
                                        GEC_DCPERIODOCOBRANCA, 
                                        GEC_DCFORMAPAGAMENTO, 
                                        GEC_DCEMAILCOBRANCA, 
                                        GEC_DCTELEFONECOBRANCA, 
                                        GEC_DCDESCRICAO,
                                        GEC_DTCONTRATACAO, 
                                        GEC_DTPRAZOENTREGA, 
                                        GEC_DCPERIODO_CARENCIA, 
                                        GEC_DCDESCONTO, 
                                        GEC_DCPERIODO_DESCONTO, 
                                        GEC_DTVENCIMENTO, 
                                        GEC_DCPARCELAMENTO, 
                                        GEC_DCVALOR) 
                        VALUES (:GEC_IDGESTAO_CONTRATO,
                                :CLI_IDCLIENT, 
                                :PRS_IDPRODUTO_SERVICO, 
                                :GEC_DTINICONTRATO, 
                                :GEC_DTENDCONTRATO, 
                                :GEC_STCONTRATO, 
                                :GEC_DCPERIODOCOBRANCA, 
                                :GEC_DCFORMAPAGAMENTO, 
                                :GEC_DCEMAILCOBRANCA, 
                                :GEC_DCTELEFONECOBRANCA, 
                                :GEC_DCDESCRICAO,
                                :GEC_DTCONTRATACAO, 
                                :GEC_DTPRAZOENTREGA, 
                                :GEC_DCPERIODO_CARENCIA, 
                                :GEC_DCDESCONTO, 
                                :GEC_DCPERIODO_DESCONTO, 
                                :GEC_DTVENCIMENTO, 
                                :GEC_DCPARCELAMENTO, 
                                :GEC_DCVALOR)";

                $stmt = $this->pdo->prepare($sql);
            
                // Liga os parâmetros aos valores
                $stmt->bindParam(':GEC_IDGESTAO_CONTRATO', $GEC_IDGESTAO_CONTRATO, PDO::PARAM_STR);
                $stmt->bindParam(':CLI_IDCLIENT', $CLI_IDCLIENT, PDO::PARAM_STR);
                $stmt->bindParam(':PRS_IDPRODUTO_SERVICO', $PRS_IDPRODUTO_SERVICO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DTINICONTRATO', $GEC_DTINICONTRATO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DTENDCONTRATO', $GEC_DTENDCONTRATO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_STCONTRATO', $GEC_STCONTRATO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCPERIODOCOBRANCA', $GEC_DCPERIODOCOBRANCA, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCFORMAPAGAMENTO', $GEC_DCFORMAPAGAMENTO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCEMAILCOBRANCA', $GEC_DCEMAILCOBRANCA, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCTELEFONECOBRANCA', $GEC_DCTELEFONECOBRANCA, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCDESCRICAO', $GEC_DCDESCRICAO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DTCONTRATACAO', $GEC_DTCONTRATACAO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DTPRAZOENTREGA', $GEC_DTPRAZOENTREGA, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCPERIODO_CARENCIA', $GEC_DCPERIODO_CARENCIA, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCDESCONTO', $GEC_DCDESCONTO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCPERIODO_DESCONTO', $GEC_DCPERIODO_DESCONTO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DTVENCIMENTO', $GEC_DTVENCIMENTO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCPARCELAMENTO', $GEC_DCPARCELAMENTO, PDO::PARAM_STR);
                $stmt->bindParam(':GEC_DCVALOR', $GEC_DCVALOR, PDO::PARAM_STR);
                
                $stmt->execute();

                //insere as parcelas na tabela de controle de liquidação financeira
                $dataVencimento = new DateTime($GEC_DTVENCIMENTO);
                $NUMPARCELA = 1;
                for($x=0; $x < $GEC_DCPARCELAMENTO; $x++)
                {
                    $this->insertListaPagamanto($GEC_IDGESTAO_CONTRATO, $dataVencimento->format('Y-m-d'), $GEC_DCVALOR, $NUMPARCELA);
                    
                    if($GEC_DCPERIODOCOBRANCA == "MENSAL"){$dataVencimento->modify('+1 month');}
                    if($GEC_DCPERIODOCOBRANCA == "TRIMESTRAL"){$dataVencimento->modify('+3 month');}
                    if($GEC_DCPERIODOCOBRANCA == "SEMESTRAL"){$dataVencimento->modify('+6 month');}
                    if($GEC_DCPERIODOCOBRANCA == "ANUAL"){$dataVencimento->modify('+12 month');}                   
                    
                    $NUMPARCELA++;
                }
            
                // Retorna uma mensagem de sucesso (opcional)
                return ["success" => "Contrato inserido com sucesso."];
            } catch (PDOException $e) {
                // Captura e retorna o erro
                return ["error" => $e->getMessage()];
            }
        }

        public function insertListaPagamanto($GEC_IDGESTAO_CONTRATO, $GEC_DTVENCIMENTO, $LFI_DCVALOR_PARCELA, $LFI_DCNUMPARCELA)
        {          
            // Verifica se a conexão já foi estabelecida
            if (!$this->pdo) {
                $this->conexao();
            }

            // gerador de IOP ORDEM DE PAGAMENTO
            $timestamp = microtime(true);
            $numeroIOP = (int)($timestamp * 10000);
            $numeroIOP = $numeroIOP % 1000000;
            $numeroIOP = str_pad($numeroIOP, 6, '0', STR_PAD_LEFT); //garante 8 digitos
            $numeroAleatorio = rand(10,20);
            $LFI_IDOP = $numeroIOP.$numeroAleatorio;
        
            try {
                $sql = "INSERT INTO LFI_LIQUIDACAOFINANCEIRA 
                        (GEC_IDGESTAO_CONTRATO, LFI_DTVENCIMENTO, LFI_DCVALOR_PARCELA, LFI_DCNUMPARCELA, LFI_IDOP) 
                        VALUES (:GEC_IDGESTAO_CONTRATO, :LFI_DTVENCIMENTO, :LFI_DCVALOR_PARCELA, :LFI_DCNUMPARCELA, :LFI_IDOP)";

                $stmt = $this->pdo->prepare($sql);
            
                // Liga os parâmetros aos valores
                $stmt->bindParam(':GEC_IDGESTAO_CONTRATO', $GEC_IDGESTAO_CONTRATO, PDO::PARAM_STR);
                $stmt->bindParam(':LFI_DTVENCIMENTO', $GEC_DTVENCIMENTO, PDO::PARAM_STR);
                $stmt->bindParam(':LFI_DCVALOR_PARCELA', $LFI_DCVALOR_PARCELA, PDO::PARAM_STR);
                $stmt->bindParam(':LFI_DCNUMPARCELA', $LFI_DCNUMPARCELA, PDO::PARAM_STR);
                $stmt->bindParam(':LFI_IDOP', $LFI_IDOP, PDO::PARAM_STR);
            
                $stmt->execute();

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
            $body = "$MSG\n";

            // Adiciona cabeçalhos para o e-mail
            $headers = "From: no-reply@codemaze.com.br\r\n";
            $headers .= "Reply-To: no-reply@codemaze.com.br\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n"; // Define a codificação como UTF-8
            $headers .= "MIME-Version: 1.0\r\n";
            
            mail($to, $subject, $body, $headers);        
        }

        public function notifyPendenciasEmail($SUBJECT, $MSG, $CONTATO)
        {
            // Configurações do e-mail
            $to = $CONTATO; 
            $subject = "ATENÇÃO: $SUBJECT";
            $body = "$MSG\n";

            // Adiciona cabeçalhos para o e-mail
            $headers = "From: no-reply@codemaze.com.br\r\n";
            $headers .= "Reply-To: no-reply@codemaze.com.br\r\n";
            $headers .= "Bcc: suporte@codemaze.com.br\r\n"; // Adiciona Cc
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n"; // Define a codificação como UTF-8
            $headers .= "MIME-Version: 1.0\r\n";
            
            mail($to, $subject, $body, $headers);        
        }

        public function countClientes()
        {        
            if(!$this->pdo){$this->conexao();}

            $sql = "SELECT COUNT(*) AS TOTAL FROM CLI_CLIENT ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function countProdutos()
        {        
            if(!$this->pdo){$this->conexao();}

            $sql = "SELECT COUNT(*) AS TOTAL FROM PRS_PRODUTO_SERVICO ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function countContratosAtivos()
        {        
            if(!$this->pdo){$this->conexao();}

            $sql = "SELECT COUNT(*) AS TOTAL FROM GEC_GESTAO_CONTRATO WHERE GEC_STCONTRATO = 'ATIVO' ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function countContratosInativos()
        {        
            if(!$this->pdo){$this->conexao();}

            $sql = "SELECT COUNT(*) AS TOTAL FROM GEC_GESTAO_CONTRATO WHERE GEC_STCONTRATO = 'INATIVO' ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function countReceitaMesCorrente()
        {        
            if(!$this->pdo){$this->conexao();}

            $sql = "SELECT ROUND(SUM(LFI_DCVALOR_PARCELA), 2) AS TOTAL
                    FROM LFI_LIQUIDACAOFINANCEIRA 
                    WHERE LFI_STPAGAMENTO = 'LIQUIDADO' 
                    AND DATE_FORMAT(LFI_DTPAGAMENTO, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m');";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function countContratosVencer()
        {        
            if(!$this->pdo){$this->conexao();}

            $sql = "SELECT COUNT(*) AS TOTAL
                    FROM LFI_LIQUIDACAOFINANCEIRA
                    WHERE (LFI_STPAGAMENTO IS NULL OR LFI_STPAGAMENTO <> 'LIQUIDADO')
                    AND LFI_DTVENCIMENTO BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 10 DAY);";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function countContratosVencidos()
        {        
            if(!$this->pdo){$this->conexao();}

            $sql = "SELECT COUNT(*) AS TOTAL
                    FROM LFI_LIQUIDACAOFINANCEIRA
                    WHERE (LFI_STPAGAMENTO IS NULL OR LFI_STPAGAMENTO <> 'LIQUIDADO')
                    AND LFI_DTVENCIMENTO < DATE_SUB(CURDATE(), INTERVAL 6 DAY);";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function countContratosLiquidados()
        {        
            if(!$this->pdo){$this->conexao();}

            $sql = "SELECT COUNT(*) AS TOTAL
                    FROM LFI_LIQUIDACAOFINANCEIRA
                    WHERE LFI_STPAGAMENTO = 'LIQUIDADO'
                    AND MONTH(LFI_DTVENCIMENTO) = MONTH(CURDATE())
                    AND YEAR(LFI_DTVENCIMENTO) = YEAR(CURDATE());";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function gerBoleto($LFI_IDOP)
        {
            $url = 'https://sandbox.api.pagseguro.com/orders';
            $token = '5f6b7dd5-93b5-4b26-b18f-9139400d969f70cf7dd24a82ac4af6b3b452387faeda1566-92ba-4c8e-a183-237ebc053c94';  

            if(!$this->pdo){$this->conexao();}            
          
                $sql = "SELECT * FROM VW_TABLE_LIQUIDACAOFINANCEIRA WHERE LFI_IDOP = '$LFI_IDOP'";                
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $ARRAY_VWLIQUIDACAOFINANCEIRA = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $name = $ARRAY_VWLIQUIDACAOFINANCEIRA[0]["CLI_NMNAME"];


            $data = '{
                  "customer": {
                    "name": "'.$name.'",
                    "tax_id": "04996791993",
                    "email": "contato@serconeo.com.br"
                  },
                  "reference_id": "145973-2",
                  "charges": [
                    {
                      "amount": {
                        "value": 600,
                        "currency": "BRL"
                      },
                      "payment_method": {
                        "boleto": {
                          "instruction_lines": {
                            "line_1": "Instrucoes para pagamaneto linha 1 vai aqui",
                            "line_2": "Instrucoes para pagamaneto linha 2 vai aqui"
                          },
                          "holder": {
                            "address": {
                              "street": "rua do cliente",
                              "number": "44",
                              "locality": "Cambui",
                              "city": "Curitiba",
                              "region": "Paraná",
                              "region_code": "PR",
                              "country": "Brasil",
                              "postal_code": "13186170"
                            },
                            "name": "Nome do responsavel pelo pagamento",
                            "tax_id": "04996791993",
                            "email": "contato@responsavel.com.br"
                          },
                          "due_date": "2024-11-18"
                        },
                        "type": "BOLETO",
                        "installments": 1
                      },
                      "reference_id": "id cobranca",
                      "notification_urls": [
                        "https://meusite.com/notificacoes"
                      ],
                      "description": "servios de ti descrição"
                    }
                  ],
                  "items": [
                    {
                      "name": "Serviço de Suporte TI",
                      "unit_amount": 35000,
                      "quantity": 1
                    }
                  ]
                }
            ';

            return $data;

            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($ch, CURLOPT_POST, true);  
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $token,
                'Accept: */*',
                'Content-Type: application/json'
            ]);

            $response = curl_exec($ch);

            if (curl_errno($ch)) 
            {                
                return curl_error($ch);
            } 
            curl_close($ch);

            return $response;            
        }

    }