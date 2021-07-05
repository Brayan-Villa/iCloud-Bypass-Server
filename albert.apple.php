<?php
/*
   PHP DEVELOPED BY: FAILBR34K
   MODIFIED BY: BRAYAN VILLA
*/
//=======================================================================================================================================//

$activation= (array_key_exists('activation-info-base64', $_POST)
                          ? base64_decode($_POST['activation-info-base64'])
                          : array_key_exists('activation-info', $_POST) ? $_POST['activation-info'] : '');
						  
if(!isset($activation) || empty($activation))
{
	header('location: https://LOCALIZACIÓN DE PAGINA DE ERROR DE SU SERVIDOR/404.html'); 
	exit('404'); 
}
//=======================================================================================================================================//

//Load & Decode ActivationInfoXML
//Carga y decodificación de ActivationInfoXML

$encodedrequest = new DOMDocument;
$encodedrequest->loadXML($activation);
$activationDecoded= base64_decode($encodedrequest->getElementsByTagName('data')->item(0)->nodeValue);

$decodedrequest = new DOMDocument;
$decodedrequest->loadXML($activationDecoded);
$nodes = $decodedrequest->getElementsByTagName('dict')->item(0)->getElementsByTagName('*');

//=======================================================================================================================================//

for ($i = 0; $i < $nodes->length - 1; $i=$i+2)
{
   switch ($nodes->item($i)->nodeValue) 
   {
      case "ActivationRandomness": $activationRandomness = $nodes->item($i + 1)->nodeValue; break;
      case "ActivationState": $activationState = $nodes->item($i + 1)->nodeValue; break;
      case "BasebandSerialNumber": $baseSerial = $nodes->item($i + 1)->nodeValue; break;
      case "DeviceCertRequest": $deviceCertRequestBase64 = base64_decode($nodes->item($i + 1)->nodeValue); break;
      case "DeviceClass": $deviceType = $nodes->item($i + 1)->nodeValue; break;
      case "InternationalMobileEquipmentIdentity": $imei = $nodes->item($i + 1)->nodeValue; break;
      case "InternationalMobileSubscriberIdentity": $imsi = $nodes->item($i + 1)->nodeValue; break;
      case "IntegratedCircuitCardIdentity": $iccid = $nodes->item($i + 1)->nodeValue; break;
      case "MobileEquipmentIdentifier": $meid = $nodes->item($i + 1)->nodeValue; break;
      case "ProductType": $ProductType = $nodes->item($i + 1)->nodeValue; break;
      case "ProductVersion": $productVersion = $nodes->item($i + 1)->nodeValue; break;
      case "UniqueDeviceID": $uniqueDiviceID = $nodes->item($i + 1)->nodeValue; break;
      case "UniqueChipID": $ucid = $nodes->item($i + 1)->nodeValue; break;
      case "SerialNumber": $serial = $nodes->item($i + 1)->nodeValue; break;
    }
}

//=======================================================================================================================================//

$folder =  'Activate/Devices/'.$deviceType.'/'.$ProductType.'/';
if(!file_exists ($folder))
{
	mkdir ($folder, 00777, true);
}
else
{
	
}

//=======================================================================================================================================//
// This is a device activation information without linking to Find My iPhone, so Albert responds with an ActivationRecord

