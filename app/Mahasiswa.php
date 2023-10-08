<?php

require 'ApiService.php';

class Mahasiswa {

    protected $token;

	function getDataPribadi($nim){
        $apiService = new ApiService();
        
		$this->token = $apiService->login();
        $dataPribadi =  $apiService->getDataPribadiByNim($nim, $this->token);
        if(is_array($dataPribadi)) {
            return $dataPribadi;
        } else {
            return false;
        }
    }

    function getBillingByNomorBillingDanMasa($nomor_billing, $masa){
        $apiService = new ApiService();
        
		$this->token = $apiService->login();
        $dataBilling =  $apiService->getBillingByNomorBillingDanMasa($nomor_billing,$masa, $this->token);
        if(is_array($dataBilling)) {
            return $dataBilling;
        } else {
            return false;
        }
    }
}

?>