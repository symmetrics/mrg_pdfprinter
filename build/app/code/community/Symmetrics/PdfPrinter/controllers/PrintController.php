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

/**
 * Print controller
 *
 * @category  Symmetrics
 * @package   Symmetrics_PdfPrinter
 * @author    symmetrics gmbh <info@symmetrics.de>
 * @author    Eric Reiche <er@symmetrics.de>
 * @copyright 2010 symmetrics gmbh
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.symmetrics.de/
 */
class Symmetrics_PdfPrinter_PrintController extends Mage_Core_Controller_Front_Action
{
    /**
     * Index action of print controller
     */
    public function indexAction()
    {
        $pageIdentifier = $this->_getRequest()->getParam('identifier');
        
        $cmsPage = $this->getHelper()->getPage($pageIdentifier);
        $pdfCache = $this->getHelper()->checkCache($cmsPage);
        if ($pdfCache === false) {
            $content = $cmsPage->getContent();
            $processor = Mage::getModel('cms/template_filter');
            $html = $processor->filter($content);
            $this->getHelper()->htmlToPdf($html);
        } else {
            var_dump($pdfCache);
            die();
        }
    }
    
    /**
     * Return helper object
     * 
     * @return Symmetrics_PdfPrinter_Helper_Data
     */
    public function getHelper()
    {
        return Mage::helper('pdfprinter');
    }
}