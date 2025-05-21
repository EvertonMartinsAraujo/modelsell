ModelSell Catálogo de Produtos (Laravel + Vue3)

Projeto API RESTful com Laravel 10 no backend e Vue 3 (Vite) no frontend.

Este é um projeto open-source com o objetivo de estruturar uma aplicação de catálogo de produtos. É necessário realizar login para acessar os produtos. Apenas usuários com privilégio admin podem adicionar, editar e excluir produtos.



############ Requisitos ############

- PHP 8.1+
- Composer
- MySQL
- Node.js 18 ou superior

############ Instalação ############

1. Clonar o repositório:
git clone https://github.com/EvertonMartinsAraujo/modelsell.git
cd api-modelsell

2. Instalar dependências do Laravel e Vue
composer install
npm install
npm run build

3. Configurar variáveis de ambiente
3.1. Copie o arquivo ou renomeie .env.exemplo para .env
cp .env.exemplo .env

3.2. Edite as seguintes variáveis para configurar a conexão com seu banco MySQL:
DB_DATABASE=nomedobanco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua senha

4. Gerar as Keys e rodar as migrations para criação do schema e tabela no banco de dados
php artisan key:generate
php artisan jwt:secret
php artisan migrate

5.Alimentar as tabelas com dados fictícios para testes
php artisan db:seed
Isso criará alguns usuários e produtos, consulte as tabelas em caso de duvidas

****ATENÇÃO*****
Se não executar o item 5 será necessário criar o usuário diretamente no banco para conseguir logar na aplicação

6.Crie um link de conexão ao storage a pasta public, para que as imagens upadas fiquem acessíveis e visíveis
php artisan storage:link


############ Executar aplicação ############
7. Execute
php artisan serve


Você poderá acessar a aplicação no navegador pelo link
http://localhost:8000/


############ Sobre o projeto ############

Projeto desenvolvido por Everton M. Araujo, para finalidade de pratica e estudo.



