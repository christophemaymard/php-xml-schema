# Parser

## Element: "schema"

```
<schema
  attributeFormDefault = (qualified | unqualified)
  blockDefault = (#all | List of (extension | restriction | substitution))
  elementFormDefault = (qualified | unqualified)
  finalDefault = (#all | List of (extension | restriction | list | union))
  id = ID
  targetNamespace = anyURI
  version = token
  xml:lang = language
>
  Content: ((include | import | redefine | annotation)*, (((simpleType | complexType | group | attributeGroup) | element | attribute | notation), annotation*)*)
</schema>
```

- [x] Parse **schema** element.
- [x] Parse **attributeFormDefault** attribute.
- [x] Parse **blockDefault** attribute (collapsing white spaces).
- [x] Parse **elementFormDefault** attribute.
- [x] Parse **finalDefault** attribute (collapsing white spaces).
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **targetNamespace** attribute (collapsing white spaces).
- [x] Parse **version** attribute (collapsing white spaces).
- [x] Parse **xml:lang** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **include** elements.
- [x] Parse **import** elements.
- [ ] Parse **redefine** elements.
- [x] Parse **annotation** elements (composition).
- [x] Parse **simpleType** elements (topLevelSimpleType).
- [x] Parse **complexType** elements (topLevelComplexType).
- [x] Parse **group** elements (namedGroup).
- [x] Parse **attributeGroup** elements (namedAttributeGroup).
- [ ] Parse **element** elements.
- [x] Parse **attribute** elements (topLevelAttributeType).
- [x] Parse **notation** elements.
- [x] Parse **annotation** elements (definition).

## Element: "annotation"

```
<annotation
  id = ID
>
  Content: (appinfo | documentation)*
</annotation>
```

- [x] Parse **annotation** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **appinfo** elements.
- [x] Parse **documentation** elements.

## Element: "appinfo"

```
<appinfo
  source = anyURI
>
  Content: ({any})*
</appinfo>
```

- [x] Parse **appinfo** element.
- [x] Parse **source** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse content.

## Element: "documentation"

```
<documentation
  source = anyURI
  xml:lang = language
>
  Content: ({any})*
</documentation>
```

- [x] Parse **documentation** element.
- [x] Parse **source** attribute (collapsing white spaces).
- [x] Parse **xml:lang** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse content.

## Element: "import"

```
<import
  id = ID
  namespace = anyURI
  schemaLocation = anyURI
>
  Content: (annotation?)
</import>
```

- [x] Parse **import** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **namespace** attribute (collapsing white spaces).
- [x] Parse **schemaLocation** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "include"

```
<include
  id = ID
  schemaLocation = anyURI
>
  Content: (annotation?)
</include>
```

- [x] Parse **include** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **schemaLocation** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "notation"

```
<notation
  id = ID
  name = NCName
  public = token
  system = anyURI
>
  Content: (annotation?)
</notation>
```

- [x] Parse **notation** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **name** attribute (collapsing white spaces).
- [x] Parse **public** attribute (collapsing white spaces).
- [x] Parse **system** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "attributeGroup" (namedAttributeGroup)

```
<attributeGroup
  id = ID
  name = NCName
>
  Content: (annotation?, ((attribute | attributeGroup)*, anyAttribute?))
</attributeGroup>
```

- [x] Parse **attributeGroup** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **name** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **attribute** elements (attribute).
- [x] Parse **attributeGroup** elements (attributeGroupRef).
- [x] Parse **anyAttribute** element.

## Element: "attributeGroup" (attributeGroupRef)

```
<attributeGroup
  id = ID
  ref = QName
>
  Content: (annotation?)
</attributeGroup>
```

- [x] Parse **attributeGroup** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **ref** attribute (collapsing white spaces).
- [x] Attributes are not supported.
- [x] Parse **annotation** element.

## Element: "attribute" (topLevelAttributeType)

```
<attribute
  default = string
  fixed = string
  id = ID
  name = NCName
  type = QName
>
  Content: (annotation?, simpleType?)
</attribute>
```

