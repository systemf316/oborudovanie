<?php
$arUrlRewrite=array (
  0 => 
  array (
    'CONDITION' => '#^/service/(.+)/(.*)#',
    'RULE' => 'ELEMENT_CODE=$1',
    'PATH' => '/service/detail.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/products/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/products/index.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
);
