# TcKimlik
Tc Kimlik Doğrulama

### 1. Örnek

`    include "TcKimlik.php";
	$kisi = ['TCKimlikNo' => '10000000000',
			'Ad' => 'Ahmet',
			'Soyad' => 'AHM',
			'DogumYili' => '1923'];
			$tcresult = new TcKimlik($kisi);
			if ($tcresult->dogrula())     {
			echo "Doğrulandı";     } 
			else { 
			echo $tcresult>error();
			}      `

### 2. Örnek

`     include "TcKimlik.php";
	  $tcresult = new TcKimlik($kisi);
	  $tc->TCKimlikNo(10000000000);
	  $tc->Ad('Ahmet');
	  $tc->Soyad('AHM');
	  $tc->DogumYili(1923);
	  
	  if ($tcresult->dogrula())     {
			echo "Doğrulandı";     } 
		else {
			echo $tcresult>error();
			
			}     `
