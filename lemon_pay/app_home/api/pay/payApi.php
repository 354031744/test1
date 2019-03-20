<?php
include "../sign.php";

class LemonApi
{
    private $payMent = "";

    private $FAILED = "0";

    private $SUCCESS = "1";

    private $OTHER = "2";

    public function Pay()
    {
        $this->payMent = array_key_exists("pay_ment", $_POST) ? $_POST['pay_ment'] : "";

        switch ($this->payMent) {
            case 'SCAN':
                return $this->scanPay();
                break;
            case 'H5':
                //H5 跟扫码一致
                return $this->scanPay();
                break;
            case 'B2C':
                return $this->ebank();
                break;

            default:
                return $this->formatResult($this->FAILED, "参数错误", null, null);
                break;
        }
    }

    /**
     * H5支付接口
     * @return string
     */
    /*
    public function h5Pay()
    {
        $urlString = getenv('LEMON_API_IP') . "/v1/api/h5/pay";

        $interfaceVersion = array_key_exists("interface_version", $_POST) ? $_POST['interface_version'] : "";
        $merchantCode = array_key_exists("merchant_code", $_POST) ? $_POST['merchant_code'] : "";
        $amount = array_key_exists("amount", $_POST) ? $_POST['amount'] : "";
        $clientIp = array_key_exists("client_ip", $_POST) ? $_POST['client_ip'] : "";
        $notifyUrl = array_key_exists("notify_url", $_POST) ? $_POST['notify_url'] : "";
        $orderId = array_key_exists("order_id", $_POST) ? $_POST['order_id'] : "";
        $productDesc = array_key_exists("product_desc", $_POST) ? $_POST['product_desc'] : "";
        $productExt = array_key_exists("product_ext", $_POST) ? $_POST['product_ext'] : "";
        $productName = array_key_exists("product_name", $_POST) ? $_POST['product_name'] : "";
        $serviceType = array_key_exists("service_type", $_POST) ? $_POST['service_type'] : "";
        $signOfMerchant = array_key_exists("sign", $_POST) ? $_POST['sign'] : "";

        if ($amount == "" || $clientIp == "" || $notifyUrl == "" || $orderId == "" || $productName == ""
            || $serviceType == "" || $signOfMerchant == "")
            return '{"result":"0","message":"缺少必须参数"}';


        $key = $this->getMerchantKey($merchantCode);
        $oldServiceType = $this->changeServiceType($serviceType);
        if(null == $oldServiceType)
            return '{"result":"0","message":"service_type不存在"}';

        $checkSignByPhpDataArray = [];
        $dataArray = [];
        $dataArray ["amount"] = $amount;
        $checkSignByPhpDataArray["amount"]=$amount;
        $dataArray["clientIp"] = $clientIp;
        $checkSignByPhpDataArray["client_ip"] = $clientIp;
        $dataArray["interfaceVersion"] = $interfaceVersion;
        $checkSignByPhpDataArray["interface_version"] = $interfaceVersion;
        $dataArray["merchantCode"] = $merchantCode;
        $checkSignByPhpDataArray["merchant_code"] = $merchantCode;
        $dataArray["notifyUrl"] = $notifyUrl;
        $checkSignByPhpDataArray["notify_url"] = $notifyUrl;
        $dataArray["orderId"] = $orderId;
        $checkSignByPhpDataArray["order_id"] = $orderId;

        $checkSignByPhpDataArray["pay_ment"] = $this->pay_ment;
        if ($productDesc != ""){
            $dataArray["productDesc"] = $productDesc;
            $checkSignByPhpDataArray["product_desc"] = $productDesc;
        }
        if ($productExt != ""){
            $dataArray["productExt"] = $productExt;
            $checkSignByPhpDataArray["product_ext"] = $productExt;
        }
        $dataArray["productName"] = $productName;
        $checkSignByPhpDataArray["product_name"] = $productName;
        $dataArray["serviceType"] = $oldServiceType;
        $checkSignByPhpDataArray["service_type"] = $serviceType;
        //生成签名
        $signInPhp = Sign::productSign($checkSignByPhpDataArray, $key);
        if($signInPhp != $signOfMerchant)
            return '{"result":"0","message":"签名失败1"}';
        $sign = Sign::productSign($dataArray, $key);
        $dataArray["sign"] = $sign;

        $result = json_decode($this->postSend($urlString, $dataArray));

        if ($result->status == "SUCCESS")
            return '{"result":"1","message":"' . $result->payUrl . '"}';
        else
            return '{"result":"0","message":"' . $result->message . '"}';
    }
    */

