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
- [ ] Parse **simpleType** elements.
- [ ] Parse **complexType** elements.
- [ ] Parse **group** elements.
- [ ] Parse **attributeGroup** elements.
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
- [ ] Parse **list** element.
- [ ] Parse **union** element.

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
- [ ] Parse **maxExclusive** elements.
- [ ] Parse **maxInclusive** elements.
- [ ] Parse **totalDigits** elements.
- [ ] Parse **fractionDigits** elements.
- [ ] Parse **length** elements.
- [ ] Parse **minLength** elements.
- [ ] Parse **maxLength** elements.
- [ ] Parse **enumeration** elements.
- [ ] Parse **whiteSpace** elements.
- [ ] Parse **pattern** elements.

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
- [ ] Parse **value** attribute.
- [x] Attributes are not supported.
- [ ] Parse **annotation** element.

