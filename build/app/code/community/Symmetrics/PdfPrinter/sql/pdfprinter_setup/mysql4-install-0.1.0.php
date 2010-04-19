<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category  Symmetrics
 * @package   Symmetrics_PdfPrinter
 * @author    symmetrics gmbh <info@symmetrics.de>
 * @author    Eric Reiche <er@symmetrics.de>
 * @copyright 2010 symmetrics gmbh
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.symmetrics.de/
 */

$installer = $this;
$installer->startSetup();

define('PDFPRINTER_CACHE_DIR', Mage::getBaseDir('media') . DS . 'pdfprinter');

try {
    if (!is_dir(PDFPRINTER_CACHE_DIR)) {
        mkdir(PDFPRINTER_CACHE_DIR);
    }
    if (!is_writable(PDFPRINTER_CACHE_DIR)) {
        chmod(PDFPRINTER_CACHE_DIR, 0777);
    }
} catch(Eception $e) {
    throw new Exception(
        'Directory ' . PDFPRINTER_CACHE_DIR . ' is not writable or couldn\'t be
        created. Please do it manually.' . $e->getMessage()
    );
}

$installer->endSetup();