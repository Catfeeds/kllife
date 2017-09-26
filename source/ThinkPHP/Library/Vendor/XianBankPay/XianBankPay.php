<?php
class XianBankPay{
    protected static $pfxFilePath = 'http://kllife.com/source/ThinkPHP/Library/Vendor/XianBankPay/000001test.pfx'; //请替换证书路径
    protected static $pfxpwd = '000001';
    /**
     * 获取公钥证书id
     * getCertId
     * @return mixed
     */
    public function getCertId() {
        $pkcs12certdata = file_get_contents ( self::$pfxFilePath );
        openssl_pkcs12_read ( $pkcs12certdata, $certs, self::$pfxpwd );
        $x509data = $certs ['cert'];
        openssl_x509_read ( $x509data );
        $certdata = openssl_x509_parse ( $x509data );
        $cert_id = $certdata ['serialNumber'];
        return $cert_id;
    }
    /**
     *  作用：生成签名
     *  加载pfx文件，获取文件内容
     *  待签名数据转换为 key1=value1&key2=value2的形式
     *  然后经过sha1X16算法
     *  然后在用 私钥签名
     *  然后在进行 base64Encode
     */
    public function getSign(array $data)
    {
        foreach ($data as $k => $v)
        {
            $Parameters[$k] = $v;
        }
        //签名步骤一：按字典序排序参数
        $Parameters['certId'] = $this->getCertId();
        ksort($Parameters);
        $String = $this->formatBizQueryParaMap($Parameters, false,'&');
        //签名步骤二：经过sha1 算法，sha1($String) => 输出16进制, sha1($String,true) => 输出二进制
        $String = sha1($String);  //sha1 算法,默认输出16进制
        //签名步骤三: 使用私钥签名，并对签名进行base64Encode处理
        $result_ = $this->sha1withRSA($String);
        return $result_;
    }
    /**
     * 签名  生成签名串  基于sha1withRSA
     * @param string $data 签名前的字符串
     * @return string 签名串
     */
   private function sha1withRSA($data) {
        $certs = array();
        openssl_pkcs12_read(file_get_contents(self::$pfxFilePath), $certs, self::$pfxpwd); //其中password为你的证书密码
        if(!$certs) return false;
        $signature = '';
        openssl_sign($data, $signature, $certs['pkey']);
        return base64_encode($signature);
    }
    /**
     * 验签  验证签名  基于sha1withRSA
     * @param $data 签名前的原字符串
     * @param $signature 签名串
     * @return bool
     */
    public function verify($data, $signature) {
        $unsignMsg = base64_decode($signature);
        $sha1Data = sha1($data);
        $certs = array();
        openssl_pkcs12_read(file_get_contents(self::$pfxFilePath), $certs,self::$pfxpwd);
        if(!$certs) return false;
        $result = (bool) openssl_verify($sha1Data, $unsignMsg, $certs['cert']); //openssl_verify验签成功返回1，失败0，错误返回-1
        return $result;
    }
    /**
     *  作用：格式化参数，签名过程需要使用
     */
   private function formatBizQueryParaMap($paraMap, $urlencode=false,$connector = '&')
    {
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v)
        {
            if($urlencode)
            {
                $v = urlencode($v);
            }
            $buff .= $k . "=" . $v . $connector;
        }
        $reqPar="";
        if (strlen($buff) > 0)
        {
            $reqPar = substr($buff, 0, strlen($buff)-1);
        }
        return $reqPar;
    }
}
