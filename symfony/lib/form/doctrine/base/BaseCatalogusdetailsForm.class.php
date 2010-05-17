<?php

/**
 * Catalogusdetails form base class.
 *
 * @method Catalogusdetails getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCatalogusdetailsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'productid'   => new sfWidgetFormInputHidden(),
      'catalogusid' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'productid'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'productid', 'required' => false)),
      'catalogusid' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'catalogusid', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('catalogusdetails[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Catalogusdetails';
  }

}