- [x] Parse **attribute** element.
- [x] Parse **default** attribute.
- [x] Parse **fixed** attribute.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **name** attribute (collapsing white spaces).
- [x] Parse **type** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **simpleType** element (localSimpleType).

## Element: "attribute" (attribute)

```
<attribute
  default = string
  fixed = string
  form = (qualified | unqualified)
  id = ID
  name = NCName
  ref = QName
  type = QName
  use = (optional | prohibited | required)
>
  Content: (annotation?, simpleType?)
</attribute>
```

- [x] Parse **attribute** element.
- [x] Parse **default** attribute.
- [x] Parse **fixed** attribute.
- [x] Parse **form** attribute.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **name** attribute (collapsing white spaces).
- [x] Parse **ref** attribute (collapsing white spaces).
- [x] Parse **type** attribute (collapsing white spaces).
- [x] Parse **use** attribute.
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **simpleType** element (localSimpleType).

## Element: "anyAttribute"

```
<anyAttribute
  id = ID
  namespace = ((##any | ##other) | List of (anyURI | (##targetNamespace | ##local)))
  processContents = (lax | skip | strict)
>
  Content: (annotation?)
</anyAttribute>
```

- [x] Parse **anyAttribute** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **namespace** attribute (collapsing white spaces).
- [x] Parse **processContents** attribute.
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "simpleType" (topLevelSimpleType)

```
<simpleType
  final = (#all | List of (list | union | restriction))
  id = ID
  name = NCName
>
  Content: (annotation?, (restriction | list | union))
</simpleType>
```

- [x] Parse **simpleType** element.
- [x] Parse **final** attribute (collapsing white spaces).
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **name** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **restriction** element (anonymous).
- [x] Parse **list** element.
- [x] Parse **union** element.

## Element: "simpleType" (localSimpleType)

```
<simpleType
  id = ID
>
  Content: (annotation?, (restriction | list | union))
</simpleType>
```

- [x] Parse **simpleType** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **restriction** element (anonymous).
- [x] Parse **list** element.
- [x] Parse **union** element.

## Element: "restriction" (anonymous)

```
<restriction
  base = QName
  id = ID
>
  Content: (annotation?, (simpleType?, (minExclusive | minInclusive | maxExclusive | maxInclusive | totalDigits | fractionDigits | length | minLength | maxLength | enumeration | whiteSpace | pattern)*))
</restriction>
```

- [x] Parse **restriction** element.
- [x] Parse **base** attribute (collapsing white spaces).
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **simpleType** element (localSimpleType).
- [x] Parse **minExclusive** elements.
- [x] Parse **minInclusive** elements.
- [x] Parse **maxExclusive** elements.
- [x] Parse **maxInclusive** elements.
- [x] Parse **totalDigits** elements.
- [x] Parse **fractionDigits** elements.
- [x] Parse **length** elements.
- [x] Parse **minLength** elements.
- [x] Parse **maxLength** elements.
- [x] Parse **enumeration** elements.
- [x] Parse **whiteSpace** elements.
- [x] Parse **pattern** elements.

## Element: "list"

```
<list
  id = ID
  itemType = QName
>
  Content: (annotation?, simpleType?)
</list>
```

- [x] Parse **list** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **itemType** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **simpleType** element (localSimpleType).

## Element: "union"

```
<union
  id = ID
  memberTypes = List of QName
>
  Content: (annotation?, simpleType*)
</union>
```

- [x] Parse **union** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **memberTypes** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **simpleType** elements (localSimpleType).

## Element: "complexType" (topLevelComplexType)

```
<complexType
  abstract = boolean
  block = (#all | List of (extension | restriction))
  final = (#all | List of (extension | restriction))
  id = ID
  mixed = boolean
  name = NCName
>
  Content: (annotation?, (simpleContent | complexContent | ((group | all | choice | sequence)?, ((attribute | attributeGroup)*, anyAttribute?))))
</complexType>
```