    /**
     * 扫码支付接口
     * @return string
     */
    public function scanPay()
    {
        if ($this->payMent == "H5")
            $urlString = getenv('LEMON_API_IP') . "/v1/api/h5/pay";
        else
            $urlString = getenv('LEMON_API_IP') . "/v1/api/scancode/pay";

        $interfaceVersion = array_key_exists("interface_version", $_POST) ? $_POST['interface_version'] : "";
        $merchantCode = array_key_exists("merchant_code", $_POST) ? $_POST['merchant_code'] : "";
        $amount = array_key_exists("amount", $_POST) ? $_POST['amount'] : "";
        $clientIp = array_key_exists("client_ip", $_POST) ? $_POST['client_ip'] : "";
        $notifyUrl = array_key_exists("notify_url", $_POST) ? $_POST['notify_url'] : "";
        $orderId = array_key_exists("order_id", $_POST) ? $_POST['order_id'] : "";
        $productDesc = array_key_exists("product_desc", $_POST) ? $_POST['product_desc'] : "";
        $productExt = array_key_exists("product_ext", $_POST) ? $_POST['product_ext'] : "";
        $productName = array_key_exists("product_name", $_POST) ? $_POST['product_name'] : "";
        $serviceType = array_key_exists("service_type", $_POST) ? $_POST['service_type'] : "";
        $signOfMerchant = array_key_exists("sign", $_POST) ? $_POST['sign'] : "";

        if ($amount == "" || $clientIp == "" || $notifyUrl == "" || $orderId == "" || $productName == ""
            || $serviceType == "" || $signOfMerchant == "")
            return $this->formatResult($this->FAILED, "缺少必要参数", null, null);

        $oldServiceType = $this->changeServiceType($this->payMent, $serviceType);
        if (null == $oldServiceType)
            return $this->formatResult($this->FAILED, "service_type错误", null, null);

        $key = $this->getMerchantKey($merchantCode);
        if (null == $key)
            return $this->formatResult($this->FAILED, "商户号不存在！", null, null);

        $checkSignByPhpDataArray = [];
        $dataArray = [];
        $dataArray ["amount"] = $amount;
        $checkSignByPhpDataArray["amount"] = $amount;
        $dataArray["clientIp"] = $clientIp;
        $checkSignByPhpDataArray["client_ip"] = $clientIp;
        $dataArray["interfaceVersion"] = $interfaceVersion;
        $checkSignByPhpDataArray["interface_version"] = $interfaceVersion;
        $dataArray["merchantCode"] = $merchantCode;
        $checkSignByPhpDataArray["merchant_code"] = $merchantCode;
        $dataArray["notifyUrl"] = $notifyUrl;
        $checkSignByPhpDataArray["notify_url"] = $notifyUrl;
        $dataArray["orderId"] = $orderId;
        $checkSignByPhpDataArray["order_id"] = $orderId;

        $checkSignByPhpDataArray["pay_ment"] = $this->payMent;
        if ($productDesc != "") {
            $dataArray["productDesc"] = $productDesc;
            $checkSignByPhpDataArray["product_desc"] = $productDesc;
        }
        if ($productExt != "") {
            $dataArray["productExt"] = $productExt;
            $checkSignByPhpDataArray["product_ext"] = $productExt;
        }
        $dataArray["productName"] = $productName;
        $checkSignByPhpDataArray["product_name"] = $productName;
        $dataArray["serviceType"] = $oldServiceType;
        $checkSignByPhpDataArray["service_type"] = $serviceType;
        //生成签名
        $signInPhp = Sign::productSign($checkSignByPhpDataArray, $key);

        if ($signInPhp != $signOfMerchant)
            return $this->formatResult($this->FAILED, "签名错误1", null, $key);

        $sign = Sign::productSign($dataArray, $key);
        $dataArray["sign"] = $sign;

        $result = json_decode($this->postSend($urlString, $dataArray));
        //$result = json_decode($this->postSend("http://lemon.gzyunji.com/v1/api/scancode/pay", $dataArray));

        if (null == $result)
            return $this->formatResult($this->FAILED, "系统错误，请联系客服人员", null, $key);

        if ($result->status == "SUCCESS") {
            if ($this->payMent == "H5")
                return $this->formatResult($this->SUCCESS, "", $result->payUrl, $key);
            return $this->formatResult($this->SUCCESS, "", $result->qrCode, $key);
        }
        return $this->formatResult($this->FAILED, $result->message, null, $key);
    }

