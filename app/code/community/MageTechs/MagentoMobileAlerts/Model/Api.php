<?php
/**
 * @package     MageTechs Magento Mobile Alerts
 * @author      MageTechs <support@MageTechs.com>
 * @copyright   Copyright (c) 2012 (http://www.MageTechs.com)
 */
class MageTechs_MagentoMobileAlerts_Model_Api extends Mage_Api_Model_Resource_Abstract
{
    public function getVisitors()
    {
        $collection = Mage::getModel('log/visitor_online')->prepare()->getCollection();
        $collection->addCustomerData();
        $tableName = Mage::getSingleton('core/resource')->getTableName('log_visitor_online');
        $db        = Mage::getSingleton('core/resource')->getConnection('core_read');
        $result    = $db->query("SELECT * FROM " . $tableName);
        if ($result) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
        }
        return $data;
    }
    
    public function getRecentSales()
    {
        $tableName = Mage::getSingleton('core/resource')->getTableName('sales_flat_order');
        $db        = Mage::getSingleton('core/resource')->getConnection('core_read');
        $result    = $db->query("SELECT * FROM " . $tableName . " ORDER BY increment_id DESC");
        if ($result) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
        }
        return $data;
    }
}
?>