// Esta es una información de activación de un dispositivo sin vinculación a Buscar mi iPhone, por lo que albert responde con un ActivationRecord

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://albert.apple.com/deviceservices/deviceActivation",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => array('InStoreActivation' => 'false','AppleSerialNumber' => 'C38JCATYDTWF','IMEI' => '013349008187060','MEID' => '','IMSI' => '268030103481639','ICCID' => '8935103016300053247','activation-info' => '<dict>
    <key>ActivationInfoComplete</key>
	<true/>
	<key>ActivationInfoXML</key>
	<data>
	PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPCFET0NUWVBFIHBs
	aXN0IFBVQkxJQyAiLS8vQXBwbGUvL0RURCBQTElTVCAxLjAvL0VOIiAiaHR0cDovL3d3
	dy5hcHBsZS5jb20vRFREcy9Qcm9wZXJ0eUxpc3QtMS4wLmR0ZCI+CjxwbGlzdCB2ZXJz
	aW9uPSIxLjAiPgo8ZGljdD4KCTxrZXk+QWN0aXZhdGlvblJhbmRvbW5lc3M8L2tleT4K
	CTxzdHJpbmc+MUJEOTQ0NzAtRjExNi00MUZDLUE3NkEtQUVFN0NFMDcxMTJEPC9zdHJp
	bmc+Cgk8a2V5PkFjdGl2YXRpb25SZXF1aXJlc0FjdGl2YXRpb25UaWNrZXQ8L2tleT4K
	CTx0cnVlLz4KCTxrZXk+QWN0aXZhdGlvblN0YXRlPC9rZXk+Cgk8c3RyaW5nPlVuYWN0
	aXZhdGVkPC9zdHJpbmc+Cgk8a2V5PkJhc2ViYW5kQWN0aXZhdGlvblRpY2tldFZlcnNp
	b248L2tleT4KCTxzdHJpbmc+VjI8L3N0cmluZz4KCTxrZXk+QmFzZWJhbmRDaGlwSUQ8
	L2tleT4KCTxpbnRlZ2VyPjcyNzg4MTc8L2ludGVnZXI+Cgk8a2V5PkJhc2ViYW5kTWFz
	dGVyS2V5SGFzaDwva2V5PgoJPHN0cmluZz5BRUE1Q0NFMTQzNjY4RDBFRkI0Q0UxRjJD
	OTRDOTY2QTY0OTZDNkFBPC9zdHJpbmc+Cgk8a2V5PkJhc2ViYW5kU2VyaWFsTnVtYmVy
	PC9rZXk+Cgk8ZGF0YT4KCUFPWEwyQT09Cgk8L2RhdGE+Cgk8a2V5PkJ1aWxkVmVyc2lv
	bjwva2V5PgoJPHN0cmluZz4xMUQyNTc8L3N0cmluZz4KCTxrZXk+RGV2aWNlQ2VydFJl
	cXVlc3Q8L2tleT4KCTxkYXRhPgoJTFMwdExTMUNSVWRKVGlCRFJWSlVTVVpKUTBGVVJT
	QlNSVkZWUlZOVUxTMHRMUzBLVFVsSlFuaEVRME5CVXpCRFFWRkIKCWQyZFpUWGhNVkVG
	eVFtZE9Wa0pCVFZSS1JFRXpUbXBDUTFGVlJrWk1WR2hHVWtScmRFNUVZelJPVXpGRFVt
	cEJOQXBNCglWR2hHVWxWVk1rMXFiRWRTYWxFMFRrUkZURTFCYTBkQk1WVkZRbWhOUTFa
	V1RYaERla0ZLUW1kT1ZrSkJaMVJCYTA1QwoJVFZKSmQwVkJXVVJXVVZGSUNrVjNiRVJr
	V0VKc1kyNVNjR0p0T0hoRmVrRlNRbWRPVmtKQmIxUkRhMFozWTBkNGJFbEYKCWJIVlpl
	VFI0UkhwQlRrSm5UbFpDUVhOVVFtMXNVV0ZIT1hVS1dsUkRRbTU2UVU1Q1oydHhhR3Rw
	UnpsM01FSkJVVVZHCglRVUZQUW1wUlFYZG5XV3REWjFsRlFURTBTRlJFYURsQ2QzbDJX
	bmhXT0V0b2RtVm9TbUpYV0FwR1NuVm5XVTFTT0dWUgoJUlVaV1Z6VjBURkpSTVRZNE9V
	TkVhVE5hYTJ4RWEybFNlRmh2U21GMVkxQXJUbXhOU1VaVlNXeG1jWGRMVFVKSVlWUTMK
	CU5sSllDblpWVUU5dVEyRktZbTQxWVZrMlp6aEJSRUZ1UTFoNVprWlVWM0pEZG1sQ1dW
	VlNRbTlsYUdjMWJrZ3JOa05ECglZMEl2ZDBWdU4zQkdSa1p0TTBwdGJrY0tZM1JGTUZO
	eVVGaHJhSFF3V1VRMFVXNTJPRU5CZDBWQlFXRkJRVTFCTUVkRAoJVTNGSFUwbGlNMFJS
	UlVKQ1VWVkJRVFJIUWtGSWFreFZNMk00TlU1MFZRcExSRGczTWxsSFozSldXVXhwVGxO
	a1JHVkUKCVp6bEtkak4xZW1waGRHVmpOMWRRWmpOYVpFTm5Sa0ptYkU1d2VGQnJWa3B2
	TkdsMVdYWldhbTVNVUdaU0NqWnFkM0JLCglRVk5NUVdKR05YTkRla3h3UzFKYWRtMUtV
	REppZFdkVmIyZGFWV04wSzJaWWFFdE9SRnBTTkZaWlQxRlRRVzFvV1hKUgoJUjJaMlJ6
	QndTMVlLZHpoUlJIcHlNRWgwYVUwMWIwSlZNalpSUWtkR1FVUjNaVU5vU2pKUWVqQUtM
	UzB0TFMxRlRrUWcKCVEwVlNWRWxHU1VOQlZFVWdVa1ZSVlVWVFZDMHRMUzB0Q2c9PQoJ
	PC9kYXRhPgoJPGtleT5EZXZpY2VDbGFzczwva2V5PgoJPHN0cmluZz5pUGhvbmU8L3N0
	cmluZz4KCTxrZXk+RGV2aWNlVmFyaWFudDwva2V5PgoJPHN0cmluZz5BPC9zdHJpbmc+
	Cgk8a2V5PkZNaVBBY2NvdW50RXhpc3RzPC9rZXk+Cgk8ZmFsc2UvPgoJPGtleT5JbnRl
	Z3JhdGVkQ2lyY3VpdENhcmRJZGVudGl0eTwva2V5PgoJPHN0cmluZz44OTM1MTAzMDE2
	MzAwMDUzMjQ3PC9zdHJpbmc+Cgk8a2V5PkludGVybmF0aW9uYWxNb2JpbGVFcXVpcG1l
	bnRJZGVudGl0eTwva2V5PgoJPHN0cmluZz4wMTMzNDkwMDgxODcwNjA8L3N0cmluZz4K
	CTxrZXk+SW50ZXJuYXRpb25hbE1vYmlsZVN1YnNjcmliZXJJZGVudGl0eTwva2V5PgoJ
	PHN0cmluZz4yNjgwMzAxMDM0ODE2Mzk8L3N0cmluZz4KCTxrZXk+TW9kZWxOdW1iZXI8
	L2tleT4KCTxzdHJpbmc+TUQyOTg8L3N0cmluZz4KCTxrZXk+UHJvZHVjdFR5cGU8L2tl
	eT4KCTxzdHJpbmc+aVBob25lNSwyPC9zdHJpbmc+Cgk8a2V5PlByb2R1Y3RWZXJzaW9u
	PC9rZXk+Cgk8c3RyaW5nPjcuMS4yPC9zdHJpbmc+Cgk8a2V5PlJlZ2lvbkNvZGU8L2tl
	eT4KCTxzdHJpbmc+RkI8L3N0cmluZz4KCTxrZXk+UmVnaW9uSW5mbzwva2V5PgoJPHN0
	cmluZz5GQi9BPC9zdHJpbmc+Cgk8a2V5PlNJTVN0YXR1czwva2V5PgoJPHN0cmluZz5r
	Q1RTSU1TdXBwb3J0U0lNU3RhdHVzUmVhZHk8L3N0cmluZz4KCTxrZXk+U2VyaWFsTnVt
	YmVyPC9rZXk+Cgk8c3RyaW5nPkMzOEpDQVRZRFRXRjwvc3RyaW5nPgoJPGtleT5TdXBw
	b3J0c1Bvc3Rwb25lbWVudDwva2V5PgoJPHRydWUvPgoJPGtleT5VbmlxdWVDaGlwSUQ8
	L2tleT4KCTxpbnRlZ2VyPjE3NTIxMjg2NjAyMzc8L2ludGVnZXI+Cgk8a2V5PlVuaXF1
	ZURldmljZUlEPC9rZXk+Cgk8c3RyaW5nPmZmZDQ5OTQzOWM1NzQxNmQxMjMxYzIzNzE2
	NDEwN2U3ZjVkMmZkZGY8L3N0cmluZz4KCTxrZXk+a0NUUG9zdHBvbmVtZW50SW5mb1BS
	SVZlcnNpb248L2tleT4KCTxzdHJpbmc+MC4xLjc0PC9zdHJpbmc+Cgk8a2V5PmtDVFBv
	c3Rwb25lbWVudEluZm9QUkxOYW1lPC9rZXk+Cgk8aW50ZWdlcj4wPC9pbnRlZ2VyPgo8
	L2RpY3Q+CjwvcGxpc3Q+Cg==
	</data>
	<key>FairPlayCertChain</key>
	<data>
	MIICxDCCAi2gAwIBAgINMzOvBwQCrwACrwAAATANBgkqhkiG9w0BAQUFADB7MQswCQYD
	VQQGEwJVUzETMBEGA1UEChMKQXBwbGUgSW5jLjEmMCQGA1UECxMdQXBwbGUgQ2VydGlm
	aWNhdGlvbiBBdXRob3JpdHkxLzAtBgNVBAMTJkFwcGxlIEZhaXJQbGF5IENlcnRpZmlj
	YXRpb24gQXV0aG9yaXR5MB4XDTA3MDQwMjE1MTcyN1oXDTEyMDMzMTE1MTcyN1owZzEL
	MAkGA1UEBhMCVVMxEzARBgNVBAoTCkFwcGxlIEluYy4xFzAVBgNVBAsTDkFwcGxlIEZh
	aXJQbGF5MSowKAYDVQQDEyFpUGhvbmUuMzMzM0FGMDcwNDAyQUYwMDAyQUYwMDAwMDEw
	gZ8wDQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBANeOK/G/ndTY2+7jsfla4L5tv40V36AQ
	jFek/fJQfe428mJFq05w0wACziIba5VgUHXNji8wBBJO+rzqefJncLt3RSr1eVlK2sOv
	52nErdQnrSf6yYNT7ng1iuDh8cfKNt2gTyN2943yMR0WmdGi+5G/jqncYioaVgZyTfCj
	PEI/AgMBAAGjYDBeMA4GA1UdDwEB/wQEAwIDuDAMBgNVHRMBAf8EAjAAMB0GA1UdDgQW
	BBRP3NB9MdROc1SthHsfTiS6AZem6TAfBgNVHSMEGDAWgBT6DdQRkRvmsk4eBkmUEd1j
	YgdZZDANBgkqhkiG9w0BAQUFAAOBgQBTxW91h2k/wiQSSIVpxjqfGJDDgPitlVwjGoVU
	k8qGVhjuDmXEIrbfYRSV92VUpGgqJ+OlHng4YKS++52P3a+57rEiyji8LwaWPmmKs/Kp
	XugV9MeREqQ/KAui0zVd1LMaSDo1uSlru1+72jEPUXA2B5hOoYQA15EogpNJz5EeZzCC
	A3EwggJZoAMCAQICAREwDQYJKoZIhvcNAQEFBQAwYjELMAkGA1UEBhMCVVMxEzARBgNV
	BAoTCkFwcGxlIEluYy4xJjAkBgNVBAsTHUFwcGxlIENlcnRpZmljYXRpb24gQXV0aG9y
	aXR5MRYwFAYDVQQDEw1BcHBsZSBSb290IENBMB4XDTA3MDIxNDE5MjA0MVoXDTEyMDIx
	NDE5MjA0MVowezELMAkGA1UEBhMCVVMxEzARBgNVBAoTCkFwcGxlIEluYy4xJjAkBgNV
	BAsTHUFwcGxlIENlcnRpZmljYXRpb24gQXV0aG9yaXR5MS8wLQYDVQQDEyZBcHBsZSBG
	YWlyUGxheSBDZXJ0aWZpY2F0aW9uIEF1dGhvcml0eTCBnzANBgkqhkiG9w0BAQEFAAOB
	jQAwgYkCgYEAsmc8XSrnj/J3z+8xvNEE/eqf0IYpkAqj/2RK72n0CrnvxMRjyjotIT1S
	jCOJKarbF9zLKMRpzXIkwhDB9HgdMRbF5uoZHSozvoCr3BFIBiofDmGBzXmaXRL0hJDI
	fPZ4m1L4+vGIbhBy+F3LiOy2VRSXpE0LwU8nZ5mmpLPX2q0CAwEAAaOBnDCBmTAOBgNV
	HQ8BAf8EBAMCAYYwDwYDVR0TAQH/BAUwAwEB/zAdBgNVHQ4EFgQU+g3UEZEb5rJOHgZJ
	lBHdY2IHWWQwHwYDVR0jBBgwFoAUK9BpR5R2Cf70a40uQKb3R01/CF4wNgYDVR0fBC8w
	LTAroCmgJ4YlaHR0cDovL3d3dy5hcHBsZS5jb20vYXBwbGVjYS9yb290LmNybDANBgkq
	hkiG9w0BAQUFAAOCAQEAwKBz+B3qHNHNxYZ1pLvrQMVqLQz+W/xuwVvXSH1AqWEtSzdw
	OO8GkUuvEcIfle6IM29fcur21Xa1V1hx8D4Qw9Uuuy+mOnPCMmUKVgQWGZhNC3ht0KN0
	ZJhU9KfXHaL/KsN5ALKZ5+e71Qai60kzaWdBAZmtaLDTevSV4P0kiCoQ56No/617+tm6
	8aV/ypOizgM3A2aFkwUbMfZ1gpMv0/DaOTc9X/66zZpwwAaLIu6pzgRuJGk7FlKlwPLA
	rkNwhLshkUPLu7fqW7qT4Ld3ie9NVgQzXc5cWTGn1ztFVhHNrsubDqDP3JOoysVYeAAF
	2Zmr1l6H6pJzNFSjkxikgzCCBLswggOjoAMCAQICAQIwDQYJKoZIhvcNAQEFBQAwYjEL
	MAkGA1UEBhMCVVMxEzARBgNVBAoTCkFwcGxlIEluYy4xJjAkBgNVBAsTHUFwcGxlIENl
	cnRpZmljYXRpb24gQXV0aG9yaXR5MRYwFAYDVQQDEw1BcHBsZSBSb290IENBMB4XDTA2
	MDQyNTIxNDAzNloXDTM1MDIwOTIxNDAzNlowYjELMAkGA1UEBhMCVVMxEzARBgNVBAoT
	CkFwcGxlIEluYy4xJjAkBgNVBAsTHUFwcGxlIENlcnRpZmljYXRpb24gQXV0aG9yaXR5
	MRYwFAYDVQQDEw1BcHBsZSBSb290IENBMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIB
	CgKCAQEA5JGpCR+R2x5HUOsF7V55hC3rNqJXTFXsixmJ3vlLbPUHqyIwAugYPvhQCdN/
	QaiY+dHKZpwkaxHQo7vkGyrDH5WeegykR4tb1BY3M8vED03OFGnRyRly9V0O1X9fm/Il
	A7pVj01dDfFkNSMVSxVZHbOU9/acns9QusFYUGePCLQg98usLCBvcLY/ATCMt0PPD509
	8ytJKBrI/s61uQ7ZXhzWyz21Oq30Dw4AkguxIRYudNU8DdtiFqujcZJHU1XBry9Bs/j7
	43DN5qNMRX4fTGtQlkGJxHRiCxCDQYczioGxMFjsWgQyjGizjx3eZXP/Z15lvEnYdp8z
	FGWhd5TJLQIDAQABo4IBejCCAXYwDgYDVR0PAQH/BAQDAgEGMA8GA1UdEwEB/wQFMAMB
	Af8wHQYDVR0OBBYEFCvQaUeUdgn+9GuNLkCm90dNfwheMB8GA1UdIwQYMBaAFCvQaUeU
	dgn+9GuNLkCm90dNfwheMIIBEQYDVR0gBIIBCDCCAQQwggEABgkqhkiG92NkBQEwgfIw
	KgYIKwYBBQUHAgEWHmh0dHBzOi8vd3d3LmFwcGxlLmNvbS9hcHBsZWNhLzCBwwYIKwYB
	BQUHAgIwgbYagbNSZWxpYW5jZSBvbiB0aGlzIGNlcnRpZmljYXRlIGJ5IGFueSBwYXJ0
	eSBhc3N1bWVzIGFjY2VwdGFuY2Ugb2YgdGhlIHRoZW4gYXBwbGljYWJsZSBzdGFuZGFy
	ZCB0ZXJtcyBhbmQgY29uZGl0aW9ucyBvZiB1c2UsIGNlcnRpZmljYXRlIHBvbGljeSBh
	bmQgY2VydGlmaWNhdGlvbiBwcmFjdGljZSBzdGF0ZW1lbnRzLjANBgkqhkiG9w0BAQUF
	AAOCAQEAXDaZTC14t+2Mm9zzd5vydtJ3ME/BH4WDhRuZPUc38qmbQI4s1LGQEti+9HOb
	7tJkD8t5TzTYoj75eP9ryAfsfTmDi1Mg0zjEsb+aTwpr/yv8WacFCXwXQFYRHnTTt4sj
	O0ej1W8k4uvRt3DfD0XhJ8rxbXjt57UXF6jcfiI1yiXV2Q/Wa9SiJCMR96Gsj3OBYMYb
	WwkvkrL4REjwYDieFfU9JmcgijNq9w2Cz97roy/5U2pbZMBjM3f3OgcsVuvaDyEO2rpz
	GU+12TZ/wYdV2aeZuTJC+9jVcZ5+oVK3G72TQiQSKscPHbZNnF5jyEuAF1CqitXa5PzQ
	CQc3sHV1IQ==
	</data>
	<key>FairPlaySignature</key>
	<data>
	EchroJ5sdt+K+mCTLn66SvammVQuJLJRmW61HZ0cU2LWhVSF/pVx8jUpPFSB6pBB4auS
	buyApRsECKoKA+y3ornlJi0nrAm95MCKzbn6oICJMf/UnB6nsM1cTXEEhl9Ys/igUjdQ
	cdXXHEP3BsD10qAigYEl0AAw3yfA4cHDsMs=
	</data>