- [x] Parse **complexType** element.
- [x] Parse **abstract** attribute (collapsing white spaces).
- [x] Parse **block** attribute (collapsing white spaces).
- [x] Parse **final** attribute (collapsing white spaces).
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **mixed** attribute (collapsing white spaces).
- [x] Parse **name** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **simpleContent** element.
- [x] Parse **complexContent** element.
- [x] Parse **group** element (groupRef).
- [x] Parse **all** element (all).
- [x] Parse **choice** element (explicitGroup).
- [x] Parse **sequence** element (explicitGroup).
- [x] Parse **attribute** elements (attribute).
- [x] Parse **attributeGroup** elements (attributeGroupRef).
- [x] Parse **anyAttribute** element.

## Element: "complexType" (localComplexType)

```
<complexType
  id = ID
  mixed = boolean
>
  Content: (annotation?, (simpleContent | complexContent | ((group | all | choice | sequence)?, ((attribute | attributeGroup)*, anyAttribute?))))
</complexType>
```

- [x] Parse **complexType** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **mixed** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **simpleContent** element.
- [x] Parse **complexContent** element.
- [x] Parse **group** element (groupRef).
- [x] Parse **all** element (all).
- [x] Parse **choice** element (explicitGroup).
- [x] Parse **sequence** element (explicitGroup).
- [x] Parse **attribute** elements (attribute).
- [x] Parse **attributeGroup** elements (attributeGroupRef).
- [x] Parse **anyAttribute** element.

## Element: "simpleContent"

```
<simpleContent
  id = ID
>
  Content: (annotation?, (restriction | extension))
</simpleContent>
```

- [x] Parse **simpleContent** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **restriction** element (simpleRestrictionType).
- [x] Parse **extension** element (simpleExtensionType).

## Element: "restriction" (simpleRestrictionType)

```
<restriction
  base = QName
  id = ID
>
  Content: (annotation?, (simpleType?, (minExclusive | minInclusive | maxExclusive | maxInclusive | totalDigits | fractionDigits | length | minLength | maxLength | enumeration | whiteSpace | pattern)*)?, ((attribute | attributeGroup)*, anyAttribute?))
</restriction>
```

- [x] Parse **restriction** element.
- [x] Parse **base** attribute (collapsing white spaces).
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **simpleType** element (localSimpleType).
- [x] Parse **minExclusive** elements.
- [x] Parse **minInclusive** elements.
- [x] Parse **maxExclusive** elements.
- [x] Parse **maxInclusive** elements.
- [x] Parse **totalDigits** elements.
- [x] Parse **fractionDigits** elements.
- [x] Parse **length** elements.
- [x] Parse **minLength** elements.
- [x] Parse **maxLength** elements.
- [x] Parse **enumeration** elements.
- [x] Parse **whiteSpace** elements.
- [x] Parse **pattern** elements.
- [x] Parse **attribute** elements (attribute).
- [x] Parse **attributeGroup** elements (attributeGroupRef).
- [x] Parse **anyAttribute** element.

## Element: "extension" (simpleExtensionType)

```
<extension
  base = QName
  id = ID
>
  Content: (annotation?, ((attribute | attributeGroup)*, anyAttribute?))
</extension>
```

- [x] Parse **restriction** element.
- [x] Parse **base** attribute (collapsing white spaces).
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **attribute** elements (attribute).
- [x] Parse **attributeGroup** elements (attributeGroupRef).
- [x] Parse **anyAttribute** element.

## Element: "complexContent"

```
<complexContent
  id = ID
  mixed = boolean
>
  Content: (annotation?, (restriction | extension))
</complexContent>
```

- [x] Parse **complexContent** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **mixed** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **restriction** element (complexRestrictionType).
- [x] Parse **extension** element (extensionType).

## Element: "restriction" (complexRestrictionType)

```
<restriction
  base = QName
  id = ID
>
  Content: (annotation?, (group | all | choice | sequence)?, ((attribute | attributeGroup)*, anyAttribute?))
</restriction>
```

