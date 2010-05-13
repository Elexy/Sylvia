<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Adressen filter form base class.
 *
 * @package    filters
 * @subpackage Adressen *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseAdressenFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid'   => new sfWidgetFormFilterInput(),
      'adrestitel'  => new sfWidgetFormFilterInput(),
      'straat'      => new sfWidgetFormFilterInput(),
      'postcode'    => new sfWidgetFormFilterInput(),
      'postbus'     => new sfWidgetFormFilterInput(),
      'plaats'      => new sfWidgetFormFilterInput(),
      'land'        => new sfWidgetFormFilterInput(),
      'dummy'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'prive_adres' => new sfWidgetFormFilterInput(),
      'naam'        => new sfWidgetFormFilterInput(),
      'attn'        => new sfWidgetFormFilterInput(),
      'huisnummer'  => new sfWidgetFormFilterInput(),
      'email'       => new sfWidgetFormFilterInput(),
      'telefoon'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contactid'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'adrestitel'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'straat'      => new sfValidatorPass(array('required' => false)),
      'postcode'    => new sfValidatorPass(array('required' => false)),
      'postbus'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'plaats'      => new sfValidatorPass(array('required' => false)),
      'land'        => new sfValidatorPass(array('required' => false)),
      'dummy'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'prive_adres' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'naam'        => new sfValidatorPass(array('required' => false)),
      'attn'        => new sfValidatorPass(array('required' => false)),
      'huisnummer'  => new sfValidatorPass(array('required' => false)),
      'email'       => new sfValidatorPass(array('required' => false)),
      'telefoon'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('adressen_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Adressen';
  }

  public function getFields()
  {
    return array(
      'adresid'     => 'Number',
      'contactid'   => 'Number',
      'adrestitel'  => 'Number',
      'straat'      => 'Text',
      'postcode'    => 'Text',
      'postbus'     => 'Number',
      'plaats'      => 'Text',
      'land'        => 'Text',
      'dummy'       => 'Date',
      'prive_adres' => 'Number',
      'naam'        => 'Text',
      'attn'        => 'Text',
      'huisnummer'  => 'Text',
      'email'       => 'Text',
      'telefoon'    => 'Text',
    );
  }
}