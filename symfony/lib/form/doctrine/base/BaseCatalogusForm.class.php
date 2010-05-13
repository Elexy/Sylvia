<?php

/**
 * Catalogus form base class.
 *
 * @package    form
 * @subpackage catalogus
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCatalogusForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid'     => new sfWidgetFormInputText(),
      'catalogusid'   => new sfWidgetFormInputHidden(),
      'catalogusdesc' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'contactid'     => new sfValidatorInteger(),
      'catalogusid'   => new sfValidatorDoctrineChoice(array('model' => 'Catalogus', 'column' => 'catalogusid', 'required' => false)),
      'catalogusdesc' => new sfValidatorString(array('max_length' => 25)),
    ));

    $this->widgetSchema->setNameFormat('catalogus[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Catalogus';
  }

}