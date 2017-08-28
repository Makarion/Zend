<?php

 return array(
     'controllers' => array(
         'invokables' => array(
             'Files\Controller\Files' => 'Files\Controller\FilesController',
         ),
     ),

     'router' => array(
         'routes' => array(
             'files' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/files[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Files\Controller\Files',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'files' => __DIR__ . '/../view',
         ),
     ),
 );

?>
