<?php

namespace Controller;

class UserController extends ControllerController{
    public static function login($username, $password){
        $err = [];

        // username parse
        $usernameParse = false;
        if (!empty($username)){
            $usernameParse = true;
        }else
            $err['username'] = "Le nom d'utilisateur est oligatoire !";

        //password parse
        $passwordParse = false;
        if (!empty($password)){
            if (strlen($password) >= 8){
                $passwordParse = true;
            }else
                $err['password'] = "Le mot de passe contient au moins 8 caractères !";
        }else
            $err['password'] = "Le mot de passe est obligatoire !";

        if ($usernameParse && $passwordParse){
            if (static::$table_name == "student"){
                $user = StudentController::SELECT(\Database::SELECT_ALL, ['username' => $username], 1);
    
                if ($user){
                    $user = $user[0];
    
                    if (password_verify($password, $user->getPassword())){
                        $id = $user->getIdstudent();
                        $firstname = $user->getFirstname();
                        $lastname = $user->getLastname();
                        $username = $user->getUsername();
                        $password = $user->getPassword();
                        $profilpicture = $user->getProfilpicture();
                        $courriel = $user->getCourriel();
                        $cv = $user->getCv();
                        $lm = $user->getLm();
                        $classe = serialize(ClasseController::SELECT(\Database::SELECT_ALL, ['idclasse' => (int)$user->getIdclasse()], 1)[0]);
                        $currentinternship = serialize(CurrentinternshipController::SELECT(\Database::SELECT_ALL, ['idcurrentinternship' => (int)$user->getIdcurrentinternship()], 1));
                        
                        $_SESSION['id'] = $id;
                        $_SESSION['firstname'] = $firstname;
                        $_SESSION['lastname'] = $lastname;
                        $_SESSION['username'] = $username;
                        $_SESSION['password'] = $password;
                        $_SESSION['profilpicture'] = $profilpicture;
                        $_SESSION['courriel'] = $courriel;
                        $_SESSION['cv'] = $cv;
                        $_SESSION['lm'] = $lm;
                        $_SESSION['classe'] = $classe;
                        $_SESSION['currentinternship'] = $currentinternship;
                        $_SESSION['role'] = "Student";
    
                        $err['valide'] = true;
                    }else
                        $err['account'] = "L'utilisateur n'existe pas !";
                }else
                    $err['account'] = "L'utilisateur n'existe pas !";
            }else if (static::$table_name == "teacher"){
                $user = TeacherController::SELECT(\Database::SELECT_ALL, ['username' => $username], 1);
    
                if ($user){
                    $user = $user[0];
    
                    if (password_verify($password, $user->getPassword())){
                        $id = $user->getIdteacher();
                        $firstname = $user->getFirstname();
                        $lastname = $user->getLastname();
                        $username = $user->getUsername();
                        $password = $user->getPassword();
                        $profilpicture = $user->getProfilpicture();
                        $courriel = $user->getCourriel();
                        
                        $_SESSION['id'] = $id;
                        $_SESSION['firstname'] = $firstname;
                        $_SESSION['lastname'] = $lastname;
                        $_SESSION['username'] = $username;
                        $_SESSION['password'] = $password;
                        $_SESSION['profilpicture'] = $profilpicture;
                        $_SESSION['courriel'] = $courriel;
                        $_SESSION['role'] = "Teacher";
    
                        $err['valide'] = true;
                    }else
                        $err['account'] = "L'utilisateur n'existe pas !";
                }else
                    $err['account'] = "L'utilisateur n'existe pas !";
            }else{
                $user = AdminController::SELECT(\Database::SELECT_ALL, ['username' => $username], 1);
    
                if ($user){
                    $user = $user[0];
    
                    if (password_verify($password, $user->getPassword())){
                        $id = $user->getIdadmin();
                        $firstname = $user->getFirstname();
                        $lastname = $user->getLastname();
                        $username = $user->getUsername();
                        $password = $user->getPassword();
                        $profilpicture = $user->getProfilpicture();
                        $courriel = $user->getCourriel();
                        
                        $_SESSION['id'] = $id;
                        $_SESSION['firstname'] = $firstname;
                        $_SESSION['lastname'] = $lastname;
                        $_SESSION['username'] = $username;
                        $_SESSION['password'] = $password;
                        $_SESSION['profilpicture'] = $profilpicture;
                        $_SESSION['courriel'] = $courriel;
                        $_SESSION['role'] = "Admin";
    
                        $err['valide'] = true;
                    }else
                        $err['account'] = "L'utilisateur n'existe pas !";
                }else
                    $err['account'] = "L'utilisateur n'existe pas !";
            }
        }

        return $err;
    }

    public static function logout(){
        session_destroy();
        ViewController::redirect("/");
    }
}
