<?php

namespace App\Validations;

use Illuminate\Support\Collection;

abstract class Validation
{
    protected $rules;
    protected $only = [];
    protected $except = [];

    /**
     * Get the validation rules that apply to the entity.
     *
     * @return array
     */
    abstract protected function defaultRules(): array;

    public function __construct($rules = [])
    {
        $this->rulesInstantiate($rules);
    }

    public function rules(): array
    {
        $this->specificRules();

        $this->exceptRules();

        $this->rules->unique();

        return $this->rules->toArray();
    }

    public function removeRule($rule)
    {
        $this->except[] = $rule;

        return $this;
    }

    public function removeRules(array $rules)
    {
        $this->except = array_merge($this->except, $rules);

        return $this;
    }

    /**
     * @param $rule array|string
     * @return $this
     */
    public function addRule($rule)
    {
        $this->addRules($rule);

        return $this;
    }

    protected function addRules($rules)
    {
        $rules = is_array($rules) ? $rules : [$rules];

        $this->rules = $this->rules->merge($rules);
    }

    public function only($rules)
    {
        $this->only = is_array($rules) ? $rules : func_get_args();

        return $this;
    }

    public function except($rules)
    {
        $this->except = is_array($rules) ? $rules : func_get_args();

        return $this;
    }

    protected function specificRules()
    {
        if ($this->only) {
            $this->rules = $this->rules->filter(function ($element) {
                return in_array($element, $this->only);
            });
        }
    }

    protected function exceptRules()
    {
        $this->rules = $this->rules->reject(function ($element) {
            return in_array($element, $this->except);
        });
    }

    /**
     * @param $rules array|string
     */
    protected function rulesInstantiate($rules)
    {
        $rules = is_array($rules) ? $rules : explode('|', $rules);

        $this->rules = new Collection($this->defaultRules());

        $this->rules = $this->rules->merge($rules);
    }

    public function bail()
    {
        $this->addRule('bail');

        return $this;
    }

    public function required()
    {
        $this->addRule('required');

        return $this;
    }
}
