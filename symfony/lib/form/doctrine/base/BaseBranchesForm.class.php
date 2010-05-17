<?php

/**
 * Branches form base class.
 *
 * @method Branches getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseBranchesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'branchecontactid' => new sfWidgetFormInputHidden(),
      'maincontactid'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'branchecontactid' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'branchecontactid', 'required' => false)),
      'maincontactid'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'maincontactid', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('branches[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Branches';
  }

}
