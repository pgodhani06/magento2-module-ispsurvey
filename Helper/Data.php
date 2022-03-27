<?php
/**
 * Copyright © Parth. All rights reserved.
 */
namespace Kemana\IspSurvey\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    protected $customerRepositoryInterface;

    /**
     * @param \Magento\Customer\Model\Session $customerSession,
     * @param \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface
     */
    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface
    ) {
        $this->_customersession = $customerSession;
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
    }

    /**
     * Check Customer is Allow to Detect Isp or not
     *
     * @return string
     */
    public function isAllowDetectIsp()
    {
        $allowIsp = false;
        if ($this->_customersession->isLoggedIn()) {
            $customer = $this->_customerRepositoryInterface->getById($this->_customersession->getId());
            if ($customer !== null && $customer->getId() && $customer->getCustomAttribute('allow_detect_isp')) {
                $allowIsp = (boolean)$customer->getCustomAttribute('allow_detect_isp')->getValue();
            }
        }
        return $allowIsp;
    }
}
