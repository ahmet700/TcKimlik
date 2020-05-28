<?php
/** 
 * TcKimlik Doğrulama
 * 
 * Tc Kimlik Numarası Doğrulama Yapan bir php class 'ı. 
 * 
 * @class       TcKimlik 
 * @author      ahmet700 
 */ 
class TcKimlik 
{	
	private $client;
	private $tcno;
	private $name;
	private $surname;
	private $birthyear;
	private $error = null;
	private $serviceUrl = 'https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL';
	
	 
	public function __construct($data = array())
	{
		if (is_array($data))
		{
			$this->tcno 	 = 	isset($data['TCKimlikNo']) ? $data['TCKimlikNo']: null ; 
			$this->name 	 = 	isset($data['Ad']) 		   ? $data['Ad']: null ; 
			$this->surname 	 = 	isset($data['Soyad']) 	   ? $data['Soyad']: null ; 
			$this->birthyear =	isset($data['DogumYili'])  ? $data['DogumYili']: null ; 
		}
		
	}
	public function TCKimlikNo($tcno)	{
		return $this->tcno = $tcno;
	}
	
	public function Ad($name)	{
		return $this->name = $name;
	}
	
	public function Soyad($surname)	{
		return $this->surname = $surname;
	}
	
	public function DogumYili($birthyear)	{
		return $this->birthyear = $birthyear;
	}	
	
	
	public function dogrula()
	{
		try {
		
			$client = new SoapClient($this->serviceUrl);
			
			if (is_null($this->tcno) || (!is_numeric($this->tcno)) || (strlen($this->tcno)!=11)) {
				$this->error ="TCKimlikNo 11 Hane Bir Sayı Olmalı.<br/>";
			}
			if (is_null($this->name) || (empty($this->name))) {
				$this->error .= "Ad Gerekli<br/>" ;
			}
			if (is_null($this->surname) || (empty($this->surname))) {
				$this->error .="Soyad Gerekli<br/>";
			}
			if (is_null($this->birthyear) || (!is_numeric($this->birthyear))) {
				$this->error .="Geçerli Bir Doğum Yılı Gerekli<br/>";
			}
			
			
			if (is_null($this->error)) {
				
				$result = $client->TCKimlikNoDogrula([
					'TCKimlikNo' => $this->tcno,
					'Ad' => $this->_uppercase($this->name),
					'Soyad' => $this->_uppercase($this->surname),
					'DogumYili' => $this->birthyear
				]);
				
				if ($result->TCKimlikNoDogrulaResult) {
					return true;
				} else {
					return false;
				}
			} else { 
				return false;
			}
		} catch (Exception $e) {
			
			$this->error .= $e->faultstring;
			return false;
		}
	}
	
	public function error()
	{
		return "Hata:<br>". $this->error;
	}
	
	private function _uppercase($string)
	{
		$lowers = array('i');
		$uppers = array('İ');
		$string = str_replace($lowers,$uppers,$string);
		return mb_strtoupper($string, 'UTF-8') ;
	}
	
	
} 