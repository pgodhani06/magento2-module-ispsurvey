<?php
/**
 * Copyright © Parth. All rights reserved.
 */
namespace Kemana\IspSurvey\Model;

use \Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * CustomerIspSurveyConfig is used to add a checkoutconfig
 */
class CustomerIspSurveyConfig implements ConfigProviderInterface
{

   /**
    * @var \Magento\Store\Model\StoreManagerInterface
    */
    protected $storeManager;

    /**
     * @var \Kemana\IspSurvey\Helper\Data
     */
    protected $helper;

    /**
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Kemana\IspSurvey\Helper\Data $helper
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Kemana\IspSurvey\Helper\Data $helper
    ) {
        $this->storeManager = $storeManager;
        $this->_helper = $helper;
    }

   /**
    * @inheritdoc
    */
    public function getConfig()
    {
        $allowDetectIsp = $this->_helper->isAllowDetectIsp();
        $config['allow_detect_isp'] = $allowDetectIsp;
        return $config;
    }
}
