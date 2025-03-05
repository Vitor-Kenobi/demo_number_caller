<?php
// Configurações
$udp_ip = "192.168.0.3";  // IP da interface
$udp_port = 2305;         // Porta UDP
$allowed_ip = "192.168.0.101";  // IP permitido

// Cria um socket UDP
$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
socket_bind($sock, $udp_ip, $udp_port);

echo "Escutando mensagens UDP na porta $udp_port...\n";

// Loop para receber mensagens
while (true) {
    // Recebe a mensagem
    socket_recvfrom($sock, $buffer, 1024, 0, $remote_ip, $remote_port);
    $mensagem = trim($buffer);

    // Verifica se o IP de origem é permitido
    if ($remote_ip === $allowed_ip) {
        echo "Mensagem recebida: $mensagem de $remote_ip:$remote_port\n";

        // Processa a mensagem
        processar_mensagem($mensagem);
    } else {
        echo "Mensagem bloqueada: Pacote recebido de IP não autorizado: $remote_ip\n";
    }
}

// Função para processar a mensagem
function processar_mensagem($mensagem) {
    global $contador, $piscar;

    // Extrai o décimo quarto dígito (índice 13)
    $acao = intval(substr($mensagem, 13, 1));

    if ($acao === 1) {  // Incrementar
        $contador++;
        $piscar = true;
    } elseif ($acao === 2) {  // Decrementar
        $contador--;
        $piscar = true;
    } elseif ($acao === 3) {  // Piscar
        $piscar = true;
    } else {
        $piscar = false;
    }

    // Salva o estado em um arquivo temporário
    file_put_contents("estado.txt", json_encode(["contador" => $contador, "piscar" => $piscar]));
}

// Fecha o socket (nunca será alcançado neste exemplo)
socket_close($sock);
?>