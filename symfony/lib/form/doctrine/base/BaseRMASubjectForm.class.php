<?php

/**
 * RMASubject form base class.
 *
 * @method RMASubject getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRMASubjectForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'subject_id'   => new sfWidgetFormInputHidden(),
      'subject_text' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'subject_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'subject_id', 'required' => false)),
      'subject_text' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rma_subject[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RMASubject';
  }

}
