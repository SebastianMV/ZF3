<?php

namespace Proveedor\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Proveedor\Form\CreateForm;

class ProveedorController extends AbstractActionController
{
    protected $container;
    
    public function __construct($container = null)
    {
        $this->container = $container;
    }
    
    public function createAction() {
        return ['titulo' => 'Agregar Proveedor', 'form' => new CreateForm('creaProveedor')];
    }  
    
    public function addAction() {

        if (!$this->request->isPost()) {
            $this->redirect()->toRoute('proveedores', ['action' => 'read']);
        }

        $form = new CreateForm("creaProveedor");
        
         // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            
            // Fill in the form with POST data
            //$data = $this->params()->fromPost();   
            
            $data = $this->request->getPost();
            
            $form->setData($data);
            
            // Validate form
            if($form->isValid()) {
                
                // Get filtered and validated data
                $data = $form->getData();
                
                // Add user.
                $user = $this->userManager->addUser($data);
                
                // Redirect to "view" page
                return $this->redirect()->toRoute('users', 
                        ['action'=>'view', 'id'=>$user->getId()]);                
            }     
            else{
                echo 'Error';
            }
        } 
 

    }
    
    public function readAction(){        
        $sm = $this->container->get('Doctrine\ORM\EntityManager');        
        //PDO
        $conn = $sm->getConnection();
        
        $res = $conn->prepare('SELECT * FROM proveedor');
        $res->execute();
        $data = $res->fetchAll();   
//        
//       echo '<pre>';  print_r($data);   
//       echo '</pre><br>';
//        echo '<pre>';  print_r($data[0]->id); 
//        echo '</pre><br>';
//        echo '<pre>';  print_r($data[0]->nombre); 
//      
//       exit;                
       
        return new ViewModel(['proveedores' => $data]);        
    }
    
}