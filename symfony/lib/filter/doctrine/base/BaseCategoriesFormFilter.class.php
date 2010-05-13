<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Categories filter form base class.
 *
 * @package    filters
 * @subpackage Categories *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseCategoriesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'parentid'     => new sfWidgetFormFilterInput(),
      'dummy'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'public'       => new sfWidgetFormFilterInput(),
      'categoryname' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'parentid'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dummy'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'public'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'categoryname' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('categories_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

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
      'dummy'        => 'Date',
      'public'       => 'Number',
      'categoryname' => 'Text',
    );
  }
}