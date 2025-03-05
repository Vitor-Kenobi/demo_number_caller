# Completamente inutilizado. Tentativa inicial de socket.

from flask import Flask, jsonify
import threading
import socket

app = Flask(__name__)

# Variáveis globais
contador = 0
piscar = False

# Função para processar a mensagem UDP
def processar_mensagem(mensagem):
    global contador, piscar
    try:
        # Extrai o décimo quarto dígito (índice 13)
        acao = int(mensagem[13])
        
        if acao == 1:  # Incrementar
            contador += 1
            piscar = True
        elif acao == 2:  # Decrementar
            contador -= 1
            piscar = True
        elif acao == 3:  # Piscar
            piscar = True
        else:
            piscar = False
    except (IndexError, ValueError):
        piscar = False

# Função para escutar mensagens UDP
def escutar_udp():
    sock = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    sock.bind(("192.168.0.3", 2305))  # Escuta no IP e porta especificados
    print(f"Escutando mensagens UDP na porta 2305...")

    while True:
        data, addr = sock.recvfrom(1024)
        mensagem = data.decode().strip()
        if addr[0] == "192.168.0.101" and len(mensagem) < 30:
            print(f"Mensagem recebida: {mensagem}")
        processar_mensagem(mensagem)

# Rota para o frontend buscar o estado atual
@app.route("/estado", methods=["GET"])
def get_estado():
    global contador, piscar
    return jsonify({"contador": contador, "piscar": piscar})

# Inicia o servidor Flask e o listener UDP
if __name__ == "__main__":
    # Inicia a thread para escutar UDP
    udp_thread = threading.Thread(target=escutar_udp)
    udp_thread.daemon = True
    udp_thread.start()

    # Inicia o servidor Flask
    app.run(host="192.168.0.3", port=5000)