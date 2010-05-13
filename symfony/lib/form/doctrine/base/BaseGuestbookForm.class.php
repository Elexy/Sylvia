<?php

/**
 * Guestbook form base class.
 *
 * @package    form
 * @subpackage guestbook
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseGuestbookForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'name'      => new sfWidgetFormInputText(),
      'entrydate' => new sfWidgetFormDateTime(),
      'comment'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorDoctrineChoice(array('model' => 'Guestbook', 'column' => 'id', 'required' => false)),
      'name'      => new sfValidatorString(array('max_length' => 255)),
      'entrydate' => new sfValidatorDateTime(),
      'comment'   => new sfValidatorString(array('max_length' => 2147483647)),
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