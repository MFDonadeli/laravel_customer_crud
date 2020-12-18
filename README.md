# Customer API REST

Esta API REST contém o backend de um CRUD de clientes. Na solução contém o Back-end que recebe requisições em JSON e dá respostas também em JSON. Contém também um Front-end simples para teste da API REST, porém pode ser facilmente testado sem o uso do front-end seguindo os exemplos contidos na documentação da API.

## Tecnologia 

Laravel 8 com Front-end em Vue.js e banco de dados MySQL

## Documentação da API

https://documenter.getpostman.com/view/13904826/TVsshTXX


## Executando tudo

É necessário ter instalado no seu ambiente os gerenciadores de pacote Composer e NPM.

1. Faça o clone da solução do git: 

```
git clone https://github.com/MFDonadeli/laravel_customer_crud.git
```

2. Duplique o arquivo .env.example e renomeie para .env
3. Crie um banco de dados no seu MySQL e configure o arquivo .env, aqui está um exemplo
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_crud
DB_USERNAME=root
DB_PASSWORD=
```

4. No terminal e dentro da pasta do projeto importado do git clone execute o seguinte comando:
```
composer install
```

5. Gere uma nova chave para o projeto com o comando:
```
php artisan key:generate
```

6. Instale os pacotes npm necessários:
```
npm install
```

7. Crie as tabelas populando alguns dados automaticamente com o comando:
```
php artisan migrate --seed
```

8. Compile os arquivos necessários para rodar o front-end
```
npm run dev
```

9. Rode o servidor Laravel
```
php artisan serve
```

10. Acesse a solução através do endereço indicado pelo servidor Laravel


