<?php

namespace VV\T3imagealternative\EventListener;

use TYPO3\CMS\Core\Configuration\Event\AfterTcaCompilationEvent;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use VV\T3imagealternative\Evaluation\ImageAlternative;

class RegisterTca
{
    public function __invoke(AfterTcaCompilationEvent $event): void
    {
        $tca = $event->getTca();

        // Automatically inject the custom ImageAlternative evaluation
        ArrayUtility::mergeRecursiveWithOverrule($tca['sys_file_reference'], [
            'columns' => [
                'alternative' => [
                    'config' => [
                        'eval' => ImageAlternative::class,
                    ],
                ],
            ],
        ]);

        $event->setTca($tca);
    }
}
