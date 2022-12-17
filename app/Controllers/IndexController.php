<?php 

    namespace App\Controllers;
    use MF\Controller\Action;

    class IndexController extends Action{

        public function index(){
            $this->render('index');
        }

        public function indexTeste(){
            // echo "Testando Rota";

            

            $this->render('indexTeste', 'layout');
        }

        
    }

?>