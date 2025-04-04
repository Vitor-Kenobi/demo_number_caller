import socket

UDP_IP = "192.168.0.3"  # Interface
UDP_PORT = 2305     # Porta
ALLOWED_IP = "192.168.0.101"  # Balanca

sock = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
sock.bind((UDP_IP, UDP_PORT))

print(f"Escutando na porta UDP {UDP_PORT}...")

while True:
    data, addr = sock.recvfrom(1024)  # Buffer de 1024 bytes
    ip_origem = addr[0]
    if ip_origem == ALLOWED_IP:
        print(f"Mensagem recebida: {data.decode()} de {addr}")
    else:
        print("...")