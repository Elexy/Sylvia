<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Listbox filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseListboxFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'value'    => new sfWidgetFormFilterInput(),
      'text'     => new sfWidgetFormFilterInput(),
      'category' => new sfWidgetFormFilterInput(),
      'comments' => new sfWidgetFormFilterInput(),
      'color'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'value'    => new sfValidatorPass(array('required' => false)),
      'text'     => new sfValidatorPass(array('required' => false)),
      'category' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'text'     => 'Text',
      'category' => 'Number',
      'comments' => 'Text',
      'color'    => 'Text',
    );
  }
}
