<?php

namespace Proveedor\Form;

use Zend\InputFilter\InputFilter;

class CreateValidator extends InputFilter {
    public function __construct() {
          // Create main input filter
        //$inputFilter = $this->getInputFilter();    

          // Add input for "nombre" field
        $this->add([
            'name'     => 'nombre',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],                    
            ],                
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 128
                    ],
                ],                 
            ],
        ]);     
        
          $this->add([
            'name'     => 'rut',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],                    
            ],                
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 128
                    ],
                ],                 
            ],
        ]);
    }
}
