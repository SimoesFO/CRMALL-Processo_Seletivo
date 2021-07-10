## CRMALL - Processo Seletivo
Este projeto consiste na prova prática do processo seletivo para desenvolvedor PHP da empresa CRMALL. E trata-se da criação de um CRUD de usuário, seguindo as específicações recomendadas. Nele há apenas duas telas, uma consiste na listagem de usuário com as opções de adicionar novo usuário, editar ou remover um usuário já existente, e a segunda tela consiste na tela de cadastro ou edição de usuário. Além disso, conforme solicitado, esta aplicação realiza uma busca de endereço através do cep, consumindo o serviço de api do site [ViaCep](https://viacep.com.br/).


## Tecnologias Utilizadas

Na construção do projeto optou-se por utilizar o framework Laravel, para a construção das API's Rest, que foram consumidas pelo front-end da aplicação.
Também foi utilizado o Docker para a criação do banco de dados Mysql.
Além disso, foi utilizado o Bootstrap na criação do layout, o Jquery na manipulação de elementos do DOM, um plugin chamado Datatable na construção da listagem de usuários e outro chamado SweetAlert 2, na criação das mensagens que são mostradas ao usuário.

## Pré-Requisitos
 - PHP 7.0 ou superior
 - Composer
 - Docker
 - Docker Compose

## Instruções de Uso

Para executar este projeto, basta clona-lo, entrar na raiz do projeto e seguir as instruções a baixo:

1) Instale as dependências do projeto
> composer update 

2) Como administrador crie o container do Docker responsável por inicializar o Mysql
> docker-composer up -d

3) Crie a tabela de usuário executando as migrations
> php artisan migrate

4) Inicie a aplicação Laravel
> php artisan serve

5) Acesse a aplicação através do endereço abaixo
> http://localhost:8000



## API Rest - Endpoints (Rotas)

Esta aplicação possui apenas 5 endpoints definidos, são eles:

1) Exibir todos os usuários
> GET [http://localhost:8000/api/users/]

2) Mostra os dados de um usuário específico
> GET [http://localhost:8000/api/users/{id}]

3) Criar um usuário
> POST [http://localhost:8000/api/users/]

4) Atualizar as informações de um usuário
> UPDATE [http://localhost:8000/api/users/{id}]

5) Excluir um usuário
> DELETE [http://localhost:8000/api/users/{id}]


## Licença

[MIT license](https://opensource.org/licenses/MIT).
