import socket
import requests

# Configurações UDP
UDP_IP = "192.168.0.3"  # IP da interface
UDP_PORT = 2305          # Porta UDP

# Configurações PHP
PHP_URL = "http://192.168.0.3:8221/demo_queue/processar.php"  # URL do script PHP

# Cria um socket UDP
sock = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
sock.bind((UDP_IP, UDP_PORT))

print(f"Escutando mensagens UDP na porta {UDP_PORT}...")

while True:
    # Recebe a mensagem
    data, addr = sock.recvfrom(1024)
    mensagem = data.decode().strip()
    if (addr[0] == "192.168.0.101" and len(mensagem) < 30):
        print(f"Mensagem recebida: {mensagem} de {addr}")

    # Extrai o décimo quarto dígito (índice 13)
    acao = mensagem[13] if len(mensagem) > 13 else "0"

    # Envia o dígito para o PHP via POST
    try:
        response = requests.post(PHP_URL, data={"acao": acao})
        print(f"Resposta do PHP: {response.text}")
    except Exception as e:
        print(f"Erro ao enviar mensagem para o PHP: {e}")