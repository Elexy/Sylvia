<?php

/**
 * Categories form base class.
 *
 * @package    form
 * @subpackage categories
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCategoriesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'categoryid'   => new sfWidgetFormInputHidden(),
      'parentid'     => new sfWidgetFormInputText(),
      'dummy'        => new sfWidgetFormDateTime(),
      'public'       => new sfWidgetFormInputText(),
      'categoryname' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'categoryid'   => new sfValidatorDoctrineChoice(array('model' => 'Categories', 'column' => 'categoryid', 'required' => false)),
      'parentid'     => new sfValidatorInteger(),
      'dummy'        => new sfValidatorDateTime(),
      'public'       => new sfValidatorInteger(),
      'categoryname' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('categories[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Categories';
  }

}