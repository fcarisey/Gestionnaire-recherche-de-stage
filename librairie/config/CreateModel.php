<?php

require_once('../Database.php');

/**
 * @return string|false
 */
function getUserInput(string $message){
    echo $message;
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    fclose($handle);

    return trim($line);
}

function createModelFile(string $model_name, array $element, $database_name){
    $var_ele = "private ";
    $construct = "public function __construct(";
    $construct_setter = "   \$this";
    $mutator = "";
    $format = "
        public static function format(\$data){\n
            \$objs = [];\n
            if (\$data != NULL){\n
                foreach(\$data as \$d){\n";
    $format_new = "";
    foreach($element as $e => $type){
        if ($var_ele != "private ")
            $var_ele .= ",";
        $var_ele .= "\$$e";

        if ($construct != "public function __construct(")
            $construct .= ",";
        $construct .= "\$$e = null";

        $a = $e;
        $a[0] = strtoupper($a[0]);
        if (strpos($a, '_') != false){
            $a[strpos($a, '_')+1] = strtoupper($a[strpos($a, '_')+1]);
            $a = str_replace('_', '', $a);
        }

        $construct_setter .= "->set$a(\$$e)";

        $mutator .= "
        public function set$a(\$$e){
            \$this->$e = \$$e;
            return \$this;
        }
        public function get$a(){
            return \$this->$e;
        }\n";

        $format .= "
                    \$$e = \Controller\ControllerController::keyExist('$e', \$d);";

        if ($format_new != "")
            $format_new .= ",";
        $format_new .= "\$$e";
    }
    $var_ele .= ";";
    $construct_setter .= ";";

    $construct .= "){
        $construct_setter
        }\n";
    $a = strtolower($model_name);
    $format .= "
                    \$$a = new self($format_new);\n
                    array_push(\$objs, \$$a);
                }
            }
            return (empty(\$objs)) ? null : \$objs;
        }";

    $file = fopen("../Model/$model_name.php", 'w');
    fwrite($file, "<?php
    namespace Model;
    Class $model_name{
        $var_ele\n
        $construct
        $mutator
        $format
    }");
    fclose($file);

    createControllerFile($model_name, $database_name);
}

function createControllerFile(string $model_name, $database_name){
    $file = fopen("../Controller/{$model_name}Controller.php", 'w');
    $a = strtolower($model_name);
    fwrite($file, "<?php
    namespace Controller;
    Class {$model_name}Controller extends ControllerController{
        protected static \$table_name = \"$model_name\";
        protected static \$model_class = \Model\\$model_name::class;
        protected static \$database = \"$database_name\";
    }");
    fclose($file);
}

$database_name = getUserInput("Entre le que vous avez donner à votre base de donnée: ");
$model_name = getUserInput("Entrez un nom pour le Model (la première lettre en majuscule): ");

echo "Création des tables (ne pas mettre d'espace mais des '_').\n";
$var_ele = [];
$var = "";
while($var != "-1"){
    if ($var != "")
        $var_ele[$var] = $type;
    $var = getUserInput("Nom de la colonne (-1 pour arrêter): ");
}

createModelFile($model_name, $var_ele, $database_name);

?>
