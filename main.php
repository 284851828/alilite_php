<?php

require_once 'GatewaySdk.php';

$appId = "999999"; //   App ID  向客户经理申请

$sdk = new GatewaySdk($appId);

$payload = [
    'timestamp' => 1711347382,
    'content' => [
        'extTradeNo' => '1711347382',
        'redirectUrl' => 'https://host/your_success_webpage.php',  //回跳地址
        'company' => [
            'id' => 'cnogda7i2dkqvfosk',  //收款公司信息
            'name' => '浙江某科技有限公司',
        ],
        'customer' => [
            'extId' => 'user_002',  //付款用户信息
            'name' => '张某',  //付款用户信息
            'addr' => '杭州市西湖区', //付款用户信息
            'phone' => '13958040000', //付款用户信息
            'idCard' => '331002190000000', //付款用户信息，支付宝用此帐号签约收款
        ],
        'product' => [
            'extId' => 'product_002', //产品信息，
            'name' => '恰恰香瓜子',  
            'price' => '1.00',
            'Content' => '好吃',
        ],
        'installment' => [   //付款信息，
            'limit' => 1.00, //总金额
            'first' => 0.01, //暂无效
            'num' => 2,      //分2个月支付
            'type' => 'SDI', //固定
        ],
    ],
];

try {
    $sdk->post('gate/liteContract/create', $payload);
    echo "POST request successful.\n";
} catch (\RuntimeException $e) {
    echo "Failed to send POST request: " . $e->getMessage() . "\n";
}