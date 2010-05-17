<?php

/**
 * ExtraProductText form base class.
 *
 * @method ExtraProductText getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseExtraProductTextForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'productid' => new sfWidgetFormInputText(),
      'text'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'productid' => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'text'      => new sfValidatorString(array('max_length' => 6)),
    ));

    $this->widgetSchema->setNameFormat('extra_product_text[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExtraProductText';
  }

}
