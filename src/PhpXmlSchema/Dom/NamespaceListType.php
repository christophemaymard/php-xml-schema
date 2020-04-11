<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\AnyUriType;

/**
 * Represents the type for a "namespace".
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NamespaceListType
{
    /**
     * A flag to indicates whether any namespace can be present (default to FALSE).
     * @var bool
     */
    private $any = FALSE;
    
    /**
     * A flag to indicates whether any namespace, that is not the target 
     * namespace of the parent element, can be present (default to FALSE).
     * @var bool
     */
    private $other = FALSE;
    
    /**
     * A flag to indicates whether the target namespace can be present 
     * (default to FALSE).
     * @var bool
     */
    private $targetNamespace = FALSE;
    
    /**
     * A flag to indicates whether entities, that are not qualified with a 
     * namespace, can be present (default to FALSE).
     * @var bool
     */
    private $local = FALSE;
    
    /**
     * An indexed array of URI references of namespaces that can be present 
     * (default to an empty array).
     * @var AnyUriType[]
     */
    private $namespaces = [];
    
    /**
     * Creates a namespace list where any namespace can be present.
     * 
     * @return  NamespaceListType   A new instance of NamespaceListType.
     */
    public static function createAny(): self
    {
        $nsl = new self();
        $nsl->any = TRUE;
        
        return $nsl;
    }
    
    /**
     * Creates a namespace list where any namespace that is not the target 
     * namespace of the parent element can be present.
     * 
     * @return  NamespaceListType   A new instance of NamespaceListType.
     */
    public static function createOther(): self
    {
        $nsl = new self();
        $nsl->other = TRUE;
        
        return $nsl;
    }
    
    /**
     * Creates a namespace list where:
     * - the target namespace can be present or absent,
     * - entities, that are not qualified with a namespace, can be present or absent,
     * - a set of URI references of namespaces can be present.
     * 
     * @param   bool            $targetNamespace    The flag to indicates whether the target namespace can be present (TRUE).
     * @param   bool            $local              The flag to indicates whether entities, that are not qualified with a namespace, can be present (TRUE).
     * @param   AnyUriType[]    $namespaces         An indexed array of URI references of namespaces that can be present (can be empty).
     * @return  NamespaceListType   A new instance of NamespaceListType.
     */
    public static function create(bool $targetNamespace, bool $local, array $namespaces): self
    {
        $nsl = new self();
        $nsl->targetNamespace = $targetNamespace;
        $nsl->local = $local;
        
        foreach ($namespaces as $namespace) {
            $nsl->addNamespace($namespace);
        }
        
        return $nsl;
    }
    
    /**
     * Indicates whether any namespace can be present.
     * 
     * @return  bool    TRUE if any namespace can be present, otherwise FALSE.
     */
    public function hasAny(): bool
    {
        return $this->any;
    }
    
    /**
     * Indicates whether any namespace, that is not the target namespace of 
     * the parent element, can be present.
     * 
     * @return  bool    TRUE if any namespace that is not the target namespace can be present, otherwise FALSE.
     */
    public function hasOther(): bool
    {
        return $this->other;
    }
    
    /**
     * Indicates whether the target namespace can be present.
     * 
     * @return  bool    TRUE if the target namespace can be present, otherwise FALSE.
     */
    public function hasTargetNamespace(): bool
    {
        return $this->targetNamespace;
    }
    
    /**
     * Indicates whether entities that are not qualified with a namespace can 
     * be present.
     * 
     * @return  bool    TRUE if entities that are not qualified with a namespace can be present, otherwise FALSE.
     */
    public function hasLocal(): bool
    {
        return $this->local;
    }
    
    /**
     * Adds the specified URI reference to the list of the namespaces that 
     * can be present.
     * 
     * @param   AnyUriType  $namespace  The URI reference of namespace to add.
     */
    private function addNamespace(AnyUriType $namespace): void
    {
        $this->namespaces[] = $namespace;
    }
    
    /**
     * Returns all the URI references of namespaces that can be present.
     * 
     * @return  AnyUriType[]    An indexed array of AnyUriType instances.
     */
    public function getNamespaces(): array
    {
        return $this->namespaces;
    }
}
