<?php

#  Copyright (C) 2017 Registro.br. All rights reserved.
# 
# Redistribution and use in source and binary forms, with or without
# modification, are permitted provided that the following conditions are
# met:
# 1. Redistribution of source code must retain the above copyright
#    notice, this list of conditions and the following disclaimer.
# 2. Redistributions in binary form must reproduce the above copyright
#    notice, this list of conditions and the following disclaimer in the
#    documentation and/or other materials provided with the distribution.
# 
# THIS SOFTWARE IS PROVIDED BY REGISTRO.BR ``AS IS AND ANY EXPRESS OR
# IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
# WARRANTIE OF FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO
# EVENT SHALL REGISTRO.BR BE LIABLE FOR ANY DIRECT, INDIRECT,
# INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
# BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS
# OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
# ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR
# TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE
# USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH
# DAMAGE.

# $Id$

  require "Avail.php";

  function check_domain_availability($fqdn, $parameters) {
    $client = new AvailClient();
    $client->setParam($parameters);
    $response = $client->send_query($fqdn);
    return $response;
  }

  $DOMINIO = $_GET['dominio'];

  $atrib = array(
    "lang"        => 0,            # EN (PT = 1)
    "server"      => SERVER_ADDR,
    "port"        => SERVER_PORT,
    "cookie_file" => COOKIE_FILE,
    "ip"          => "",
    "suggest"     => 0,            # No domain suggestions
  );

  $fqdn = "www.$DOMINIO";
  $domain_info = check_domain_availability($fqdn, $atrib);
  
  // Expressão regular para capturar o valor após "Response Status:"
  if (preg_match('/Response Status:\s*(\d+)/', $domain_info, $matches)) {
    $responseStatus = $matches[1]; // O número capturado estará no índice 1
    if($responseStatus == "2")
    {
      echo "O domínio $fqdn está indisponível para registro.";
    }
    else
      {
        echo "O domínio $fqdn está disponível para registro.";
      }

  } else {
    echo "Não foi possível checar o domínio.";
  }




?>
