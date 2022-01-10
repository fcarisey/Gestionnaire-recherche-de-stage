<?php
    namespace Model;
    Class Classe{
        private $IdClasse,$Designation,$InternshipDate;

        public function __construct($IdClasse = null,$Designation = null,$InternshipDate = null){
           $this->setIdClasse($IdClasse)->setDesignation($Designation)->setInternshipDate($InternshipDate);
        }

        
        public function setIdClasse($IdClasse){
            $this->IdClasse = $IdClasse;
            return $this;
        }
        public function getIdClasse(){
            return $this->IdClasse;
        }

        public function setDesignation($Designation){
            $this->Designation = $Designation;
            return $this;
        }
        public function getDesignation(){
            return $this->Designation;
        }

        public function setInternshipDate($InternshipDate){
            $this->InternshipDate = $InternshipDate;
            return $this;
        }
        public function getInternshipDate(){
            return $this->InternshipDate;
        }

        
        public static function format($data){

            $objs = [];

            if ($data != NULL){

                foreach($data as $d){

                    $IdClasse = \Controller\ControllerController::keyExist('IdClasse', $d);
                    $Designation = \Controller\ControllerController::keyExist('Designation', $d);
                    $InternshipDate = \Controller\ControllerController::keyExist('InternshipDate', $d);
                    $classe = new self($IdClasse,$Designation,$InternshipDate);

                    array_push($objs, $classe);
                }
            }
            return (empty($objs)) ? null : $objs;
        }
    }