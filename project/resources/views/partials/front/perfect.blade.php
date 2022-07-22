@php
$m_shop = '1530767907';
$m_orderid = 'sfdsf1';
$m_amount = number_format(100, 2, '.', '');
$m_curr = 'USD';
$m_desc = base64_encode('Test');
$m_key = 'Your secret key';

$arHash = array(
	$m_shop,
	$m_orderid,
	$m_amount,
	$m_curr,
	$m_desc
);


$arParams = array(
	'success_url' => 'http:///new_success_url',
	'fail_url' => 'http:///new_fail_url',
	'status_url' => 'http:///new_status_url',
	'reference' => array(
		'var1' => '1',
	),
);

$key = md5(''.$m_orderid);

$m_params = @urlencode(base64_encode(openssl_encrypt(json_encode($arParams), 'AES-256-CBC', $key, OPENSSL_RAW_DATA)));

$arHash[] = $m_params;


$arHash[] = $m_key;

$sign = strtoupper(hash('sha256', implode(':', $arHash)));
@endphp