- [x] Parse **restriction** element.
- [x] Parse **base** attribute (collapsing white spaces).
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **group** element (groupRef).
- [x] Parse **all** element (all).
- [x] Parse **choice** element (explicitGroup).
- [x] Parse **sequence** element (explicitGroup).
- [x] Parse **attribute** elements (attribute).
- [x] Parse **attributeGroup** elements (attributeGroupRef).
- [x] Parse **anyAttribute** element.

## Element: "extension" (extensionType)

```
<extension
  base = QName
  id = ID
>
  Content: (annotation?, (group | all | choice | sequence)?, ((attribute | attributeGroup)*, anyAttribute?))
</extension>
```

- [x] Parse **extension** element.
- [x] Parse **base** attribute (collapsing white spaces).
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **group** element (groupRef).
- [x] Parse **all** element (all).
- [x] Parse **choice** element (explicitGroup).
- [x] Parse **sequence** element (explicitGroup).
- [x] Parse **attribute** elements (attribute).
- [x] Parse **attributeGroup** elements (attributeGroupRef).
- [x] Parse **anyAttribute** element.

## Element: "group" (namedGroup)

```
<group
  id = ID
  name = NCName
>
  Content: (annotation?, (all | choice | sequence))
</group>
```

- [x] Parse **group** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **name** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **all** element (anonymous).
- [x] Parse **choice** element (simpleExplicitGroup).
- [x] Parse **sequence** element (simpleExplicitGroup).

## Element: "group" (groupRef)

```
<group
  id = ID
  maxOccurs = (nonNegativeInteger | unbounded)
  minOccurs = nonNegativeInteger
  ref = QName
>
  Content: (annotation?)
</group>
```

- [x] Parse **group** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **maxOccurs** attribute (collapsing white spaces).
- [x] Parse **minOccurs** attribute (collapsing white spaces).
- [x] Parse **ref** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "all" (all)

```
<all
  id = ID
  maxOccurs = 1
  minOccurs = (0 | 1)
>
  Content: (annotation?, element*)
</all>
```

- [x] Parse **all** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **maxOccurs** attribute (collapsing white spaces).
- [x] Parse **minOccurs** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **element** elements (narrowMaxMin).

## Element: "all" (anonymous)

```
<all
  id = ID
>
  Content: (annotation?, element*)
</all>
```

- [x] Parse **all** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **element** elements (narrowMaxMin).

## Element: "choice" (simpleExplicitGroup)

```
<choice
  id = ID
>
  Content: (annotation?, (element | group | choice | sequence | any)*)
</choice>
```

- [x] Parse **choice** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **element** elements (localElement).
- [x] Parse **group** elements (groupRef).
- [x] Parse **choice** elements (explicitGroup).
- [x] Parse **sequence** elements (explicitGroup).
- [x] Parse **any** elements.

## Element: "choice" (explicitGroup)

```
<choice
  id = ID
  maxOccurs = (nonNegativeInteger | unbounded)
  minOccurs = nonNegativeInteger
>
  Content: (annotation?, (element | group | choice | sequence | any)*)
</choice>
```

- [x] Parse **choice** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **maxOccurs** attribute (collapsing white spaces).
- [x] Parse **minOccurs** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **element** elements (localElement).
- [x] Parse **group** elements (groupRef).
- [x] Parse **choice** elements (explicitGroup).
- [x] Parse **sequence** elements (explicitGroup).
- [x] Parse **any** elements.

## Element: "sequence" (simpleExplicitGroup)

```
<sequence
  id = ID
>
  Content: (annotation?, (element | group | choice | sequence | any)*)
</sequence>
```

- [x] Parse **sequence** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **element** elements (localElement).
- [x] Parse **group** elements (groupRef).
- [ ] Parse **choice** elements (explicitGroup).
- [ ] Parse **sequence** elements (explicitGroup).
- [ ] Parse **any** elements.

## Element: "sequence" (explicitGroup)

```
<sequence
  id = ID
  maxOccurs = (nonNegativeInteger | unbounded)
  minOccurs = nonNegativeInteger
>
  Content: (annotation?, (element | group | choice | sequence | any)*)
</sequence>
```

