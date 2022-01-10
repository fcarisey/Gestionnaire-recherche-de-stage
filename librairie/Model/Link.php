<?php
    namespace Model;
    Class Link{
        private $IdClasse,$IdInternship;

        public function __construct($IdClasse = null,$IdInternship = null){
           $this->setIdClasse($IdClasse)->setIdInternship($IdInternship);
        }

        
        public function setIdClasse($IdClasse){
            $this->IdClasse = $IdClasse;
            return $this;
        }
        public function getIdClasse(){
            return $this->IdClasse;
        }

        public function setIdInternship($IdInternship){
            $this->IdInternship = $IdInternship;
            return $this;
        }
        public function getIdInternship(){
            return $this->IdInternship;
        }

        
        public static function format($data){

            $objs = [];

            if ($data != NULL){

                foreach($data as $d){

                    $IdClasse = \Controller\ControllerController::keyExist('IdClasse', $d);
                    $IdInternship = \Controller\ControllerController::keyExist('IdInternship', $d);
                    $link = new self($IdClasse,$IdInternship);

                    array_push($objs, $link);
                }
            }
            return (empty($objs)) ? null : $objs;
        }
    }