<?php

namespace Files\Form;
use Zend\Form\Form;

class UploadForm extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('Files');
		$this->setAttribute('method','post');
		$this->setAttribute('enctype','multipart/form-data');

/*		$this->add(array(
			'name' => 'id',
			'type' => 'Hidden',
		));
		$this->add(array(
            		 'name' => 'nazwa',
            		 'type' => 'Hidden',
         ));
		
		$this->add(array(
            		 'name' => 'typ',
            		 'type' => 'Hidden',
         ));
		$this->add(array(
             	   	 'name' => 'rozmiar',
      		         'type' => 'Hidden',
         ));
*/
		$this->add(array(
		      'name' => 'fileupload',
		      'attributes' => array(
		            'type' => 'file',
		      ),
		       'options' => array(
		            'label' => 'File Upload',
		      ),
		));

		$this->add(array(
            		'name' => 'submit',
            		'attributes' => array(
                	      'type'  => 'submit',
                	      'value' => 'Upload Now'
            ),
        )); 
	}
}

?>
