<?php

/**
 * categories module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage categories
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCategoriesGeneratorConfiguration extends sfModelGeneratorConfiguration
{
  public function getActionsDefault()
  {
    return array();
  }

  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }

  public function getNewActions()
  {
    return array();
  }

  public function getEditActions()
  {
    return array();
  }

  public function getListObjectActions()
  {
    return array(  '_edit' => NULL,  '_delete' => NULL,);
  }

  public function getListActions()
  {
    return array(  '_new' => NULL,);
  }

  public function getListBatchActions()
  {
    return array(  '_delete' => NULL,);
  }

  public function getListParams()
  {
    return '%%categoryid%% - %%parentid%% - %%public%% - %%categoryname%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Categories List';
  }

  public function getEditTitle()
  {
    return 'Edit Categories';
  }

  public function getNewTitle()
  {
    return 'New Categories';
  }

  public function getFilterDisplay()
  {
    return array();
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array();
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {
    return array(  0 => 'categoryid',  1 => 'parentid',  2 => 'public',  3 => 'categoryname',);
  }

  public function getFieldsDefault()
  {
    return array(
      'categoryid' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'parentid' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'public' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'categoryname' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'categoryid' => array(),
      'parentid' => array(),
      'public' => array(),
      'categoryname' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'categoryid' => array(),
      'parentid' => array(),
      'public' => array(),
      'categoryname' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'categoryid' => array(),
      'parentid' => array(),
      'public' => array(),
      'categoryname' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'categoryid' => array(),
      'parentid' => array(),
      'public' => array(),
      'categoryname' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'categoryid' => array(),
      'parentid' => array(),
      'public' => array(),
      'categoryname' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'CategoriesForm';
  }

  public function hasFilterForm()
  {
    return true;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'CategoriesFormFilter';
  }

  public function getPagerClass()
  {
    return 'sfDoctrinePager';
  }

  public function getPagerMaxPerPage()
  {
    return 20;
  }

  public function getDefaultSort()
  {
    return array(null, null);
  }

  public function getTableMethod()
  {
    return '';
  }

  public function getTableCountMethod()
  {
    return '';
  }
}