- [x] Parse **sequence** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **maxOccurs** attribute (collapsing white spaces).
- [x] Parse **minOccurs** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **element** elements (localElement).
- [x] Parse **group** elements (groupRef).
- [x] Parse **choice** elements (explicitGroup).
- [x] Parse **sequence** elements (explicitGroup).
- [x] Parse **any** elements.

## Element: "any"

```
<any
  id = ID
  maxOccurs = (nonNegativeInteger | unbounded)
  minOccurs = nonNegativeInteger
  namespace = ((##any | ##other) | List of (anyURI | (##targetNamespace | ##local)))
  processContents = (lax | skip | strict)
>
  Content: (annotation?)
</any>
```

- [x] Parse **any** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **maxOccurs** attribute (collapsing white spaces).
- [x] Parse **minOccurs** attribute (collapsing white spaces).
- [x] Parse **namespace** attribute (collapsing white spaces).
- [x] Parse **processContents** attribute.
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "element" (narrowMaxMin)

```
<element
  block = (#all | List of (extension | restriction | substitution))
  default = string
  fixed = string
  form = (qualified | unqualified)
  id = ID
  maxOccurs = (0 | 1)
  minOccurs = (0 | 1)
  name = NCName
  nillable = boolean
  ref = QName
  type = QName
>
  Content: (annotation?, ((simpleType | complexType)?, (unique | key | keyref)*))
</element>
```

- [x] Parse **element** element.
- [x] Parse **block** attribute (collapsing white spaces).
- [x] Parse **default** attribute.
- [x] Parse **fixed** attribute.
- [x] Parse **form** attribute.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **maxOccurs** attribute (collapsing white spaces).
- [x] Parse **minOccurs** attribute (collapsing white spaces).
- [x] Parse **name** attribute (collapsing white spaces).
- [x] Parse **nillable** attribute (collapsing white spaces).
- [x] Parse **ref** attribute (collapsing white spaces).
- [x] Parse **type** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **simpleType** element (localSimpleType).
- [x] Parse **complexType** element (localComplexType).
- [x] Parse **unique** elements.
- [x] Parse **key** elements.
- [x] Parse **keyref** elements.

## Element: "element" (localElement)

```
<element
  block = (#all | List of (extension | restriction | substitution))
  default = string
  fixed = string
  form = (qualified | unqualified)
  id = ID
  maxOccurs = (nonNegativeInteger | unbounded)
  minOccurs = nonNegativeInteger
  name = NCName
  nillable = boolean
  ref = QName
  type = QName
>
  Content: (annotation?, ((simpleType | complexType)?, (unique | key | keyref)*))
</element>
```

- [x] Parse **element** element.
- [x] Parse **block** attribute (collapsing white spaces).
- [x] Parse **default** attribute.
- [x] Parse **fixed** attribute.
- [x] Parse **form** attribute.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **maxOccurs** attribute (collapsing white spaces).
- [x] Parse **minOccurs** attribute (collapsing white spaces).
- [x] Parse **name** attribute (collapsing white spaces).
- [x] Parse **nillable** attribute (collapsing white spaces).
- [x] Parse **ref** attribute (collapsing white spaces).
- [x] Parse **type** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **simpleType** element (localSimpleType).
- [x] Parse **complexType** element (localComplexType).
- [x] Parse **unique** elements.
- [x] Parse **key** elements.
- [x] Parse **keyref** elements.

## Element: "unique"

```
<unique
  id = ID
  name = NCName
>
  Content: (annotation?, (selector, field+))
</unique>
```

- [x] Parse **unique** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **name** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **selector** element.
- [x] Parse **field** elements.

## Element: "key"

```
<key
  id = ID
  name = NCName
>
  Content: (annotation?, (selector, field+))
</key>
```

- [x] Parse **key** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **name** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **selector** element.
- [x] Parse **field** elements.

## Element: "keyref"

```
<keyref
  id = ID
  name = NCName
  refer = QName
>
  Content: (annotation?, (selector, field+))
</keyref>
```

