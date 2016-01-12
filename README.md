# SilverStripe Relationship Permission Sources

## Requirements

 * SilverStripe ^3.2

## Installation

The recommended way to install the module is via composer

```
composer require marketo/silverstripe-relationship-permissions:dev-master
```

If you aren't using composer, pull down the code into its own directory.

## Examples

To add this to a Page object, you can put the following code into your YAML configuration.

```
MyDataObjectType:
  extensions:
    - RelationshipPermissionExtension('RelationshipName')
```

The passed in argument should be the name of the relationship (has_one, many_many, etc) 
to find an object that has the relevant permission. 

------

## Limitations

If the data object type does _not_ make use of the usual _canXXX_ extension mechanism,
then the extension will have _NO_ effect. This extension is best used on data object types
that either do not define the _canXXX_ set of methods, or call `parent::canXXX`.


Run a `dev/build?flush=1` to flush the config manifests to enable the new configuration.

## License

See [License](LICENSE.md)

## Maintainers

* Marcus Nyeholt <marcus@silverstripe.com.au>
 