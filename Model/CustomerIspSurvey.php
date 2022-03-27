<?php
/**
 * Copyright © Parth. All rights reserved.
 */
namespace Kemana\IspSurvey\Model;

use Psr\Log\LoggerInterface;

class CustomerIspSurvey
{

    const ISP_FIELD_NAME = 'isp';
    const IS_SATISFIED_FIELD_NAME = 'is_satisfied';

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var \Magento\Quote\Model\QuoteRepository
     */
    protected $quoteRepository;

    /**
     * @param \Magento\Quote\Model\QuoteRepository $quoteRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        LoggerInterface $logger
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->logger = $logger;
    }
    /**
     * @inheritdoc
     */
    public function getPost($cartId, $isSatisfied, $isp)
    {
        $response = ['success' => false];
        try {
            $quote = $this->quoteRepository->getActive($cartId);// Your Code here
            $quote->setIsp($isp);
            $quote->setIsSatisfied($isSatisfied);
            $quote->save();
            $response = ['success' => true, 'cartId' => $quote->getId()];
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
            $this->logger->info($e->getMessage());
        }
        $returnArray = json_encode($response);
        return $returnArray;
    }
}
