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

### Configurações __*Connection*__

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

### OBS:

A classe Bootstrap fica dentro do diretorio:

__*Mf/Init/Bootstrap.php*__ 
 
dentro desse arquivo fica toda a lógica para controllar as rotas.


### __*Arquivo route.php*__
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
