# demo_number_caller
Um chamador de senhas (number caller) simples utilizando sockets em PHP e UDP messages.

# Funcionalidades

Chamador de Senhas: Permite a chamada sequencial de números de senha, facilitando a organização de filas e atendimentos.

# Tecnologias Utilizadas

PHP: Utilizado para o backend e manipulação de sockets.

Python: Empregado para testes e envio de mensagens UDP.

HTML: Estruturação da interface web.

# Estrutura do Projeto

index.html: Página principal que exibe o número da senha atual.

estado.php: Script PHP que retorna o estado atual da senha.

udp_receiver.php: Script PHP que recebe mensagens UDP e atualiza o número da senha.

backend.py: Script Python que envia mensagens UDP para o servidor.

udp_tester.py: Script Python para testar o envio de mensagens UDP.

# Instalação

Configuração do Servidor

Certifique-se de que o servidor web suporta PHP e está configurado para permitir sockets UDP.
