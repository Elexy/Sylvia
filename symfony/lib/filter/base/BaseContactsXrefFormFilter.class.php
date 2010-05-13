<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ContactsXref filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseContactsXrefFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid' => new sfWidgetFormFilterInput(),
      'otherid'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contactid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'otherid'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('contacts_xref_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContactsXref';
  }

  public function getFields()
  {
    return array(
      'contactid' => 'Number',
      'otherid'   => 'Number',
      'id'        => 'Number',
    );
  }
}
