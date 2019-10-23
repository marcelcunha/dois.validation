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
        ];
    }
}
