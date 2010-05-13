<?php

/**
 * Catalogus form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseCatalogusForm extends BaseFormPropel
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
      'catalogusid'   => new sfValidatorPropelChoice(array('model' => 'Catalogus', 'column' => 'catalogusid', 'required' => false)),
      'catalogusdesc' => new sfValidatorString(array('max_length' => 25)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Catalogus', 'column' => array('contactid', 'catalogusdesc')))
    );

    $this->widgetSchema->setNameFormat('catalogus[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Catalogus';
  }


}
