<?php

/**
 * Catalogusdetails form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseCatalogusdetailsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'productid'   => new sfWidgetFormInputHidden(),
      'catalogusid' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'productid'   => new sfValidatorPropelChoice(array('model' => 'Catalogusdetails', 'column' => 'productid', 'required' => false)),
      'catalogusid' => new sfValidatorPropelChoice(array('model' => 'Catalogusdetails', 'column' => 'catalogusid', 'required' => false)),
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