    public function ebank()
    {
        $urlString = getenv('LEMON_API_IP') . "/v1/api/ebank/pay";

        $amount = array_key_exists("amount", $_POST) ? $_POST['amount'] : "";
        $merchantCode = array_key_exists("merchant_code", $_POST) ? $_POST['merchant_code'] : "";
        $notifyUrl = array_key_exists("notify_url", $_POST) ? $_POST['notify_url'] : "";
        $interfaceVersion = array_key_exists("interface_version", $_POST) ? $_POST['interface_version'] : "";
        $clientIp = array_key_exists("client_ip", $_POST) ? $_POST['client_ip'] : "";
        $signOfMerchant = array_key_exists("sign", $_POST) ? $_POST['sign'] : "";
        $productName = array_key_exists("product_name", $_POST) ? $_POST['product_name'] : "";
        $productDesc = array_key_exists("product_desc", $_POST) ? $_POST['product_desc'] : "";
        $productExt = array_key_exists("product_ext", $_POST) ? $_POST['product_ext'] : "";
        $openType = array_key_exists("open_type", $_POST) ? $_POST['open_type'] : "";
        $payType = array_key_exists("pay_type", $_POST) ? $_POST['pay_type'] : "";
        $returnUrl = array_key_exists("return_url", $_POST) ? $_POST['return_url'] : "";
        $userType = array_key_exists("user_type", $_POST) ? $_POST['user_type'] : "";
        $cardType = array_key_exists("card_type", $_POST) ? $_POST['card_type'] : "";
        $bankCode = array_key_exists("bank_code", $_POST) ? $_POST['bank_code'] : "";
        $orderId = array_key_exists("order_id", $_POST) ? $_POST['order_id'] : "";

        if ($amount == "" || $clientIp == "" || $notifyUrl == "" || $orderId == "" || $productName == ""
            || $returnUrl == "" || $merchantCode == "" || $interfaceVersion == "" || $signOfMerchant == "")
            return $this->formatResult($this->FAILED, "缺少必要参数", null, null);

        $key = $this->getMerchantKey($merchantCode);
        if (null == $key)
            return $this->formatResult($this->FAILED, "商户号不存在！", null, null);

        $checkSignByPhpDataArray = [];
        $dataArray = [];
        $dataArray ["amount"] = $amount;
        $checkSignByPhpDataArray ["amount"] = $amount;
        if($bankCode != ""){
            $dataArray["bankCode"] = $bankCode;
            $checkSignByPhpDataArray ["bank_code"] = $this->formatBankCode($bankCode);
        }
        echo $checkSignByPhpDataArray ["bank_code"];
        if($cardType != ""){
            $dataArray["cardType"] = $cardType;
            $checkSignByPhpDataArray ["card_type"] = $cardType;
        }
        $dataArray["clientIp"] = $clientIp;
        $checkSignByPhpDataArray ["client_ip"] = $clientIp;
        $dataArray["interfaceVersion"] = $interfaceVersion;
        $checkSignByPhpDataArray ["interface_version"] = $interfaceVersion;
        $dataArray["merchantCode"] = $merchantCode;
        $checkSignByPhpDataArray ["merchant_code"] = $merchantCode;
        $dataArray["notifyUrl"] = $notifyUrl;
        $checkSignByPhpDataArray ["notify_url"] = $notifyUrl;
        $dataArray["orderId"] = $orderId;
        $checkSignByPhpDataArray ["order_id"] = $orderId;
        if($openType != ""){
            $dataArray["openType"] = $openType;
            $checkSignByPhpDataArray ["open_type"] = $openType;
        }
        if($payType != ""){
            $dataArray["payType"] = $payType;
            $checkSignByPhpDataArray ["pay_type"] = $payType;
        }
        if ($productDesc != ""){
            $dataArray["productDesc"] = $productDesc;
            $checkSignByPhpDataArray ["product_desc"] = $productDesc;
        }
        if ($productExt != "") {
            $dataArray["productExt"] = $productExt;
            $checkSignByPhpDataArray ["product_ext"] = $productExt;
        }
        $dataArray["productName"] = $productName;
        $checkSignByPhpDataArray ["product_name"] = $productName;
        if($userType != ""){
            $dataArray["userType"] = $userType;
            $checkSignByPhpDataArray ["user_type"] = $userType;
        }
        $dataArray["returnUrl"] = $returnUrl;
        $checkSignByPhpDataArray ["return_url"] = $returnUrl;

        //生成签名
        $signInPhp = Sign::productSign($checkSignByPhpDataArray, $key);

        if ($signInPhp != $signOfMerchant)
            return $this->formatResult($this->FAILED, "签名错误1", null, $key);

        $sign = Sign::productSign($dataArray, $key);
        $dataArray["sign"] = $sign;

        return $this->postSend($urlString, $dataArray, "text/html");
        //return $this->postSend("http://lemon.gzyunji.com/v1/api/ebank/pay", $dataArray, "text/html");
    }

