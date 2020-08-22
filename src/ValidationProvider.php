<?php

namespace Dois\Validation;

use Illuminate\Support\ServiceProvider;

class ValidationProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->resolver(function ($translator, $data, $rules, $messages, $customAttributes)
        {
            $messages += $this->getMessages();

            return new Validator($translator, $data, $rules, $messages, $customAttributes);
        });
    }

    protected function getMessages(){
        return [
            'cpf' => 'O campo :attribute não é válido',
            'cnpj' => 'O campo :attribute não é válido',
            'cpf_cnpj' => 'O campo :attribute não tem um valor de cpf ou cnpj válido',
            'password' => 'O campo :attribute precisa ter no mínimo 8 caractéres, pelo menos uma letra maiúscula e um numeral',
            'mobile' => 'O campo :attribute não é válido'
        ];
    }
}
