<?php
/**
 * Zitec_Dpd – shipping carrier extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Zitec
 * @package    Zitec_Dpd
 * @copyright  Copyright (c) 2014 Zitec COM
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 *
 * @category   Zitec
 * @package    Zitec_Dpd
 * @author     Zitec COM <magento@zitec.ro>
 */
class Zitec_Dpd_Model_Observer_Pickup
{

    public function createPickupAction(Varien_Event_Observer $observer)
    {
        return;
        if (!$this->_getHelper()->moduleIsActive()) {
            return;
        }
        $block = $observer->getEvent()->getBlock();
        if ($block instanceof Mage_Adminhtml_Block_Widget_Grid_Massaction
            && (($block->getRequest()->getControllerName() == 'sales_shipment'))
        ) {
            $block->addItem('create_dpd_pickup', array(
                'label'      => $this->_getHelper()->__('Arrange DPD Pickup'),
                'url'        => Mage::helper("adminhtml")->getUrl('zitec_dpd/adminhtml_shipment/createpickup'),
                'additional' => array(
                    'zitec_dpd_pickup_date'        => array(
                        'name'  => 'zitec_dpd_pickup_date',
                        'type'  => 'text',
                        'class' => 'required-entry',
                        'label' => Mage::helper('index')->__('Date (DD/MM/YYYY)')
                    ),
                    'zitec_dpd_pickup_from'        => array(
                        'name'  => 'zitec_dpd_pickup_from',
                        'type'  => 'time',
                        'class' => 'required-entry',
                        'label' => Mage::helper('index')->__('Between')
                    ),
                    'zitec_dpd_pickup_to'          => array(
                        'name'  => 'zitec_dpd_pickup_to',
                        'type'  => 'time',
                        'class' => 'required-entry',
                        'label' => Mage::helper('index')->__('and')
                    ),
                    'zitec_dpd_pickup_instruction' => array(
                        'name'  => 'zitec_dpd_pickup_instruction',
                        'type'  => 'text',
                        'label' => Mage::helper('index')->__('Instructions')
                    ),
                )
            ));
        }
    }

    /**
     *
     * @return Zitec_Dpd_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('zitec_dpd');
    }

}


