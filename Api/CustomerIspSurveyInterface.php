<?php
/**
 * Copyright © Parth. All rights reserved.
 */
namespace Kemana\IspSurvey\Api;

interface CustomerIspSurveyInterface
{
    /**
     * GET for Post api
     * @param string $cartId
     * @param string $isSatisfied
     * @param string $isp
     * @return string
     */
    public function getPost($cartId, $isSatisfied, $isp);
}