    /**
     * 订单查询接口
     * @return string
     */
    public function query()
    {
        $urlString = getenv('LEMON_API_IP') . "/v1/api/scancode/query";
        $interfaceVersion = array_key_exists("interface_version", $_POST) ? $_POST['interface_version'] : "";
        $merchantCode = array_key_exists("merchant_code", $_POST) ? $_POST['merchant_code'] : "";
        $signOfMerchant = array_key_exists("sign", $_POST) ? $_POST['sign'] : "";
        $orderId = array_key_exists("order_id", $_POST) ? $_POST['order_id'] : "";

        $resultArray["amount"] = null;
        $resultArray["interface_version"] = $interfaceVersion;
        $resultArray["merchant_code"] = $merchantCode;
        $resultArray["message"] = null;
        $resultArray["order_id"] = $orderId;
        $resultArray["status"] = $this->OTHER;
        $resultArray["sys_order_id"] = null;
        $resultArray["sign"] = null;

        if ($interfaceVersion == "" || $merchantCode == "" || $signOfMerchant == "" || $orderId == "") {
            $resultArray["message"] = "参数错误";
            return json_encode($resultArray);
        }
        $key = $this->getMerchantKey($merchantCode);
        if (null == $key) {
            $resultArray["message"] = "商户不存在";
            return json_encode($resultArray);
        }

        $checkSignByPhpDataArray = [];
        $dataArray = [];
        $dataArray ["interfaceVersion"] = $interfaceVersion;
        $checkSignByPhpDataArray["interface_version"] = $interfaceVersion;
        $dataArray ["merchantCode"] = $merchantCode;
        $checkSignByPhpDataArray["merchant_code"] = $merchantCode;
        $dataArray ["orderId"] = $orderId;
        $checkSignByPhpDataArray["order_id"] = $orderId;
        $signInPhp = Sign::productSign($checkSignByPhpDataArray, $key);

        if ($signInPhp != $signOfMerchant) {
            $resultArray["message"] = "签名错误-查询订单支付状态";
            return json_encode($resultArray);
        }
        $sign = Sign::productSign($dataArray, $key);
        $dataArray["sign"] = $sign;

        $result = json_decode($this->postSend($urlString, $dataArray));
        //$result = json_decode($this->postSend("http://lemon.gzyunji.com/v1/api/scancode/query", $dataArray));

        if (null == $result || !array_key_exists("status", $result)) {
            $resultArray["message"] = "系统错误-请联系平台客服";
            return json_encode($resultArray);
        }
        return $this->formatQueryResult($result, $key);
    }

