<?php

return [
    'defaults'      => [
        //'wrapper_class'       => 'form-group',
        'wrapper_class'       => 'input-field',
        'wrapper_error_class' => 'invalid',
        //'label_class'         => 'control-label',
        'label_class'         => '',
        //'field_class'         => 'form-control',
        'field_class'         => 'validate',
        'help_block_class'    => 'help-block',
        'error_class'         => 'field-error',
        //'error_class'         => 'text-danger',
        'required_class'      => 'required'
    ],
    // Templates
    'form'          => 'laravel-form-builder::form',
    'text'          => 'laravel-form-builder::text',
    'textarea'      => 'laravel-form-builder::textarea',
    'button'        => 'laravel-form-builder::button',
    'radio'         => 'laravel-form-builder::radio',
    'checkbox'      => 'laravel-form-builder::checkbox',
    'select'        => 'laravel-form-builder::select',
    'choice'        => 'laravel-form-builder::choice',
    'repeated'      => 'laravel-form-builder::repeated',
    'child_form'    => 'laravel-form-builder::child_form',
    'collection'    => 'laravel-form-builder::collection',
    'static'        => 'laravel-form-builder::static',

    // Remove the laravel-form-builder:: prefix above when using template_prefix
    'template_prefix'   => '',

    'default_namespace' => '',

    'custom_fields' => [
//        'datetime' => 'App\Forms\Fields\Datetime'
    ]
];
