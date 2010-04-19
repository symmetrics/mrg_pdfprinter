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
 * Default helper class
 *
 * @category  Symmetrics
 * @package   Symmetrics_PdfPrinter
 * @author    symmetrics gmbh <info@symmetrics.de>
 * @author    Eric Reiche <er@symmetrics.de>
 * @copyright 2010 symmetrics gmbh
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.symmetrics.de/
 */
class Symmetrics_PdfPrinter_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @const string PDFPRINTER_CACHE_DIR cache directory under media dir
     */
    const PDFPRINTER_CACHE_DIR = 'pdfprinter';
    
    /**
     * @const string FILE_EXTENSION extension for PDF files
     */
    const FILE_EXTENSION = '.pdf';
    
    /**
     * Get cms page by identifier
     * 
     * @param string $identifier CMS page identifier
     * 
     * @return Mage_Cms_Model_Page
     */
    public function getPage($identifier)
    {
        $pageModel = Mage::getModel('cms/page');
        $pageId = $pageModel->checkIdentifier($identifier, $this->getStoreId());
        $pageModel->load($pageId);
        
        return $pageModel;
    }
    
    /**
     * Get currently selected store
     * 
     * @return Mage_Core_Model_Store
     */
    public function getStore()
    {
        return Mage::app()->getStore();
    }
    
    /**
     * Get id of current store
     * 
     * @return int
     */
    public function getStoreId()
    {
        return $this->getStore()->getId();
    }
    
    /**
     * Get request object
     * 
     * @return mixed
     */
    public function getRequest()
    {
        return Mage::app()->getRequest();
    }
    
    /**
     * Get pdf cache dir
     * 
     * @return string
     */
    public function getCacheDir()
    {
        return Mage::getBaseDir('media') . DS . self::PDFPRINTER_CACHE_DIR . DS;
    }
    
    /**
     * Check if cms page is already cached
     * 
     * @param Mage_Cms_Model_Page $cmsPage CMS page object
     * 
     * @return bool|string
     */
    public function checkCache($cmsPage)
    {
        $updated = $this->convertToUts($cmsPage->getUpdateTime());
        $pageName = $cmsPage->getIdentifier();
        $cacheDir = $this->getCacheDir();
        $fileName = $cacheDir . 'page_' . $pageName . '_' . $updated . self::FILE_EXTENSION;
        if (file_exists($fileName)) {
            
            return $fileName;
        }
        
        return false;
    }
    
    /**
     * Generate pdf from html
     * 
     * @param string $html content to convert
     * 
     * @return binary (PDF content)
     */
    public function htmlToPdf($html)
    {
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->render();
        
        return $dompdf->output();
    }
    
    /**
     * Cache pdf file for future use
     * 
     * @param Mage_Cms_Model_Page $cmsPage CMS page object
     * @param binary              $pdf     PDF content
     * @param string              $type    page|block
     * 
     * @return bool
     */
    public function cachePdf($cmsPage, $pdf, $type='page')
    {
        $updated = $this->convertToUts($cmsPage->getUpdateTime());
        $pageName = $cmsPage->getIdentifier();
        $cacheDir = $this->getCacheDir();
        $fileName = $cacheDir . $type . '_' . $pageName . '_' . $updated . self::FILE_EXTENSION;
        if (file_exists($fileName)) {
            
            return false;
        }
        file_put_contents($fileName, $pdf);
    }
    
    /**
     * Convert a datetime string to unix timestamp
     * 
     * @param string $timeString datetime in internal format
     * 
     * @return int
     */
    public function convertToUts($timeString)
    {
        $zendDate = new Zend_Date($timeString, Varien_Date::DATETIME_INTERNAL_FORMAT);
        $timeUts = $zendDate->toString(Zend_Date::TIMESTAMP);
        
        return $timeUts;
    }
}