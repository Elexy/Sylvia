<?php

/**
 * Guestbook form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseGuestbookForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'name'      => new sfWidgetFormInput(),
      'entrydate' => new sfWidgetFormDateTime(),
      'comment'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'Guestbook', 'column' => 'id', 'required' => false)),
      'name'      => new sfValidatorString(array('max_length' => 255)),
      'entrydate' => new sfValidatorDateTime(),
      'comment'   => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('guestbook[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Guestbook';
  }


}
