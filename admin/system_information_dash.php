<?php

header("Content-Type: application/json");

include_once 'objetos_status_server.php'; // Carrega a classe de conexão e objetos

$swhmcpanel_info = new WHMCPANEL_STATUS();
$hostNameServer = $swhmcpanel_info->getInfoWebServer("gethostname");
$loadAvgServer = $swhmcpanel_info->getInfoWebServer("loadavg");
$discUsageServer = $swhmcpanel_info->getInfoWebServer("get_disk_usage");
$bandWithServer = $swhmcpanel_info->getInfoWebServer("showbw");
$listacctsServer = $swhmcpanel_info->getInfoWebServer("listaccts");


//echo $hostNameServer;
//echo $loadAvgServer;
//echo $discUsageServer;
//echo $bandWithServer;
//echo $listacctsServer;



/*
A resposta que você recebeu com os valores de "one", "five" e "fifteen" refere-se à média de carga (load average) do seu servidor ao longo de diferentes períodos de tempo. Aqui está o que cada valor significa:

"one": Média de carga nos últimos 1 minuto (4.61).
"five": Média de carga nos últimos 5 minutos (5.48).
"fifteen": Média de carga nos últimos 15 minutos (5.48).
Interpretação dos Valores de Load Average
Carga média baixa (0-1): O servidor está subutilizado. Geralmente, uma carga média de 1 indica que o servidor tem capacidade suficiente para lidar com a carga atual.

Carga média moderada (1-5): O servidor está sendo utilizado de maneira razoável. Uma carga média entre 1 e 5 sugere que o servidor está gerenciando a carga de trabalho, mas pode começar a ficar sobrecarregado se a carga continuar a aumentar.

Carga média alta (5+): O servidor pode estar sobrecarregado. Quando a média de carga está acima de 5, pode indicar que há mais processos ativos do que o servidor pode processar eficientemente, o que pode levar a lentidão e atrasos.

Análise dos Seus Valores
1 minuto (4.61): O servidor teve uma carga de trabalho relativamente alta no último minuto.
5 minutos (5.48): A carga média nos últimos 5 minutos é alta, o que pode indicar um aumento na atividade.
15 minutos (5.48): A média se manteve alta nos últimos 15 minutos, sugerindo uma tendência de uso elevado.
Ações Recomendadas
Se os valores de carga média se mantiverem elevados, você pode considerar monitorar o uso de recursos do servidor (CPU, memória, disco) para identificar possíveis gargalos.
Verifique os processos em execução e veja se há algum que está consumindo muitos recursos.
Se necessário, você pode precisar otimizar suas aplicações ou considerar um upgrade de hardware, se a carga elevada for um padrão contínuo.
Se precisar de mais detalhes ou ajuda com qualquer outra questão, é só avisar!

*/




?>