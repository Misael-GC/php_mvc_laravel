<?php
namespace Framework;

class SessionMnager{
    public function set(string $key, mixed $value):void{
        $_SESSION[$key] = $value;
    }

    public function get(string $key, mixed $default = null): mixed{
        return $_SESSION[$key] ?? $default;
    }

    public function setFlash(string $key, mixed $value): void{
        $this->set('flas_' . $key, $value);
    }

    public function getFlash(string $key, mixed $default =null):mixed{
        $value = $this->get('flash_' . $key . $default);

        if($value !== null){
            unset($_SESSION['flash' . $key]);
        }

        return $value;
    }
}