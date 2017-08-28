<?php

 namespace Files\Model;
 
 use Zend\InputFilter\Factory as InputFactory;
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;


 class Files
 {
     public $id;
     public $nazwa;
     public $typ;
     public $rozmiar;
     protected $inputFilter;     

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->nazwa = (!empty($data['nazwa'])) ? $data['nazwa'] : null;
         $this->typ  = (!empty($data['typ'])) ? $data['typ'] : null;
	 $this->rozmiar = (!empty($data['rozmiar'])) ? $data['rozmiar'] : null;
     }
}

/*     public $fileupload;
     protected $inputFilter;
     
     public function exchangeArray($data)
     {
         $this->fileupload  = (isset($data['fileupload']))  ? $data['fileupload']     : null; 
     }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    } 

      public function getInputFilter()
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();
	     $factory = new InputFactory();

             $inputFilter->add(
		$factory->createInput(array(
			'name' => 'fileupload',
			'required' => 'true',
		))
	     );
	 $this->inputFilter = $inputFilter;
     	}
         return $this->inputFilter;
     }
 }
*/
?>
