<?php

/**
 * Branches form base class.
 *
 * @package    form
 * @subpackage branches
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseBranchesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'branchecontactid' => new sfWidgetFormInputHidden(),
      'maincontactid'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'branchecontactid' => new sfValidatorDoctrineChoice(array('model' => 'Branches', 'column' => 'branchecontactid', 'required' => false)),
      'maincontactid'    => new sfValidatorDoctrineChoice(array('model' => 'Branches', 'column' => 'maincontactid', 'required' => false)),
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