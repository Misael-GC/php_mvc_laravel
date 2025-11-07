<?php

class Validator {
    protected $errors = [];

    public function __construct(
        protected array $data,
        protected array $rules = []
    ){
        $this->validate(); 
    }

    public function validate(){
        foreach($this->rules as $field => $rules){
            $rules = explode('|', $rules);
            $value =trim( $this->data[$field]);
             foreach($rules as $rule){
                [$name, $param] = array_pad(explode(':', $rule), 2, null);

                $error = match($name) {
                    'required' => empty($value) ? "El campo $field es obligatorio." : null,
                    'min' => strlen($value) < (int)$param ? "El campo $field debe tener al menos $param caracteres." : null,
                    'max' => strlen($value) > (int)$param ? "El campo $field no debe exceder de $param caracteres." : null,
                    'url' => !filter_var($value, FILTER_VALIDATE_URL) ? "El campo $field debe ser una URL válida." : null,
                    default => null
                };
                if($error){
                    $this->errors[] = $error;
                    break;
                }
             }
        }
    }

    public function passes(): bool {
        return empty($this->errors);
    }

    public function errors(): array {
        return $this->errors;
    }
}