    /**
     * 下发查询接口
     * @return string
     */
    public function withdrawQuery(){
        $urlString = getenv('LEMON_API_IP') . "/v1/api/transfer/query";

        $interfaceVersion = array_key_exists("interface_version", $_POST) ? $_POST['interface_version'] : "";
        $merchantCode = array_key_exists("merchant_code", $_POST) ? $_POST['merchant_code'] : "";
        $merchantTransferCode = array_key_exists("merchant_transfer_code", $_POST) ? $_POST['merchant_transfer_code'] : "";
        $signOfMerchant = array_key_exists("sign", $_POST) ? $_POST['sign'] : "";

        $resultArray["merchant_code"] = $merchantCode;
        $resultArray["interface_version"] = $interfaceVersion;
        $resultArray["merchant_transfer_code"] = $merchantTransferCode;
        $resultArray["message"] = null;
        $resultArray["status"] = $this->FAILED;
        $resultArray["transfer_amount"] = null;
        $resultArray["transfer_apply_amount"] = null;
        $resultArray["transfer_code"] = null;
        $resultArray["transfer_time"] = null;
        $resultArray["sign"] = null;

        if ($interfaceVersion == "" || $merchantCode == "" || $merchantTransferCode == "" || $signOfMerchant == "") {
            $resultArray["message"] = "缺少必要参数";
            return json_encode($resultArray);
        }
        $key = $this->getMerchantKey($merchantCode);
        if (null == $key) {
            $resultArray["message"] = "商户不存在";
            return json_encode($resultArray);
        }

        $checkSignByPhpDataArray = [];
        $dataArray = [];
        $dataArray ["interfaceVersion"] = $interfaceVersion;
        $checkSignByPhpDataArray["interface_version"] = $interfaceVersion;
        $dataArray ["merchantCode"] = $merchantCode;
        $checkSignByPhpDataArray["merchant_code"] = $merchantCode;
        $dataArray ["merchantTransferCode"] = $merchantTransferCode;
        $checkSignByPhpDataArray["merchant_transfer_code"] = $merchantTransferCode;
        $signInPhp = Sign::productSign($checkSignByPhpDataArray, $key);

        if ($signInPhp != $signOfMerchant) {
            $resultArray["message"] = "签名错误-查询代付状态";
            return json_encode($resultArray);
        }
        $sign = Sign::productSign($dataArray, $key);
        $dataArray["sign"] = $sign;

        $result = json_decode($this->postSend($urlString, $dataArray));
        //$result = json_decode($this->postSend("http://lemon.gzyunji.com/v1/api/transfer/query", $dataArray));

        if (null == $result || !array_key_exists("status", $result)) {
            $resultArray["message"] = "系统错误-请联系平台客服";
            return json_encode($resultArray);
        }
        $resultArray["interface_version"] = $result->interfaceVersion;
        $resultArray["merchant_code"] = $result->merchantCode;
        $resultArray["merchant_transfer_code"] = $result->merchantTransferCode;
        $resultArray["message"] = $result->message;
        $resultArray["status"] = $result->status;
        $resultArray["transfer_amount"] = $result->transferAmount;
        $resultArray["transfer_apply_amount"] = $result->transferApplyAmount;
        $resultArray["transfer_code"] = $result->transferCode;
        $resultArray["transfer_time"] = $result->transferTime;
        $sign = Sign::productSign($resultArray, $key);
        $resultArray["sign"] = $sign;
        return json_encode($resultArray);
    }

