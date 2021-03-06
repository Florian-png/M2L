<?php
spl_autoload_register('Autoloader::autoloadDto');
spl_autoload_register('Autoloader::autoloadDao');
spl_autoload_register('Autoloader::autoloadLib');
spl_autoload_register('Autoloader::autoloadController');


class Autoloader{
    
    static function autoloadDto($class){
        $file = 'modele/dto/' . ucfirst($class) . '.php';
        if(is_file($file)&& is_readable($file)){
            require $file;
        }
      
    }
    
    static function autoloadLib($class){
        $file = 'lib/' . lcfirst($class) . '.php';
        if(is_file($file)&& is_readable($file)){
            require $file;
        }
        
    }

    static function autoloadController($class) {
        $file = 'controleur/' . lcfirst($class) . '.php';
        if(is_file($file)&& is_readable($file)){
            require $file;
        }
    }
    
    static function autoloadDao($class){
        $file = 'modele/dao/' . ucfirst($class) . '.php';
        if(is_file($file)&& is_readable($file)){
            require $file;
        }
        
    }
    
    
}


