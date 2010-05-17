<?php

/**
 * Listbox filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseListboxFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'value'    => new sfWidgetFormFilterInput(),
      'category' => new sfWidgetFormFilterInput(),
      'text'     => new sfWidgetFormFilterInput(),
      'comments' => new sfWidgetFormFilterInput(),
      'color'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'value'    => new sfValidatorPass(array('required' => false)),
      'category' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'text'     => new sfValidatorPass(array('required' => false)),
      'comments' => new sfValidatorPass(array('required' => false)),
      'color'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('listbox_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Listbox';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'value'    => 'Text',
      'category' => 'Number',
      'text'     => 'Text',
      'comments' => 'Text',
      'color'    => 'Text',
    );
  }
}
