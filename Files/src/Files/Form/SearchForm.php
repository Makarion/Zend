<?php

namespace Files\Form;
use Zend\Form\Form;

class SearchForm extends Form
{
public function __construct()
{
	parent::__construct('searchform');
	
	$this->add(array(
		'name' => 'title',
		'type' => 'Text',
		'options' => array(
			'label' => 'Title',
		),
	));
	
	$this->add(array(
		'name' => 'submit',
		'type' => 'Submit',
		'attributes' => array(
			'value' => 'Go',
			'id' => 'submitbutton',
		),
	));
}
}
?>
