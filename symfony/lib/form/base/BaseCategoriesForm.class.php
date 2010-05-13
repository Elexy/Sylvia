<?php

/**
 * Categories form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseCategoriesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'categoryid'   => new sfWidgetFormInputHidden(),
      'parentid'     => new sfWidgetFormInputText(),
      'categoryname' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'categoryid'   => new sfValidatorPropelChoice(array('model' => 'Categories', 'column' => 'categoryid', 'required' => false)),
      'parentid'     => new sfValidatorInteger(),
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
