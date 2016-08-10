# yandex-maps
work with yandex maps

##Функция, которая отправляет яндексу адрес и возвращает координаты
(с) https://wordpress.org/plugins/oi-yamaps/
```php
function nalog_curl_get_contents($url)
{
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($curl);
  curl_close($curl);
  return $data;
}

function nalog_coordinates( $address ) // get coordinates of a given address
{
	$address = urlencode( $address );
	$url = "https://geocode-maps.yandex.ru/1.x/?geocode=" . $address;
	$content = @file_get_contents( $url ); // получаем данные от Яндекса
	if( empty( $content ) ) // если произошла ошибка
	{
		//if( _isCurl() )
		//{
			$content = nalog_curl_get_contents( $url ); // используем для получения данных curl
		//}else
		//{
		//	return __('To show the map cURL must be enabled.', 'oiyamaps');
		//}
	}
	preg_match( '/<pos>(.*?)<\/pos>/', $content, $point );
	return implode(',',array_reverse(split(' ',trim(strip_tags($point[1])))));
}
```
