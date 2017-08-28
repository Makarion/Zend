<?php

namespace Files;
 use Files\Model\Files;
 use Files\Model\FilesTable;
 use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
 use Zend\ModuleManager\Feature\ConfigProviderInterface;
 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\TableGateway\TableGateway;
 

 class Module implements AutoloaderProviderInterface, ConfigProviderInterface
 {
     public function getAutoloaderConfig(){}
     public function getConfig()
     {
         return include __DIR__ . '/config/module.config.php';
     }

      public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Files\Model\FilesTable' =>  function($sm) {
                     $tableGateway = $sm->get('FilesTableGateway');
                     $table = new FilesTable($tableGateway);
                     return $table;
                 },
                 'FilesTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Files());
                     return new TableGateway('files', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }

 }

?>
