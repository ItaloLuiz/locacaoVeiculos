# Escribo - Teste Técnico 03

## Lib/ Framework utilizado
  
   [Slim Framework, versão 3](https://github.com/slimphp/Slim "Slim Framework, versão 3")
   [Pixie Query Builder](https://github.com/usmanhalalit/pixie "Pixie Query Builder")

## Descrição

    1. Seu sistema deve permitir o cadastro, edição, remoção e a possibilidade de retornar
        uma lista de carros disponíveis para locação.

    2. Seu sistema deve possibilitar que um veículo seja alugado, armazenando os dados
        de contato da pessoa que o alugou. O sistema também deve permitir que o veículo
        seja devolvido.

## Requisitos

    1. O sistema deve ser desenvolvido em PHP puro ou usando Slim Framework.

    2. Desenvolva sua aplicação no formato de uma API Restful.

    3. A aplicação deve fazer persistência dos dados, se conectando com qualquer banco
    de dados de sua preferência.

    4. Organize seu código da forma mais limpa possível, usando os conceitos de SOLID
    que você conhece.

    5. Use todo o conhecimento técnico que tem em todos os pontos, use todos os
    padrões que achar aplicáveis, seja padrões de projeto ou arquiteturais.

    6. Seu projeto deve estar versionado em um repositório no GitHub.

    7. Descreva no README no projeto todos os passos necessários para rodar o seu
    projeto, bem como as rotas da sua aplicação. Para cada rota, descreva o caminho,
    que dados recebe e quais dados retorna.

## Rodando o Projeto

    - O projeto foi desenvolvido usando o microframework Slim, versão 3 e para as ações
    no banco de dados foi utilizado a lib Pixie, usando banco de dados Mysql.

    - Para rodar o projeto basta clonar o mesmo e rodar os seguintes comandos:

    
    1. git clone https://github.com/ItaloLuiz/locacaoVeiculos.git
    2. composer install 
   

    - Abra o arquivo: configs.php, dentro da pasta: config e edite as informações
      do banco de dados.

## Rotas da apalicação

    - Existem dois grupos de rotas, as rotas relacionadas aos veiculos e as relacionadas
      à locação.
    - Todas as rotas estão no arquivo index.php

## Controllers

    - Existem dois controllers, locacao.php e veiculos.php, que estão dentro da pasta
      src/controllers.

### Rotas dos veiculos

    - Controller responsavel: src/controllers/veiculos.php

    1. /veiculos , lista todos os veiculos cadastados. Método GET
    2. /veiculo/{id} , lista um veiculo baseado no ID passado.  Método GET
    3. /veiculosDisponiveis , lista todos os veiculos diponiveis para locação  Método GET
    4. /veiculo , usando o  Método POST faz o cadastro dos veiculos, para tal
       é necessário informar: as informações da seguinte forma:

         ano
         cor
         marca
         modelo    
      
    5. /veiculosLocados , lista todos os veiculos locados. Método GET
    6. /veiculo/{id} , faz a edição do veiculo pelo id, usando o método PUT. Para 
       a edição é necessário passar as informações:
       
           ano
           cor
           marca
           modelo    
       
    7. /veiculo/{id} , apaga um veiculo baseado no id passado. Método DELETE.

### Rotas das Locações

    - Controller responsavel: src/controllers/locacao.php

    1. /locacoes , lista todas as locações marcadas como ativas. método GET
    2. /historicoLocacoes , lista todas as locações já feitas. método GET
    3. /locarVeiculo , faz a locação de um veiculo, usando o método POST, para
        tal é necessário passar as seguintes informações:

            
          id_veiculo
          nome_cliente
          email_cliente
          telefone_cliente
     

    4. /devolverVeiculo/{id} , faz a devolução do veiculo baseado no id passado.
       método PUT.

## Tabelas do banco de dados

   ``` SQL
    CREATE TABLE `tbl_veiculos` (
        `id_veiculo` INT(11) NOT NULL AUTO_INCREMENT,
        `ano_veiculo` CHAR(8) NULL COLLATE 'utf8mb4_general_ci',
        `marca_veiculo` CHAR(20) NULL COLLATE 'utf8mb4_general_ci',
        `modelo_veiculo` CHAR(20) NULL COLLATE 'utf8mb4_general_ci',
        `cor_veiculo` CHAR(20) NULL COLLATE 'utf8mb4_general_ci',
        `status_veiculo` CHAR(20) NULL COLLATE 'utf8mb4_general_ci',
        `data_cadastro` DATETIME NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id_veiculo`) USING BTREE
    )
    COLLATE='utf8mb4_general_ci'
    ENGINE=InnoDB
    AUTO_INCREMENT=0;
 
    CREATE TABLE `tbl_veiculo_locados` (
        `id_locacao` INT(11) NOT NULL AUTO_INCREMENT,
        `id_veiculo` INT(11) NULL,
        `nome_cliente` CHAR(120) NULL COLLATE 'utf8mb4_general_ci',
        `email_cliente` CHAR(120) NULL COLLATE 'utf8mb4_general_ci',
        `telefone_cliente` CHAR(20) NULL COLLATE 'utf8mb4_general_ci',
        `data_entrega` DATE NULL,
        `status_locacao` CHAR(50) NULL COLLATE 'utf8mb4_general_ci',
        `data_cadastro` DATETIME NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id_locacao`) USING BTREE
    )
    COLLATE='utf8mb4_general_ci'
    ENGINE=InnoDB
    AUTO_INCREMENT=0;
   ```
