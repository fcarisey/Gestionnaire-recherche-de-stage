<?php
    namespace Model;
    Class Teacher{
        private $idteacher,$firstname,$lastname,$username,$password,$profilpicture,$courriel;

        public function __construct($idteacher = null,$firstname = null,$lastname = null,$username = null,$password = null,$profilpicture = null,$courriel = null){
           $this->setIdteacher($idteacher)->setFirstname($firstname)->setLastname($lastname)->setUsername($username)->setPassword($password)->setProfilpicture($profilpicture)->setCourriel($courriel);
        }

        
        public function setIdteacher($idteacher){
            $this->idteacher = $idteacher;
            return $this;
        }
        public function getIdteacher(){
            return $this->idteacher;
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

        
        public static function format($data){

            $objs = [];

            if ($data != NULL){

                foreach($data as $d){

                    $idteacher = \Controller\ControllerController::keyExist('idteacher', $d);
                    $firstname = \Controller\ControllerController::keyExist('firstname', $d);
                    $lastname = \Controller\ControllerController::keyExist('lastname', $d);
                    $username = \Controller\ControllerController::keyExist('username', $d);
                    $password = \Controller\ControllerController::keyExist('password', $d);
                    $profilpicture = \Controller\ControllerController::keyExist('profilpicture', $d);
                    $courriel = \Controller\ControllerController::keyExist('courriel', $d);
                    $teacher = new self($idteacher,$firstname,$lastname,$username,$password,$profilpicture,$courriel);

                    array_push($objs, $teacher);
                }
            }
            return (empty($objs)) ? null : $objs;
        }
    }