<?php

/**
 * Categories form base class.
 *
 * @method Categories getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCategoriesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'categoryid'   => new sfWidgetFormInputHidden(),
      'parentid'     => new sfWidgetFormInputText(),
      'public'       => new sfWidgetFormInputText(),
      'categoryname' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'categoryid'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'categoryid', 'required' => false)),
      'parentid'     => new sfValidatorInteger(array('required' => false)),
      'public'       => new sfValidatorInteger(array('required' => false)),
      'categoryname' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('categories[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Categories';
  }

}
