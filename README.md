
### Explicações:

- **Passos para a instalação do projeto**:
  - mude o arquivo .env para as especificidades do seu banco de dados, no bloco que foi especificado na documentação
  - é necessário também rodar o "script.sql" no seu banco de dados postgresql
  - se todas as versões das ferramentas do projeto estiverem instaladas, basta rodar os comandos:
  - *composer install*
  - *php artisan serve*
  - Acesse seu localhost na rota "localhost:8000" (substitua pela porta correta se a sua não for essa - será exibida no terminal após rodar o ultimo comando acima)
 
    ### OBS:
- Crie seu usuário com email "admin@admin.com" no menu 'Registro' para poder utilizar o dashboard, ou pela rota '/register'.
- o dashboard só poderá ser acessado se o usuário tiver esse email.
- é possível acessar o dashboard clicando no seu nome de usuário no menu (se voce não for um usuário admin, o usuário não será clicavel) ou pela rota '/dashboard'.

  
- **Descrição do Projeto**: O site foi construído usando o framework Laravel e tem como objetivo facilitar a gestão de produtos e serviços oferecidos pela loja, além de proporcionar uma experiência de compra eficiente e intuitiva para os clientes.
- **Funcionalidades**: 
- Cadastro de Produtos: Permite adicionar, editar, remover e visualizar produtos.
- Carrinho de Compras: Funcionalidades de adicionar ao carrinho, atualizar quantidades e remover itens.
-	Processo de Checkout: Fluxo simplificado de checkout com integração de pagamento segura.
-	Dashboard par aadicionar e remover produtos

- **Pré-requisitos**:
- 	PHP: Versão 8.0.2 ou superior.
-	Composer: Gerenciador de dependências do PHP.
-	PostgreSQL: Sistema de gerenciamento de banco de dados relacional.
-	Node.js e NPM: Necessários para gerenciar pacotes JavaScript e compilar recursos frontend.
-   Git: Controle de versão para clonar o repositório do projeto.

