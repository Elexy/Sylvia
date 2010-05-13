<?php

/**
 * Location form base class.
 *
 * @package    form
 * @subpackage location
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseLocationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'location'   => new sfWidgetFormInputText(),
      'walk_order' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => 'Location', 'column' => 'id', 'required' => false)),
      'location'   => new sfValidatorString(array('max_length' => 20)),
      'walk_order' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('location[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Location';
  }

}