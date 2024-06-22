<?php
require_once './http.php';

class Toss
{
    /**
     * 결제 승인
     */
    public static function confirm($paymentKey, $orderId, $amount)
    {
        $url = 'https://api.tosspayments.com/v1/payments/confirm';
        $data = ['paymentKey' => $paymentKey, 'orderId' => $orderId, 'amount' => $amount];

        return Http::request($url, 'POST', $data);
    }

    /**
     * 결제 취소
     * @param $paymentKey
     * @param $reason
     * @return mixed
     */
    public static function cancel($paymentKey, $reason)
    {
        $url = 'https://api.tosspayments.com/v1/payments/' . $paymentKey . '/cancel';
        $data = ['cancelReason' => $reason];
        return Http::request($url, 'POST', $data);
    }

    /**
     * 결제 조회
     * @param $paymentKey
     * @return mixed
     */
    public static function checkByPaymentKey($paymentKey)
    {
        $url = 'https://api.tosspayments.com/v1/payments/' . $paymentKey;
        return Http::request($url);
    }

    public static function checkByOrderId($orderId)
    {
        $url = 'https://api.tosspayments.com/v1/payments/orders/' . $orderId;
        return Http::request($url);
    }

    public static function createVirtualAccount($amount, $orderId, $orderName, $customerName, $bank)
    {
        $url = 'https://api.tosspayments.com/v1/virtual-accounts';
        $data = [
            'amount' => $amount,
            'orderId' => $orderId,
            'orderName' => $orderName,
            'customerName' => $customerName,
            'bank' => $bank
        ];
        return Http::request($url, 'POST', $data);
    }

    /**
     * 현금영수증 발급 요청
     * @param $amount
     * @param $orderId
     * @param $orderName
     * @param $customerIdentityNumber
     * @param $type
     * @return mixed
     */
    public static function createCashReceipt($amount, $orderId, $orderName, $customerIdentityNumber, $type)
    {
        $url = 'https://api.tosspayments.com/v1/cash-receipts';
        $data = [
            'amount' => $amount,
            'orderId' => $orderId,
            'orderName' => $orderName,
            'customerIdentityNumber' => $customerIdentityNumber,
            'type' => $type
        ];
        return Http::request($url, 'POST', $data);
    }

    /**
     * 현금영수증 취소
     * @param $receiptKey
     * @return mixed
     */
    public static function cancelCashReceipt($receiptKey)
    {
        $url = 'https://api.tosspayments.com/v1/cash-receipts/' . $receiptKey . '/cancel';
        return Http::request($url, 'POST');
    }

    /**
     * 현금영수증 조회
     * @param $requestDate
     * @return mixed
     */
    public static function checkCashReceipt($requestDate)
    {
        $url = 'https://api.tosspayments.com/v1/cash-receipts?requestDate=' . $requestDate;
        return Http::request($url);
    }
}