    /**
     * 下发接口
     * @return string
     */
    public function transfer()
    {
        $urlString = getenv('LEMON_API_IP') . "/v1/api/transfer/transfer";

        $interfaceVersion = array_key_exists("interface_version", $_POST) ? $_POST['interface_version'] : "";
        $merchantCode = array_key_exists("merchant_code", $_POST) ? $_POST['merchant_code'] : "";
        $transferApplyAmount = array_key_exists("transfer_apply_amount", $_POST) ? $_POST['transfer_apply_amount'] : "";
        $merchantTransferCode = array_key_exists("merchant_transfer_code", $_POST) ? $_POST['merchant_transfer_code'] : "";
        $recvAccount = array_key_exists("recv_account", $_POST) ? $_POST['recv_account'] : "";
        $recvBrancheName = array_key_exists("recv_branche_name", $_POST) ? $_POST['recv_branche_name'] : "";
        $recvProvinceCode = array_key_exists("recv_province_code", $_POST) ? $_POST['recv_province_code'] : "";
        $recvCityCode = array_key_exists("recv_city_code", $_POST) ? $_POST['recv_city_code'] : "";
        $bankCode = array_key_exists("bank_code", $_POST) ? $_POST['bank_code'] : "";
        $recvName = array_key_exists("recv_name", $_POST) ? $_POST['recv_name'] : "";
        $signOfMerchant = array_key_exists("sign", $_POST) ? $_POST['sign'] : "";

        $resultArray["merchant_code"] = $merchantCode;
        $resultArray["interface_version"] = $interfaceVersion;
        $resultArray["sign"] = null;
        $resultArray["merchant_transfer_code"] = $merchantTransferCode;
        $resultArray["message"] = null;
        $resultArray["status"] = $this->FAILED;

        if ($interfaceVersion == "" || $merchantCode == "" || $transferApplyAmount == "" || $merchantTransferCode == ""
            || $recvAccount == "" || $recvBrancheName == "" || $recvProvinceCode == "" || $recvCityCode == "" ||
            $bankCode == "" || $recvName == "" || $signOfMerchant == "") {
            $resultArray["message"] = "参数错误";
            return json_encode($resultArray);
        }

        $key = $this->getMerchantKey($merchantCode);
        if (null == $key) {
            $resultArray["message"] = "商户不存在";
            return json_encode($resultArray);
        }

        $checkSignByPhpDataArray = [];
        $dataArray = [];
        if($bankCode != ""){
            $dataArray ["bankCode"] = $bankCode;
            $checkSignByPhpDataArray["bank_code"] = $bankCode;
        }
        $dataArray["merchantCode"] = $merchantCode;
        $checkSignByPhpDataArray["merchant_code"] = $merchantCode;
        $dataArray["interfaceVersion"] = $interfaceVersion;
        $checkSignByPhpDataArray["interface_version"] = $interfaceVersion;
        $dataArray["merchantTransferCode"] = $merchantTransferCode;
        $checkSignByPhpDataArray["merchant_transfer_code"] = $merchantTransferCode;
        $dataArray["recvAccount"] = $recvAccount;
        $checkSignByPhpDataArray["recv_account"] = $recvAccount;
        $dataArray["recvBrancheName"] = $recvBrancheName;
        $checkSignByPhpDataArray["recv_branche_name"] = $recvBrancheName;
        $dataArray["recvCityCode"] = $recvCityCode;
        $checkSignByPhpDataArray["recv_city_code"] = $recvCityCode;
        $dataArray["recvName"] = $recvName;
        $checkSignByPhpDataArray["recv_name"] = $recvName;
        $dataArray["recvProvinceCode"] = $recvProvinceCode;
        $checkSignByPhpDataArray["recv_province_code"] = $recvProvinceCode;
        $dataArray["transferApplyAmount"] = $transferApplyAmount;
        $checkSignByPhpDataArray["transfer_apply_amount"] = $transferApplyAmount;

        //生成签名
        $signInPhp = Sign::productSign($checkSignByPhpDataArray, $key);

        if ($signInPhp != $signOfMerchant) {
            $resultArray["message"] = "签名错误-申请代付";
            return json_encode($resultArray);
        }

        $sign = Sign::productSign($dataArray, $key);
        $dataArray["sign"] = $sign;

        $result = json_decode($this->postSend($urlString, $dataArray));
        //$result = json_decode($this->postSend("http://lemon.gzyunji.com/v1/api/transfer/transfer", $dataArray));

        if (null == $result || !array_key_exists("status", $result)) {
            $resultArray["message"] = "系统错误-请联系平台客服";
            return json_encode($resultArray);
        }
        return $this->formatTransferResult($result, $key);
    }

