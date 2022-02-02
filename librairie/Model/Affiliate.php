<?php
    namespace Model;
    Class Affiliate{
        private $idteacher,$idclasse;

        public function __construct($idteacher = null,$idclasse = null){
           $this->setIdteacher($idteacher)->setIdclasse($idclasse);
        }

        
        public function setIdteacher($idteacher){
            $this->idteacher = $idteacher;
            return $this;
        }
        public function getIdteacher(){
            return $this->idteacher;
        }

        public function setIdclasse($idclasse){
            $this->idclasse = $idclasse;
            return $this;
        }
        public function getIdclasse(){
            return $this->idclasse;
        }

        
        public static function format($data){

            $objs = [];

            if ($data != NULL){

                foreach($data as $d){

                    $idteacher = \Controller\ControllerController::keyExist('idteacher', $d);
                    $idclasse = \Controller\ControllerController::keyExist('idclasse', $d);
                    $affiliate = new self($idteacher,$idclasse);

                    array_push($objs, $affiliate);
                }
            }
            return (empty($objs)) ? null : $objs;
        }
    }