<?php
// auto-generated by sfRoutingConfigHandler
// date: 2009/06/02 15:41:51
return array(
'btwtabel' => new sfPropelRouteCollection(array (
  'model' => 'Btwtabel',
  'module' => 'btwtabel',
  'prefix_path' => 'btwtabel',
  'column' => 'Btw_class',
  'with_wildcard_routes' => true,
  'name' => 'btwtabel',
  'requirements' => 
  array (
  ),
)),
'categories' => new sfPropelRouteCollection(array (
  'model' => 'Categories',
  'module' => 'categories',
  'prefix_path' => 'categories',
  'column' => 'CategoryID',
  'with_wildcard_routes' => true,
  'name' => 'categories',
  'requirements' => 
  array (
  ),
)),
'genuser' => new sfPropelRouteCollection(array (
  'model' => 'Genuser',
  'module' => 'genuser',
  'prefix_path' => 'genuser',
  'column' => 'id',
  'with_wildcard_routes' => true,
  'name' => 'genuser',
  'requirements' => 
  array (
  ),
)),
'brand' => new sfPropelRouteCollection(array (
  'model' => 'Brand',
  'module' => 'brand',
  'prefix_path' => 'brand',
  'column' => 'brand_id',
  'with_wildcard_routes' => true,
  'name' => 'brand',
  'requirements' => 
  array (
  ),
)),
'homepage' => new sfRoute('/', array (
  'module' => 'brand',
  'action' => 'index',
), array (
), array (
)),
'default_index' => new sfRoute('/:module', array (
  'action' => 'index',
), array (
), array (
)),
'default' => new sfRoute('/:module/:action/*', array (
), array (
), array (
)),
);