<?php
require_once './http.php';

class TossBilling
{
    /**
     *
     * customerKey로 카드 빌링키 발급
     *
     * @param $customerKey
     * @param $cardNumber
     * @param $cardExpirationYear
     * @param $cardExpirationMonth
     * @param $cardPassword
     * @param $customerIdentityNumber
     * @return mixed
     */
    public static function createKey($customerKey, $cardNumber, $cardExpirationYear, $cardExpirationMonth, $cardPassword, $customerIdentityNumber)
    {
        $url = 'https://api.tosspayments.com/v1/billing/authorizations/card';
        $data = [
            'customerKey' => $customerKey,
            'cardNumber' => $cardNumber,
            'cardExpirationYear' => $cardExpirationYear,
            'cardExpirationMonth' => $cardExpirationMonth,
            'cardPassword' => $cardPassword,
            'customerIdentityNumber' => $customerIdentityNumber
        ];

        return Http::request($url, 'POST', $data);
    }

    /**
     *
     * 카드 자동결제 승인
     *
     * @param $billingKey
     * @param $customerKey
     * @param $amount
     * @param $orderId
     * @param $orderName
     * @param $customerEmail
     * @param $customerName
     * @param $taxFreeAmount
     * @param $taxExemptionAmount
     */
    public static function approve($billingKey, $customerKey, $amount, $orderId, $orderName, $customerEmail, $customerName, $taxFreeAmount, $taxExemptionAmount)
    {
        $url = 'https://api.tosspayments.com/v1/billing/' . $billingKey;
        $data = [
            'customerKey' => $customerKey,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderName' => $orderName,
            'customerEmail' => $customerEmail,
            'customerName' => $customerName,
            'taxFreeAmount' => $taxFreeAmount,
            'taxExemptionAmount' => $taxExemptionAmount
        ];

        return Http::request($url, 'POST', $data);
    }
}