</dict>'),
    CURLOPT_HTTPHEADER => array(
        "User-Agent: iOS Device Activator (MobileActivation-20 built on Jan 15 2012 at 19:07:28)",
        "Expect: 100-continue"
    ),
));
$curlResponse = curl_exec($curl);
curl_close($curl);
//=======================================================================================================================================//

//Cargar la respuesta de curl a variable 

$encodedAlbertResponse = new DOMDocument;
$encodedAlbertResponse->loadXML($curlResponse);

//Imprimir respuesta de curl

$decodedAlbertResponse = base64_decode($encodedAlbertResponse->getElementsByTagName('data')->item(0)->nodeValue);
$FairPlayKeyData = $encodedAlbertResponse->getElementsByTagName('data')->item(2)->nodeValue; //OK
$deviceCertificate = $encodedAlbertResponse->getElementsByTagName('data')->item(1)->nodeValue; //OK
$accountTokenCertificate = $encodedAlbertResponse->getElementsByTagName('data')->item(0)->nodeValue;

//sacar el tiket del wildcard
$accountTokenDecodedAlbert = base64_decode($encodedAlbertResponse->getElementsByTagName('data')->item(3)->nodeValue);
$WildcardTicket = explode('"WildcardTicket" = "', $accountTokenDecodedAlbert)[1];
$WildcardTicket5 = explode('";', $WildcardTicket)[0];

