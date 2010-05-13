<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Listbox filter form base class.
 *
 * @package    filters
 * @subpackage Listbox *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseListboxFormFilter extends BaseFormFilterDoctrine
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