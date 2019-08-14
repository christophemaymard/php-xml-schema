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
- [ ] Parse **attribute** elements.
- [ ] Parse **notation** elements.
- [ ] Parse **annotation** elements (definition).

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
- [x] Others attributes are not supported.
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
- [x] Others attributes are not supported.
- [ ] Parse **annotation** element.