$FPKD = $FairPlayKeyData;

$accountToken=
'{'.
	(isset($imei) ? "\n\t".'"InternationalMobileEquipmentIdentity" = "'.$imei.'";' : '').
	"\n\t".'"ActivityURL" = "https://albert.apple.com/deviceservices/activity";'.
	"\n\t".'"SerialNumber" = "'.$serial.'";'.
	"\n\t".'"ProductType" = "'.$ProductType.'";'.
	(isset($meid) ? "\n\t".'"MobileEquipmentIdentifier" = "'.$meid.'";' : '').
	"\n\t".'"UniqueDeviceID" = "'.$uniqueDiviceID.'";'.
	"\n\t".'"ActivationRandomness" = "'.$activationRandomness.'";'.
	"\n\t".'"CertificateURL" = "https://albert.apple.com/deviceservices/certifyMe";'.
	($deviceType == "iPhone" ? "\n\t".'"PhoneNumberNotificationURL" = "https://albert.apple.com/deviceservices/phoneHome";' : '').
	"\n\t".'"WildcardTicket" = "'.$WildcardTicket5.'";'."".
	"\n".
'}';

$FactoryKey = 'LS0tLS1CRUdJTiBSU0EgUFJJVkFURSBLRVktLS0tLQ0KTUlJQ1hRSUJBQUtCZ1FDelltWHNTTjNkN1VUVThmNzd3bTlDMElJSkF3Q21BZWl4QndrbVd4SmwyMzlSRmU5UA0KUmJPUHprMFdIVGlFQVJCWFRveHg0VjdlWnhSMTJraWFURy93UldWbTZKeTFva3owVThIc21HS1FzSlMrRXZLZw0KckZ4M0ZnZHpjbHFYdWxCT1p6QlNIdkF3VG8reXBOUFIrdmhtZVllUkw2SHZUdVpCalpRWUtlRHl6d0lEQVFBQg0KQW9HQkFLTDd2ekZORDFDcFdJWEdEZTkrdklwUFdpYUg5Tm5nR0NSb0NSY3hYZWp2NHFDd3Rrc25RRHRqck1Sdg0KN2o1NW5QaEdaUEsvV3V2bGFrQ2VBS000MmVaRi9xMmdSQmVBWkpOUWtTSEJXOWQvT0V0N2JsYTkyRmorOElqUA0KQTNjUStleW8vS3lOdEY2T0w5S0U2Z2hNc2tLc0dCa2RNWmtESkhNeFZ1K3NLMzVwQWtFQTNRQmJPd0I0dFBkSw0KNHcrUnd1Zm9UbW1TRHhUR081dXZwc0JSbkZRNEswczNXZlBqaHVtRFFSQmVpYytIeFREWTcyTzEvaURwVGJMOQ0KcFRXNGY1cWVzd0pCQU0vSzEwOGEzNzBEeWJBODdGWVZ2TURPR0JKc3VkSXpMTGhOajRlUDRwTzIrRGFpOTU1WQ0KcVhURjFudGxPWDdsRDczUVlGeXJmcnZNcVdqNDNpM2xhWFVDUUZVeW12a1BBSG03VCtwakNTMWJXK3BHdHFFTA0Kd0RRZ204R3NLSW9jeVo2Zkc1S1kvQ0Q1aXJrZGgyU1hWZDhHS3N0MjVDVTVLTmZrWmZZMzFJMlUzUk1DUVFDNA0KRHFHSE5YUEgxb29ack8xZkYyUVptTFNqNVdEM3UxSzZjaUZYMy9EQURVdHlBZ3E2WFNqRkFkVUplbEZpZ0gzZw0KRWFxNWkwTDRFTUppOUViQmVydGRBa0FkTWVmNVNOa2dlMjZucTdueWxxMC9tVkEwc0VQVEEvYlNBTXJaRFZnVg0KNFVCTFhxMTJ5MXBRQXJKLzhyemtkTDR4NmZhazUwcXp1cEFhL0plcjhraWUNCi0tLS0tRU5EIFJTQSBQUklWQVRFIEtFWS0tLS0t';

