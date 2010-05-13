<?php

/**
 * Catalogus form base class.
 *
 * @method Catalogus getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCatalogusForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid'     => new sfWidgetFormInputText(),
      'catalogusid'   => new sfWidgetFormInputHidden(),
      'catalogusdesc' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'contactid'     => new sfValidatorInteger(array('required' => false)),
      'catalogusid'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'catalogusid', 'required' => false)),
      'catalogusdesc' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('catalogus[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Catalogus';
  }

}