    /**
     * 余额查询
     * @return string
     */
    public function balanceQuery(){
        $urlString = getenv('LEMON_API_IP') . "/v1/api/transfer/query_balance";

        $interfaceVersion = array_key_exists("interface_version", $_POST) ? $_POST['interface_version'] : "";
        $merchantCode = array_key_exists("merchant_code", $_POST) ? $_POST['merchant_code'] : "";
        $signOfMerchant = array_key_exists("sign", $_POST) ? $_POST['sign'] : "";

        $resultArray["account_status"] = null;
        $resultArray["balance"] = null;
        $resultArray["interface_version"] = $interfaceVersion;
        $resultArray["merchant_code"] = $merchantCode;
        $resultArray["message"] = null;
        $resultArray["status"] = $this->FAILED;
        $resultArray["usable_balance"] = null;
        $resultArray["sign"] = null;

        if ($interfaceVersion == "" || $merchantCode == "" || $signOfMerchant == "" ) {
            $resultArray["message"] = "参数错误";
            return json_encode($resultArray);
        }
        $key = $this->getMerchantKey($merchantCode);
        if (null == $key) {
            $resultArray["message"] = "商户不存在";
            return json_encode($resultArray);
        }

        $checkSignByPhpDataArray = [];
        $dataArray = [];
        $dataArray ["interfaceVersion"] = $interfaceVersion;
        $checkSignByPhpDataArray["interface_version"] = $interfaceVersion;
        $dataArray ["merchantCode"] = $merchantCode;
        $checkSignByPhpDataArray["merchant_code"] = $merchantCode;

        $signInPhp = Sign::productSign($checkSignByPhpDataArray, $key);

        if ($signInPhp != $signOfMerchant) {
            $resultArray["message"] = "签名错误-查询可用余额";
            return json_encode($resultArray);
        }
        $sign = Sign::productSign($dataArray, $key);
        $dataArray["sign"] = $sign;

        $result = json_decode($this->postSend($urlString, $dataArray));
        //$result = json_decode($this->postSend("http://lemon.gzyunji.com/v1/api/transfer/query_balance", $dataArray));

        if (null == $result || !array_key_exists("status", $result)) {
            $resultArray["message"] = "系统错误-请联系平台客服";
            return json_encode($resultArray);
        }

        $resultArray["account_status"] = $result->accountStatus;
        $resultArray["balance"] = $result->balance;
        $resultArray["interface_version"] = $result->interfaceVersion;
        $resultArray["merchant_code"] = $result->merchantCode;
        $resultArray["message"] = $result->message;
        $resultArray["status"] = $result->status;
        $resultArray["usable_balance"] = $result->usableBalance;

        $sign = Sign::productSign($resultArray, $key);
        $resultArray["sign"] = $sign;
        return json_encode($resultArray);
    }

