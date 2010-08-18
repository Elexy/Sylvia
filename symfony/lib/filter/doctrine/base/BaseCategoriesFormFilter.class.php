<?php

/**
 * Categories filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCategoriesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'parentid'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'public'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'categoryname' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'parentid'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'public'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'categoryname' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('categories_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Categories';
  }

  public function getFields()
  {
    return array(
      'categoryid'   => 'Number',
      'parentid'     => 'Number',
      'public'       => 'Number',
      'categoryname' => 'Text',
    );
  }
}
