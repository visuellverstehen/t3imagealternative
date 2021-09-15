<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 't3imagealternative',
    'description' => 'This extension provides evaluation for image alternatives.',
    'category' => 'be',
    'author' => 'visuellverstehen',
    'author_email' => 'kontakt@visuellverstehen.de',
    'author_company' => 'visuellverstehen',
    'state' => 'stable',
    'version' => '1.0.0',
    'clearCacheOnLoad' => 0,
    'constraints' =>[
        'depends' => [
            'typo3' => '10.4.0 - 11.5.99'
        ],
    ]
];
