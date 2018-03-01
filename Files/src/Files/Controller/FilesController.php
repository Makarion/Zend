<?php

 namespace Files\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Files\Model\UploadedFile;
 use Files\Form\UploadForm;
 use Zend\Validator\File\Size;
 use Files\Form\SearchForm;
// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));

 class FilesController extends AbstractActionController
 {
     protected $filesTable;

     public function indexAction()
     {
     }

     public function showAction()
     {
	$searchform = new SearchForm();
	$searchform->get('submit')->setValue('Search');
	$request = $this->getRequest();
 	
	if($request->isPost())
	{
	 $searchfile = new SearchFile();
	 $searchform->setInputFilter($searchfile->getInputFilter());
	 $searchform->setData($request->getPost());
	}		

	$viewmodel = new ViewModel(array('files' => $this->getFilesTable()->fetchAll(), 'searchform' => $searchform));
	return $viewmodel; 
	
	/*
	new ViewModel(array(
             'files' => $this->getFilesTable()->fetchAll(),
	));
	*/
     }

     public function addAction()
     {
	$connection = pg_connect('host=localhost dbname=tutorial user= password=') or die('Connection lost');
	$form = new UploadForm();
	
	$request = $this->getRequest();
	
	if ($request->isPost()) 
	{
	 $file = new UploadedFile();
	 $form->setInputFilter($file->getInputFilter());
	 
	 //$nonFile = $request->getPost()->toArray();
	 $Uploaded = $this->params()->fromFiles('fileupload');
	
         $typ = explode('.',$Uploaded['name']);
         $typ = strtolower(end($typ));
         $rozmiar = $Uploaded['size'];
	 $tmp = explode('/',$Uploaded['tmp_name']);
	 $tmp = end($tmp);
	 $nazwa = $tmp . '_' . $Uploaded['name'];
/*	 $data    = array_merge_recursive(
                        $this->getRequest()->getPost()->toArray(),           
                       $this->getRequest()->getFiles()->toArray()
                   );
*/
	 $form->setData($this->getRequest()->getFiles());

 	 if($form->isValid())
	 {
	  $size = new Size(array('min'=>2000000));
          $adapter = new \Zend\File\Transfer\Adapter\Http();
          $adapter->setValidators(array($size),$Uploaded['name']);	
	  
	   if (!$adapter->isValid())
          {
           $dataError = $adapter->getMessages();
           $error = array();
           foreach($dataError as $key=>$row)
           {
            $error[] = $row;
           }
           $form->setMessages(array('fileupload'=>$error ));
          }
           else
           {
            $adapter->setDestination(dirname(__DIR__).'/Controller/pliki');
            if ($adapter->receive())
            {
                $file->exchangeArray($form->getData());
		$query = pg_query("INSERT INTO files (id,nazwa,typ,rozmiar) VALUES (DEFAULT,'{$nazwa}','{$typ}','{$rozmiar}')");
            }
           }
	 }
	}
        return array('form' => $form);
    } 
     public function downloadAction()
     {	
	
	 $id = (string) $this->params()->fromRoute('id','0');
 	
	 if (!$id) 
	{
     		return $this->redirect()->toRoute('files', array(
        	'action' => 'show'
     		));
	}
	 
	try 
	{

		$file= $this->getFilesTable()->getFile($id);
		
		header('Content-Type: octet/stream');
  	        header('Content-Disposition: attachment; filename='.$file->nazwa.'');
        	header('Content-length: '.strlen($file->nazwa));        

       		// disable layout and view
		

       		readfile(__DIR__ . '/pliki/'.$file->nazwa.'');

      		$view = new ViewModel();
       		$view->setTerminal(true);
	
	        return $view;

 	}
 	catch (\Exception $ex)
	{
     		return $this->redirect()->toRoute('files', array(
         	'action' => 'show'
 	    	));
 	}
	
/* 	$file= $this->getFilesTable()->getFile($id);
	header('Content-Type: octet/stream');
	header('Content-Disposition: attachment; filename=plik1.txt');
	header('Content-length: '.strlen('plik1.txt'));        

	// disable layout and view
	
	readfile(__DIR__ . '/pliki/plik1.txt');

	$view = new ViewModel();
	$view->setTerminal(true);

	return $view;*/
     }
     
     public function getFilesTable()
     {
         if (!$this->filesTable) {
             $sm = $this->getServiceLocator();
             $this->filesTable = $sm->get('Files\Model\FilesTable');
         }
         return $this->filesTable;
     }

     public function getSearchButoon()
     {
	return $this->add(array(
    'name' => 'submit',
    'type' => 'button',
    'attributes' => array(
        'type'  => 'submit',
        'value' => 'Save',
        'id' => 'submitbutton',
        'class' => 'btn btn-default',
        'onclick' => 'tinymce.triggerSave()',
    ),
    'options' => array('label' => 'Submit')
));
     }
 }
