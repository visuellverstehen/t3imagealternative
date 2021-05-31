# t3imagealternative

This extensions provides evaluation for image alternatives.

## Example

Override the eval option for the alternative column inside the sys_file_reference TCA configuration like the following:

```php
use TYPO3\CMS\Core\Utility\ArrayUtility;

ArrayUtility::mergeRecursiveWithOverrule($GLOBALS['TCA']['sys_file_reference'], [
    'columns' => [
        'alternative' => [
            'config' => [
                'eval' => \VV\T3imagealternative\Evaluation\ImageAlternative::class
            ]
        ]
    ]
]);
```
