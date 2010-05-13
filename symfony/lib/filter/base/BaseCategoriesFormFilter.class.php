<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Categories filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseCategoriesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'parentid'     => new sfWidgetFormFilterInput(),
      'categoryname' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'parentid'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'categoryname' => 'Text',
    );
  }
}