    private function getMerchantKey($merchantCode)
    {
        $urlString = getenv('LEMON_GET_KEY_URL');
        $arrayData = [];
        $arrayData["connectionKey"] = getenv('API_KEY');
        $arrayData["merchantCode"] = $merchantCode;
        return $this->postSend($urlString, $arrayData);
        //return $result == null ? "F67970A14BEA4821B045CBA575EC57D2" : $result->key;
    }

    private function formatResult($result, $message, $url, $key)
    {
        $array["message"] = $message;
        $array["result"] = $result;
        $array["url"] = $url;
        $sign = $key == null ? null : Sign::productSign($array, $key);
        return '{"message":"' . $message . '","status":"' . $result . '","sign":"' . $sign . '","content":"' . $url . '"}';
    }

    private function formatQueryResult($result, $key)
    {
        $resultArray["amount"] = $result->amount;
        $resultArray["interface_version"] = $result->interfaceVersion;
        $resultArray["merchant_code"] = $result->merchantCode;
        $resultArray["message"] = $result->message;
        $resultArray["order_id"] = $result->orderId;
        $resultArray["status"] = $this->formatStatus($result->status);
        $resultArray["sys_order_id"] = $result->sysOrderId;
        $sign = Sign::productSign($resultArray, $key);
        $resultArray["sign"] = $sign;
        return json_encode($resultArray);
    }

    private function formatTransferResult($result, $key)
    {
        $resultArray["merchant_code"] = $result->merchantCode;
        $resultArray["interface_version"] = $result->interfaceVersion;
        $resultArray["merchant_transfer_code"] = $result->merchantTransferCode;
        $resultArray["message"] = $result->message;;
        $resultArray["status"] = $this->formatStatus($result->status);
        $sign = Sign::productSign($resultArray, $key);
        $resultArray["sign"] = $sign;
        return json_encode($resultArray);
    }

    private function formatStatus($statusString)
    {
        switch ($statusString) {
            case "SUCCESS":
                return $this->SUCCESS;
            case "FAILED" :
                return $this->FAILED;
            case "OTHER"  :
                return $this->OTHER;
        }
        return null;
    }

    private function formatBankCode($bankCode){
        $insertStr = "_net";
        $size = strlen($bankCode);
        $starStr = substr($bankCode,0,$size - 4);
        $endStr = substr($bankCode, -4);
        return $starStr . $insertStr . $endStr;
    }

    //转换成旧接口字符串
    private function changeServiceType($payMent, $newServiceType)
    {
        if ("SCAN" == $payMent) {
            switch ($newServiceType) {
                case "wechat_scan":
                    return "weixin_pay";
                case "jd_scan":
                    return "jdpay_pay";
                case "ali_scan":
                    return "alipay_pay";
                case "union_scan":
                    return "union_pay";
                case "qq_scan":
                    return "qqmobile_pay";
            }
            return null;
        }
        switch ($newServiceType) {
            case "wechat_h5":
                return "wx_h5";
            case "ali_h5":
                return "ali_h5";
            case "qq_h5":
                return "qq_h5";
            case "jd_h5":
                return "jd_h5";
        }
        return null;
    }

    private function postSend($urlString, $dataArray, $acceptString = "application/json")
    {
        $headers = array("Content-type: application/json;charset='utf-8'",
            "Accept: $acceptString",
            "Cache-Control: no-cache",
            "Pragma: no-cache"
        );
        $dataJsonString = json_encode($dataArray);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlString);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($dataJsonString));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}