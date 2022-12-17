# MVC Framework

## Badges  
[![Badge em Desenvolvimento](https://img.shields.io/badge/Version-1.0-green/style=plastic)]()  
[![](https://img.shields.io/badge/PHP%20->=%207.0-brightgreen)]()

## Iniciando

- Após efetuar o Download/Clone do projeto.
- Baixe um serviço de Banco de Dados, recomendado MYSQL.

### __*Clone*__
~~~bash  
  git clone https://github.com/LuriqueGon/ControleDeEstoque.git
~~~

## Organização do Framework

O frame work é dividido em 3 pastas principais.

- App
- Public
- Vendor

O framework trabalha ativamente com o uso de __*Namespaces*__;

## App

Dentro da pasta App ficará separada toda a logico MVC do framework (Model, Controllers, View).

Dentro da pasta tambem ficará todo o controle do Banco de Dados e das Rotas.

## Configurações __*Connection*__

A primeira configuração dentro da pasta APP é a de alterar os dados da Conexão;

- Abra o diretorio app, e procure o arquivo __*Connection.php*__;
- Após abrir o arquivo, Dentro da classe Connection, procure o Método __getDb__;
- Altere tudo que for preciso dentro desse método, através do objeto __$conn__ (PDO);

### __*Arquivo Connection.php*__
~~~ Class Connection
    <?php 

        namespace App;
        use PDO;
        use PDOException;

        class Connection{

            public static function getDB(){
                try{
                    $conn = new PDO(
                        "mysql:host=Host do Banco;". 
                        "dbname=Nome do Banco;". 
                        "charset=utf8", 
                        "Usuario", 
                        "Senha"
                    );
                    return $conn;
                    
                }catch(PDOException $e){
                    // Tratativa de Erros

                }
            }
        }
    ?>
~~~~

### Configurações __*Routes*__

Dentro do arquivos __*route.php*__ é onde fica todo o controle de Rotas e URL de todo o sistema.

- Abra o arquivo route, dentro do diretorio APP;
- Dentro da class Route. que extende a class Bootstrap, há um método. 
- Dentro do método __*initRoutes*__ ficarão todos os Arrays, com toda configuração sobre as rotas;
- Para configurar uma rota é necessario entender como funciona o Array __*$routes*__;

#### OBS:

A classe Bootstrap fica dentro do diretorio:

__*Mf/Init/Bootstrap.php*__ 
 
dentro desse arquivo fica toda a lógica para controllar as rotas.


#### __*Arquivo route.php*__
~~~ Class Route
    $routes['NomeDaRota'] = array(
        'route' => '/EndereçoDaRota',
        'controller' => 'NomeDoController',
        'action' => 'MétodoDentroDoController'
    ); 
~~~~

- O __*NomeDaRota*__ nunca deve se repetir, caso repita poderá haver erros na hora de chamar a rota. Exemplo __*homeTeste*__
- O Atributo __*route*__, sempre deverá iniciar com uma __*/*__, exemplo __*/home*__, Nessa area é onde ficará a url.
- O Atributo __*Controller*__ deverá haver o nome da class de um controlador, esse controlador é onde ficará toda a lógica da rota, exemplo __*IndexController*__;
- E por fim o Atributo  __*action*__ será o nome do método chamado no Controlador, exemplo __*indexTeste*__;

Essa é a configuração padrão para uma rota;

Após configurar a rota de exemplo, toda vez que você digitar no site __*URL/home*__ o controller IndexController, pelo método __*indexTeste*__ (Dentro do diretorio App, no diretorio Controllers, há um arquivo chamado __*IndexController.php*__);

Se abrir o arquivo __*IndexController.php*__ verá que não há um método chamado __*indexTeste*__, somente o __*Index*__; 

Então vamos criar esse método.

Copie o código abaixo, e cole após o método index;

### __*Arquivo IndexController.php*__
~~~ Class IndexController
    public function indexTeste(){
        echo "Testando Rota";
    }
~~~~

Após isso, acesse a url __*URL/home*__ então aparecerá uma mensagem na tela, (__Testando Rota__);

Então é assim que se cria uma rota;

## Controllers

### Criação dos Controllers

Os controladores, serão aqueles que guardarão a maior parte dos códigos que envolvam lógica dentro de todo o software;

Dentro do diretorio App, no diretorio Controllers, Ficarão todos os controllers;

Dentro do diretorio, há um arquivo chamado __*BaseController.php*__, dentro dele está o código que precisará haver dentro de todos os Controllers;

### __*Arquivo BaseController.php*__
~~~ Class BaseController
    <?php 

        namespace App\Controllers;
        use MF\Controller\Action;
        use MF\Model\Model;

        class NomeDoController extends Action{
            
        }

    ?>
~~~~


Todos os controllers vão extender A class Action, ela fica dentro do diretorio __*MF/Controller/Action.php*__;

Essa classe tem alguns métodos essenciais para todos os controllers, um deles é o ____Construct(){}__ , dentro desse método é criado uma variavel global;

__*$this->view*__

Um exemplo ótimo de como ela pode ser usada é nas views e nos controllers;

Ela é uma classe que pode se exterder tanto em objeto, como em array;

Exemplo: __*$this->view->page*__ (Aonde fica o nome da pagina);

__*$this->view->atualClass['Controller']*__ (Nome do controller);

Essa variavel pode ser recuperada dentro de todos os Controllers, e de todas as Views;

Um bom teste disso é dentro do nosso IndexController, no método indexTeste;

### __*Arquivo IndexController.php*__
~~~ Class IndexController
    public function indexTeste(){
        echo "Testando Rota";

        echo "<pre>";
        var_dump($this->view);
        echo "</pre>";
    }
~~~~

Recarregue a página.

Por enquanto estará vazio o array, porém quando usarmos uma view, ele mostrará alguns dados;

Vamos aprender a ultilizar as Views;


São divididos em  4 partes __*Components, Layouts, Configs e Controllers*__

### OBS{

Todos os arquivos dentro do __DIR__ View, precisa terminar com a extensão .phtml;

### }

Vamos começar com Layouts;

São a base de todo arquivo html + php;

Ficam dentro do __DIR__ Views, __DIR__ layouts;

O layout default, sempre será o __*layout.phtml*__;

Dentro do layout ficará toda a configuração do html, desde __*Head*__ até __*Links e Scripts*__

Quando criar um novo layout, semper colocar a frase __"<?php $this->content() ?>"__ dentro do body

### Layout
~~~ Layout
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <!-- METATAGS -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="/css/style.css">

        <!-- SCRIPTS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <!-- TITTLE -->
        <title></title>
    </head>
    <body>
        <?php $this->content() ?>
    </body>
    </html>
~~~~

Dentro do __body__, tem-se a chamada do método __$this->content()__, ele é chamado lá na Class __Action__ ,mas só é usado quando uma view for chamada pelo seu Controller;

### Chamando Views

Dentro do IndexController, no método indexTeste, digite:

__*$this->render('indexTeste', 'layout');*__

#### Obs: quando o layout for o padrão, você pode simplesmente oculpar o layout, assim:

__*$this->render('indexTeste');*__

#### Obs: sempre chame a view como ultima linha do método do controller;

~~~ Chamando View
    $this->render('nomeDaView','NomeDoLayout');
~~~

### Criando Views

A view sempre vai ter q ficar dentro de uma pasta com o nome do Controller.

No nosso caso vamos ter que colocar a view __indexTeste__, dentro de uma pasta chamada __index__, já que index é o nome do nosso controller;

Dentro do __DIR__ view, tem uma pasta chamada index, mas lembre sempre que criar um novo controller que use uma view, tambem crie uma pasta com o mesmo nome (Removendo a nome Controller) na pasta View;

Dentro da pasta view, crie o arquivo __*indexTeste.phtml*__

Ao recarregar a página você pode ver q tudo funcionou;

### Avançando em Views

Nesse arquivo, o __indexTeste.phtml__, Você não precisa de nenhuma configuração de head, nem nada. Afinal, tudo já está dentro do layout.

Dentro desse arquivo você pode usar tanto html, php, quanto js.


Vamos testar novamente a variavel __$this->view__, dentro do indexTeste.phtml, insira uma linha chamando o php, e coloque novamente um var_dump com a variavel __$this->view__;

~~~ lendo a variavel $this->view
    <?php 
        echo "<pre>";
        var_dump($this->view);
        echo "</pre>";
    ?>
~~~

Agora podemos ver as informações que são passadas, elas podem ser acessadas em qualquer view, e controller;


### components

Dentro dessa pasta será usada pra guardar templates, ou partes que se repetirão no projeto;
Exemplo uma header;

Dentro da pasta Index, em Components, Crie um arquivo chamado __header.phtml__

Coloque dentro desse arquivo um <h1>Header</h1> para sabermos que funcionou;

Dentro do indexTeste, na view, escreva na primeira linha:

~~~ carregando Components

    <?php
        $this->loadComponents('header');
    ?>

~~~

Isso pode ser usado tanto para headers, footers, como menus...


### Configs

Dentro dessa pasta fica um arquivo chamado __404Error.phtml__, ele sempre será usado caso algum item dentro da view, não seja encontrado;


## Models