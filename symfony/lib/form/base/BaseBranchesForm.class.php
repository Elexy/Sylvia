<?php

/**
 * Branches form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseBranchesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'branchecontactid' => new sfWidgetFormInputHidden(),
      'maincontactid'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'branchecontactid' => new sfValidatorPropelChoice(array('model' => 'Branches', 'column' => 'branchecontactid', 'required' => false)),
      'maincontactid'    => new sfValidatorPropelChoice(array('model' => 'Branches', 'column' => 'maincontactid', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('branches[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Branches';
  }


}
