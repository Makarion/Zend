<?php

namespace Files\Model;
 
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class SearchFile implements InputFilterAwareInterface
{
	public $title;
	protected $inputFilter;

	public function exchangeArray($data)
	{
	 $this->title = (isset($data['title'])) ? $data['title'] : null;
	}
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
	 throw new \Exception("Not used");
	}

	public function getInputFilter()
	{
	 if(!$this->inputFilter)
	 {
	  $inputFilter = new InputFilter();

	  $inputFilter->add(array(
		'name' => 'title',
		'required' => 'true',
		'filters' => array(
			array('name' => 'StripTags'),
			array('name' => 'StringTrim'),
		),
		
		'validators' => array(
			array(
				'name' => 'StringLength',
				'options' => array(
					'encoding' => 'UTF-8',
					'min' => 1,
					'max' => 100,
				),
			),
		),	
  	  ));
	 }
	}
} 

?>
