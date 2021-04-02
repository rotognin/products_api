# API em PHP para testes

Inicialmente eu segui o tutorial da página [Code of a ninja](https://codeofaninja.com).

O link para o tutorial é [esse aqui](https://codeofaninja.com/2017/02/create-simple-rest-api-in-php.html).

Após sua finalização eu fui fazendo alterações e testes, adicionei o ponto de entrada da API, index.php, 
e fui ajustando as rotas da aplicação.

Seguem abaixo os comandos a serem executados para uso da API:

### Listar todos os produtos cadastrados
~~~
GET http://localhost/apis/produtos/api/?action=read&object=product HTTP/1.1
content-type: application/json
~~~

### Consultar um produto específico
~~~
GET http://localhost/apis/produtos/api/?action=read&object=product&id=65 HTTP/1.1
content-type: application/json
~~~

### Inserir um produto no banco
~~~
POST http://localhost/apis/produtos/api/?action=create&object=product HTTP/1.1
content-type: application/json

{
    "name": "Sofa de canto amarelo",
    "price": "1000",
    "description": "Sofa que vai no canto da sala",
    "category_id": 2,
    "created": "2021-03-29 16:36:20"
}
~~~

### Atualizar um produto
~~~
POST http://localhost/apis/produtos/api/?action=update&object=product HTTP/1.1
content-type: application/json

{
    "id": 65,
    "name": "Sofa de canto azul",
    "price": "1000",
    "description": "Sofa que vai no canto da sala",
    "category_id": 2
}
~~~

### Excluir um produto
~~~
POST http://localhost/apis/produtos/api/?action=delete&object=product HTTP/1.1
content-type: application/json

{
    "id": 65
}
~~~