<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Adressen filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseAdressenFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid'   => new sfWidgetFormFilterInput(),
      'adrestitel'  => new sfWidgetFormFilterInput(),
      'naam'        => new sfWidgetFormFilterInput(),
      'attn'        => new sfWidgetFormFilterInput(),
      'straat'      => new sfWidgetFormFilterInput(),
      'huisnummer'  => new sfWidgetFormFilterInput(),
      'postcode'    => new sfWidgetFormFilterInput(),
      'postbus'     => new sfWidgetFormFilterInput(),
      'plaats'      => new sfWidgetFormFilterInput(),
      'land'        => new sfWidgetFormFilterInput(),
      'email'       => new sfWidgetFormFilterInput(),
      'telefoon'    => new sfWidgetFormFilterInput(),
      'prive_adres' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contactid'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'adrestitel'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'naam'        => new sfValidatorPass(array('required' => false)),
      'attn'        => new sfValidatorPass(array('required' => false)),
      'straat'      => new sfValidatorPass(array('required' => false)),
      'huisnummer'  => new sfValidatorPass(array('required' => false)),
      'postcode'    => new sfValidatorPass(array('required' => false)),
      'postbus'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'plaats'      => new sfValidatorPass(array('required' => false)),
      'land'        => new sfValidatorPass(array('required' => false)),
      'email'       => new sfValidatorPass(array('required' => false)),
      'telefoon'    => new sfValidatorPass(array('required' => false)),
      'prive_adres' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'naam'        => 'Text',
      'attn'        => 'Text',
      'straat'      => 'Text',
      'huisnummer'  => 'Text',
      'postcode'    => 'Text',
      'postbus'     => 'Number',
      'plaats'      => 'Text',
      'land'        => 'Text',
      'email'       => 'Text',
      'telefoon'    => 'Text',
      'prive_adres' => 'Number',
    );
  }
}
