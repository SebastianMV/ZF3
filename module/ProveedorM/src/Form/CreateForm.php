<?php
namespace Proveedor\Form;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Email;

/* Proveedor -> Nombre
 *           -> Email
 *           -> RUT
 */
                     
class CreateForm extends Form {
    public function __construct($name = null) {
        
        // $name -> Nombre del formulario        
        parent::__construct($name); 
        
        // Configurar metodo POST
        $this->setAttribute('method', 'post');
        
        $this->addElements();
        $this->addInputFilter();
       
    }
    
    /*  Este metodo añade los elementoas al form (campos input y submit button).
     */
    protected function addElements(){
        
        $this->add(['type' => 'text',
            'name' => 'nombre',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Nombre',
                'label_attributes' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ],
        ]);
        
        $this->add(['type' => Email::class,
            'name' => 'email',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Email',
                'label_attributes' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ],
        ]);

        $this->add(['type' => Text::class,
            'name' => 'rut',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'RUT',
                'label_attributes' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ],
        ]);
        
        // Add the CSRF field
        $this->add([
            'type'  => 'csrf',
            'name' => 'csrf',
            'attributes' => [],
            'options' => [                
                'csrf_options' => [
                     'timeout' => 600
                ]
            ],
        ]);

        $this->add(['name' => 'send',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Guardar',
                'class' => 'btn btn-primary',
            ],
        ]);        
    }
    
    private function addInputFilter() {
         // Create main input filter
        $inputFilter = $this->getInputFilter();        

        // Add input for "nombre" field
        $inputFilter->add([
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
        
          $inputFilter->add([
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