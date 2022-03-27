<?php
/**
 * Copyright © Parth. All rights reserved.
 */
namespace Kemana\IspSurvey\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Kemana\IspSurvey\Model\CustomerIspSurvey;

class AddIspToOrder implements ObserverInterface
{
    /**
     * @var \Kemana\IspSurvey\Helper\Data
     */
    protected $helper;

    /**
     * @param \Kemana\IspSurvey\Helper\Data $helper
     */
    public function __construct(
        \Kemana\IspSurvey\Helper\Data $helper
    ) {
        $this->_helper = $helper;
    }

    /**
     * Add Isp to Order
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        if ($this->_helper->isAllowDetectIsp()) {
            $order = $observer->getEvent()->getOrder();
            /** @var $order \Magento\Sales\Model\Order **/

            $quote = $observer->getEvent()->getQuote();
            /** @var $quote \Magento\Quote\Model\Quote **/

            $order->setData(
                CustomerIspSurvey::ISP_FIELD_NAME,
                $quote->getData(CustomerIspSurvey::ISP_FIELD_NAME)
            );

            $order->setData(
                CustomerIspSurvey::IS_SATISFIED_FIELD_NAME,
                $quote->getData(CustomerIspSurvey::IS_SATISFIED_FIELD_NAME)
            );
        }
    }
}
