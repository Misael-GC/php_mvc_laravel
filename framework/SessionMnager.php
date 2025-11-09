<?php
namespace Framework;

class SessionMnager{

    public static function start(){
        if(session_status()=== PHP_SESSION_NONE){
            session_start();
        }
    }
    public function set(string $key, mixed $value):void{
        $_SESSION[$key] = $value;
    }

    public function get(string $key, mixed $default = null): mixed{
        return $_SESSION[$key] ?? $default;
    }

    public function setFlash(string $key, mixed $value): void{
        $this->set('flash_' . $key, $value);
    }

    public function getFlash(string $key, mixed $default =null):mixed{
        $value = $this->get('flash_' . $key, $default);

        if($value !== null){
            // unset($_SESSION['flash' . $key]);
            $this->remove('flash_' . $key,);
        }

        return $value;
    }

    public function remove(string $key):void{
        unset($_SESSION[$key]);
    }
}