<?php

namespace VV\Hafenk\Evaluation;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ImageAlternative
{
    /**
     * @param string $value
     * @param string $is_in
     * @param bool $set
     *
     * @return string
     */
    public function evaluateFieldValue($value, $is_in, &$set): string
    {
        if ($value === '' && isset($_POST['data']['sys_file_reference'])) {

            // Check sys_file_references for non-empty alternative fields
            foreach ($_POST['data']['sys_file_reference'] as $index => $sysFileReference) {

                // Skip records with filled alternative field
                if ($sysFileReference['alternative'] !== '') {
                    continue;
                }

                $fileUid = (int) substr($sysFileReference['uid_local'], 9);
                $fileMetaData = $this->getMetaDataForFile($fileUid, $sysFileReference['sys_language_uid']);

                // Throw validation error for images without alternative filled via file list
                if ($fileMetaData['alternative'] === null && $_POST['data']['sys_file_reference'][$index]['hasError'] !== true) {
                    $this->renderFlashMessage();

                    // Set flag in order to skip existing errors in future loops
                    $_POST['data']['sys_file_reference'][$index]['hasError'] = true;

                    // Prevent saving the image
                    $set = false;
                }
            }
        }

        return $value;
    }

    /**
     * Get the meta data record for the given file UID
     *
     * @param int $fileUid The UID of the sys_file record
     *
     * @return array
     */
    protected function getMetaDataForFile(int $fileUid, int $sysLanguageUid = 0): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('sys_file_metadata');

        $fileMetaData = $queryBuilder
            ->select('*')
            ->from('sys_file_metadata')
            ->where(
                $queryBuilder->expr()->eq(
                    'file',
                    $queryBuilder->createNamedParameter($fileUid, \PDO::PARAM_INT)
                ),
                $queryBuilder->expr()->eq(
                    'sys_language_uid',
                    $queryBuilder->createNamedParameter($sysLanguageUid, \PDO::PARAM_INT)
                )
            )
            ->execute()
            ->fetch();

        if ($fileMetaData) {
            return $fileMetaData;
        }

        return [];
    }

    /**
     * Renders a flash message to inform the user that an alternative
     * text for an image is missing.
     *
     * @return void
     */
    protected function renderFlashMessage(): void
    {
        $messageQueue = (GeneralUtility::makeInstance(FlashMessageService::class))
            ->getMessageQueueByIdentifier();

        $message = GeneralUtility::makeInstance(
            FlashMessage::class,
            'Please be sure to add an alternative value for images',
            'Watch out',
            FlashMessage::WARNING
        );

        $messageQueue->enqueue($message);
    }
}
