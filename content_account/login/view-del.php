<?php
namespace content\login;

class view extends \content\home\view{

        public function view_login(){
                // var_dump("salam");
        }


        public function view_form($object){
                var_dump($object);
                $form = $this->form("@jibres.accounts");
                $form->before('account_slug', 'account_title');
                var_dump($form);
        }

        public function view_query($object){
                var_dump($object->api_callback); 
                // or var_dump($this->controller()->api_callback); 
        }
}
?>