$private=base64_decode($FactoryKey);

$pkeyid = openssl_pkey_get_private($private);

openssl_sign($accountToken, $signature, $pkeyid);

openssl_free_key($pkeyid);

$accountTokenBase64= base64_encode($accountToken);

$accountTokenSignature= base64_encode($signature);

// "¿" <key>RegulatoryInfo</key><data>eyJtYW51ZmFjdHVyaW5nRGF0ZSI6IjIwMTgtMDItMDFUMDE6MDc6NTZaIiwiZWxhYmVsIjp7ImJpcyI6eyJyZWd1bGF0b3J5IjoiUi00MTA5NDg5NyJ9fX0=</data> "?"

$activationrecord =
'<plist version="1.0">
<dict>
	<key>iphone-activation</key>
	<dict>
		<key>LDActivationVersion</key>
		<integer>2</integer>
		<key>activation-record</key>
		<dict>
			<key>AccountTokenCertificate</key>
			<data>'.$accountTokenCertificate.'</data>
			<key>DeviceCertificate</key>
			<data>'.$deviceCertificate.'</data>
			<key>FairPlayKeyData</key>
			<data>'.$FPKD.'</data>
			<key>AccountToken</key>
			<data>'.$accountTokenBase64.'</data>
			<key>AccountTokenSignature</key>
			<data>'.$accountTokenSignature.'</data>
			<key>unbrick</key>
			<true/>
		</dict>
		<key>show-settings</key>
		<true/>
	</dict>
</dict>
</plist>';
header('Content-Type: application/xml');
header('ARS: S3ReFz/yLSkuM33VbNhgsw==');
header('Cache-Control: private, no-cache, no-store, must-revalidate, max-age=0');
header('Content-Length: '.strlen($activationrecord));
echo $activationrecord;
file_put_contents(''.$folder.'activity.plist',$activationrecord);
die();
?>
