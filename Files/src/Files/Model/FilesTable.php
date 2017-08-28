<?php

 namespace Files\Model;

 use Zend\Db\TableGateway\TableGateway;

 class FilesTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
	 /*$this->add(array(
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
	 ));*/
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getFile($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveFile(Files $file)
     {
         $data = array(
             'nazwa' => $file->nazwa,
             'typ'  => $file->typ,
	     'rozmiar' => $file->rozmiar,
         );

         $id = (int) $file->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getFile($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('File id does not exist');
             }
         }
     }

/*     public function deleteFile($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
*/
 }

?>
