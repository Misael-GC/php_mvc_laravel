<?php

class Validator
{
    protected $errors = [];

    public function __construct(
        protected array $data,
        protected array $rules = []
    ) {
        $this->validate();
    }

    public function validate()
    {
        foreach ($this->rules as $field => $rules) {
            $rules = explode('|', $rules);
            $value = trim($this->data[$field]);
            foreach ($rules as $rule) {
                [$name, $param] = array_pad(explode(':', $rule), 2, null);


                if ($error = $this->hasError($name, $param, $field, $value)) {
                    $this->errors[] = $error;
                    break;
                }
            }
        }
    }

    protected function hasError($name, $param, $field, $value)
    {
        return match ($name) {
            'required' => $this->validateRequired($field, $value),
            'min' => $this->validateMin($field, $value, $param),
            'max' => $this->validateMax($field, $value, $param),
            'url' => $this->validateUrl($field, $value),
            default => null,
        };
    }

    protected function validateRequired($field, $value)
    {
        return ($value === null || $value === '') ? "The field {$field} is required." : null;
    }

    protected function validateMin($field, $value, $min)
    {
        return strlen($value) < $min ? "The field {$field} must be at least {$min} characters." : null;
    }

    protected function validateMax($field, $value, $max)
    {
        return strlen($value) > $max ? "The field {$field} must not exceed {$max} characters." : null;
    }

    protected function validateUrl($field, $value)
    {
        return filter_var($value, FILTER_VALIDATE_URL) === false ? "The field {$field} must be a valid URL." : null;
    }

    public function passes(): bool
    {
        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
