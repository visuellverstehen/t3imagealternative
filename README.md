# t3imagealternative

## Example

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