- [x] Parse **keyref** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **name** attribute (collapsing white spaces).
- [x] Parse **refer** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.
- [x] Parse **selector** element.
- [x] Parse **field** elements.

## Element: "selector"

```
<selector
  id = ID
  xpath = a subset of XPath expression
>
  Content: (annotation?)
</selector>
```

- [x] Parse **selector** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **xpath** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "field"

```
<field
  id = ID
  xpath = a subset of XPath expression
>
  Content: (annotation?)
</field>
```

- [x] Parse **field** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **xpath** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "minExclusive"

```
<minExclusive
  fixed = boolean
  id = ID
  value = anySimpleType
>
  Content: (annotation?)
</minExclusive>
```

- [x] Parse **minExclusive** element.
- [x] Parse **fixed** attribute (collapsing white spaces).
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **value** attribute.
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "minInclusive"

```
<minInclusive
  fixed = boolean
  id = ID
  value = anySimpleType
>
  Content: (annotation?)
</minInclusive>
```

- [x] Parse **minInclusive** element.
- [x] Parse **fixed** attribute (collapsing white spaces).
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **value** attribute.
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "maxExclusive"

```
<maxExclusive
  fixed = boolean
  id = ID
  value = anySimpleType
>
  Content: (annotation?)
</maxExclusive>
```

- [x] Parse **maxExclusive** element.
- [x] Parse **fixed** attribute (collapsing white spaces).
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **value** attribute.
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "maxInclusive"

```
<maxInclusive
  fixed = boolean
  id = ID
  value = anySimpleType
>
  Content: (annotation?)
</maxInclusive>
```

- [x] Parse **maxInclusive** element.
- [x] Parse **fixed** attribute (collapsing white spaces).
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **value** attribute.
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "totalDigits"

```
<totalDigits
  fixed = boolean
  id = ID
  value = positiveInteger
>
  Content: (annotation?)
</totalDigits>
```

- [x] Parse **totalDigits** element.
- [x] Parse **fixed** attribute (collapsing white spaces).
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **value** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "fractionDigits"

```
<fractionDigits
  fixed = boolean
  id = ID
  value = nonNegativeInteger
>
  Content: (annotation?)
</fractionDigits>
```

- [x] Parse **fractionDigits** element.
- [x] Parse **fixed** attribute (collapsing white spaces).
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **value** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "length"

```
<length
  fixed = boolean
  id = ID
  value = nonNegativeInteger
>
  Content: (annotation?)
</length>
```

- [x] Parse **length** element.
- [x] Parse **fixed** attribute (collapsing white spaces).
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **value** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "minLength"

```
<minLength
  fixed = boolean
  id = ID
  value = nonNegativeInteger
>
  Content: (annotation?)
</minLength>
```

- [x] Parse **minLength** element.
- [x] Parse **fixed** attribute (collapsing white spaces).
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **value** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "maxLength"

```
<maxLength
  fixed = boolean
  id = ID
  value = nonNegativeInteger
>
  Content: (annotation?)
</maxLength>
```

- [x] Parse **maxLength** element.
- [x] Parse **fixed** attribute (collapsing white spaces).
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **value** attribute (collapsing white spaces).
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "enumeration"

```
<enumeration
  id = ID
  value = anySimpleType
>
  Content: (annotation?)
</enumeration>
```

- [x] Parse **enumeration** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **value** attribute.
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "whiteSpace"

```
<whiteSpace
  fixed = boolean
  id = ID
  value = (collapse | preserve | replace)
>
  Content: (annotation?)
</whiteSpace>
```

- [x] Parse **whiteSpace** element.
- [x] Parse **fixed** attribute (collapsing white spaces).
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **value** attribute.
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

## Element: "pattern"

```
<pattern
  id = ID
  value = string
>
  Content: (annotation?)
</pattern>
```

- [x] Parse **pattern** element.
- [x] Parse **id** attribute (collapsing white spaces).
- [x] Parse **value** attribute.
- [x] Other attributes are not supported.
- [x] Parse **annotation** element.

