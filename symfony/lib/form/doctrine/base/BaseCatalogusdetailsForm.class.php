<?php

/**
 * Catalogusdetails form base class.
 *
 * @package    form
 * @subpackage catalogusdetails
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCatalogusdetailsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'productid'   => new sfWidgetFormInputHidden(),
      'catalogusid' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'productid'   => new sfValidatorDoctrineChoice(array('model' => 'Catalogusdetails', 'column' => 'productid', 'required' => false)),
      'catalogusid' => new sfValidatorDoctrineChoice(array('model' => 'Catalogusdetails', 'column' => 'catalogusid', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('catalogusdetails[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Catalogusdetails';
  }

}