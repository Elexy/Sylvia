<?php
/**
 * This file is part of the ckWsdlGenerator
 *
 * @package   ckWsdlGenerator
 * @author    Christian Kerl <christian-kerl@web.de>
 * @copyright Copyright (c) 2008, Christian Kerl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @version   SVN: $Id: ckXsdComplexType.class.php 13449 2008-11-27 23:04:19Z chrisk $
 */

/**
 * ckXsdComplexType represents a complex xsd type.
 *
 * @package    ckWsdlGenerator
 * @subpackage xsd
 * @author     Christian Kerl <christian-kerl@web.de>
 */
class ckXsdComplexType extends ckXsdType
{
  /**
   * The name of the root node of the xml representation.
   */
  const ELEMENT_NAME = 'complexType';

  /**
   * The suffix appended to the name of the type to get the name of the corresponding xsd element for the type.
   */
  const ELEMENT_SUFFIX = 'Element';

  /**
   * Gets the ckAbstractPropertyStrategy for a given class from the PropertyStrategy annotation,
   * if no annotation is found ckDefaultPropertyStrategy is returned.
   *
   * @param ReflectionAnnotatedClass $class A ReflectionAnnotatedClass object
   *
   * @return ckAbstractPropertyStrategy The ckAbstractPropertyStrategy implementation
   */
  protected static function getPropertyStrategy(ReflectionAnnotatedClass $class)
  {
    $strategy = null;

    if($class->hasAnnotation('PropertyStrategy'))
    {
      $strategy = $class->getAnnotation('PropertyStrategy')->value;

      $strategy = new $strategy($class);
    }
    if(is_null($strategy) || !$strategy instanceof ckAbstractPropertyStrategy)
    {
      $strategy = new ckDefaultPropertyStrategy($class);
    }

    return $strategy;
  }

  /**
   * Creates a new complex type object for the given php class.
   *
   * @param string $name A name of a php class
   *
   * @return ckXsdComplexType The complex type object
   */
  public static function create($name)
  {
    $reflectClass= new ReflectionAnnotatedClass($name);
    $result = new ckXsdComplexType($name, ckXsdNamespace::get('tns'));

    foreach(self::getPropertyStrategy($reflectClass)->getProperties() as $property)
    {
      $result->addElement(new ckXsdComplexTypeElement($property['name'], ckXsdType::get($property['type'])));
    }

    return $result;
  }

  /**
   * An array of xsd elements, which represent the properties of the complex type.
   *
   * @var array
   */
  protected $elements = array();

  /**
   * Adds a xsd element.
   *
   * @param ckXsdComplexTypeElement $element An element to add
   */
  public function addElement(ckXsdComplexTypeElement $element)
  {
    $this->elements[] = $element;
  }

  /**
   * Gets all elements of the complex xsd type.
   *
   * @return array An array containing all elements
   */
  public function getElements()
  {
    return $this->elements;
  }

  /**
   * @see ckDOMSerializable::getNodeName()
   */
  public function getNodeName()
  {
    return self::ELEMENT_NAME;
  }

  /**
   * Protected constructor initializing the complex xsd type with a given name and a given namespace.
   *
   * @param string         $name      The name of the complex type
   * @param ckXsdNamespace $namespace The namespace of the complex type
   */
  protected function __construct($name = null, ckXsdNamespace $namespace = null)
  {
    parent::__construct($name, $namespace);
  }

  /**
   * @see ckDOMSerializable::serialize()
   */
  public function serialize(DOMDocument $document)
  {
    $xsd = ckXsdNamespace::get('xsd');

    $node = $document->createElementNS($xsd->getUrl(), $xsd->qualify($this->getNodeName()));
    $node->setAttribute('name', $this->getName());

    $sequence = $document->createElementNS($xsd->getUrl(), $xsd->qualify('sequence'));

    foreach($this->getElements() as $element)
    {
      $sequence->appendChild($element->serialize($document));
    }

    $node->appendChild($sequence);

    $element = new ckXsdComplexTypeElement($this->getName().self::ELEMENT_SUFFIX, $this);

    $fragment = $document->createDocumentFragment();
    $fragment->appendChild($node);
    $fragment->appendChild($element->serialize($document));

    return $fragment;
  }
}