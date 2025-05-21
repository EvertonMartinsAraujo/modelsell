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
cd modelsell

2. Instalar dependências do Laravel e Vue
composer install
npm install
npm run build

3. Configurar variáveis de ambiente
Edite as seguintes variáveis para configurar a conexão com seu banco MySQL:-DB_USERNAME
DB_DATABASE=nomedobanco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua senha

4. Rodar as migrations para criação do schema e tabela no banco de dados
php artisan migrate

4.5.OPCIONAL: Alimentar as tabelas com dados fictícios para testes
php artisan db:seed
Isso criará alguns usuários e produtos, consulte as tabelas em caso de duvidas


############ Executar aplicação ############
php artisan serve





############ Sobre o projeto ############

Projeto desenvolvido por Everton M. Araujo, para finalidade de pratica e estudo.



