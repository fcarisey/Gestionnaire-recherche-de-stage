<?php
    namespace Model;
    Class Student{
        private $idstudent,$firstname,$lastname,$username,$password,$profilpicture,$courriel,$cv,$lm,$idclasse,$idcurrentinternship;

        public function __construct($idstudent = null,$firstname = null,$lastname = null,$username = null,$password = null,$profilpicture = null,$courriel = null,$cv = null,$lm = null,$idclasse = null,$idcurrentinternship = null){
           $this->setIdstudent($idstudent)->setFirstname($firstname)->setLastname($lastname)->setUsername($username)->setPassword($password)->setProfilpicture($profilpicture)->setCourriel($courriel)->setCv($cv)->setLm($lm)->setIdclasse($idclasse)->setIdcurrentinternship($idcurrentinternship);
        }

        
        public function setIdstudent($idstudent){
            $this->idstudent = $idstudent;
            return $this;
        }
        public function getIdstudent(){
            return $this->idstudent;
        }

        public function setFirstname($firstname){
            $this->firstname = $firstname;
            return $this;
        }
        public function getFirstname(){
            return $this->firstname;
        }

        public function setLastname($lastname){
            $this->lastname = $lastname;
            return $this;
        }
        public function getLastname(){
            return $this->lastname;
        }

        public function setUsername($username){
            $this->username = $username;
            return $this;
        }
        public function getUsername(){
            return $this->username;
        }

        public function setPassword($password){
            $this->password = $password;
            return $this;
        }
        public function getPassword(){
            return $this->password;
        }

        public function setProfilpicture($profilpicture){
            $this->profilpicture = $profilpicture;
            return $this;
        }
        public function getProfilpicture(){
            return $this->profilpicture;
        }

        public function setCourriel($courriel){
            $this->courriel = $courriel;
            return $this;
        }
        public function getCourriel(){
            return $this->courriel;
        }

        public function setCv($cv){
            $this->cv = $cv;
            return $this;
        }
        public function getCv(){
            return $this->cv;
        }

        public function setLm($lm){
            $this->lm = $lm;
            return $this;
        }
        public function getLm(){
            return $this->lm;
        }

        public function setIdclasse($idclasse){
            $this->idclasse = $idclasse;
            return $this;
        }
        public function getIdclasse(){
            return $this->idclasse;
        }

        public function setIdcurrentinternship($idcurrentinternship){
            $this->idcurrentinternship = $idcurrentinternship;
            return $this;
        }
        public function getIdcurrentinternship(){
            return $this->idcurrentinternship;
        }
        
        public static function format($data){

            $objs = [];

            if ($data != NULL){

                foreach($data as $d){

                    $idstudent = \Controller\ControllerController::keyExist('idstudent', $d);
                    $firstname = \Controller\ControllerController::keyExist('firstname', $d);
                    $lastname = \Controller\ControllerController::keyExist('lastname', $d);
                    $username = \Controller\ControllerController::keyExist('username', $d);
                    $password = \Controller\ControllerController::keyExist('password', $d);
                    $profilpicture = \Controller\ControllerController::keyExist('profilpicture', $d);
                    $courriel = \Controller\ControllerController::keyExist('courriel', $d);
                    $cv = \Controller\ControllerController::keyExist('cv', $d);
                    $lm = \Controller\ControllerController::keyExist('lm', $d);
                    $idclasse = \Controller\ControllerController::keyExist('idclasse', $d);
                    $idcurrentinternship = \Controller\ControllerController::keyExist('idcurrentinternship', $d);
                    $student = new self($idstudent,$firstname,$lastname,$username,$password,$profilpicture,$courriel,$cv,$lm,$idclasse,$idcurrentinternship);

                    array_push($objs, $student);
                }
            }
            return (empty($objs)) ? null : $objs;
        }
    }