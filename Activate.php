<?php
$activation= (array_key_exists('activation-info-base64', $_POST)
                          ? base64_decode($_POST['activation-info-base64'])
                          : array_key_exists('activation-info', $_POST) ? $_POST['activation-info'] : '');
if(!isset($activation) || empty($activation)) { header('location: https://LOCALIZACIÃ“N DE PAGINA DE ERROR DE SU SERVIDOR/404.html'); exit('404'); }

$encodedrequest = new DOMDocument;
$encodedrequest->loadXML($activation);

$decodedrequest = new DOMDocument;
$decodedrequest->loadXML(base64_decode($encodedrequest->getElementsByTagName('data')->item(0)->nodeValue));
$nodes = $decodedrequest->getElementsByTagName('dict')->item(0)->getElementsByTagName('*');

for ($i = 0; $i < $nodes->length - 1; $i=$i+2) {
	switch ($nodes->item($i)->nodeValue) {
		case "ActivationRandomness": $activationRandomness = $nodes->item($i + 1)->nodeValue; break;
		case "DeviceCertRequest": $deviceCertRequestBase64 = base64_decode($nodes->item($i + 1)->nodeValue); break;
		case "DeviceClass": $deviceType = $nodes->item($i + 1)->nodeValue; break;
		case "SerialNumber": $Number = $nodes->item($i + 1)->nodeValue; break;
		case "UniqueDeviceID": $uniqueDiviceID = $nodes->item($i + 1)->nodeValue; break;
		case "InternationalMobileEquipmentIdentity": $imei = $nodes->item($i + 1)->nodeValue; break;
		case "InternationalMobileSubscriberIdentity": $imsi = $nodes->item($i + 1)->nodeValue; break;
		case "IntegratedCircuitCardIdentity": $iccid = $nodes->item($i + 1)->nodeValue; break;
		case "UniqueChipID": $ucid = $nodes->item($i + 1)->nodeValue; break;
		case "ProductType": $ProductType = $nodes->item($i + 1)->nodeValue; break;
		case "ActivationState": $activationState = $nodes->item($i + 1)->nodeValue; break;
		case "ProductVersion": $productVersion = $nodes->item($i + 1)->nodeValue; break;
		case "MobileEquipmentIdentifier": $meid = $nodes->item($i + 1)->nodeValue; break;
		case "BasebandSerialNumber": $baseSerial = $nodes->item($i + 1)->nodeValue; break;
		case "EthernetAddress": $EthernetAddress = $nodes->item($i + 1)->nodeValue; break;
		case "BluetoothAddress": $BluetoothAddress = $nodes->item($i + 1)->nodeValue; break; 
	}
}
//----------------------------------------------------------------------FairPlayKeyData---------------------------------------------------------------------------------------------------//

$fairPlayKeyData = "LS0tLS1CRUdJTiBDT05UQUlORVItLS0tLQpBQUVBQVRRVHdOS1loa1B3UDVDVlF5Ly9kYWpqMUxlMm81Q2MzV0hUSlhKdmZNVWR0bG5yOGl3T29KMVFKZkpHClpJaWF5L2dib0t2Yzc4dzZTMTh6Q0FnMVpqdENCelhubGtmNjN0Z0wwOTF3bzA4SjFYTzY1Z0VwbDNURUxqV2EKcldMSnNCbm96ZHc0RGtHZHgybzhIRi95UTFvUTljVkxRZC8xL1I2d29oUVdNRFVqS3IrWnRMUUY5Z2lsUEdzdAptQ0NGTW5nRytWZEIzdGNsVVNWUGFoSmpDZmdqSjU1eVZOZkRJVVdRSXBwVUR3OG13U1kzWlYxb1ZKY3pGWEVYCnJNUnN6LzBwMVVGRWpmRDdCci9wQkdGUUxIRVV3cjVxRmw0anM3WUxxUjQ0WVdFSmtoalo3UUF0NXAxWWVsWDIKVS95SERYZWNLUiswdDk3UUFSS1JGTEpRbGZNNnREVW9mUXlhL0o5Y0tqYTNyYncyS3VERVpjS1J6cDlHR0wyZgpqWGFjTEt6MDRIdGpmb3VBRWE5OW9uZTdrUTJ4YTFQcGxzTWdMY2VwMVhWL0tHaExvL2I0MWNrYm8wTXhkSzVtCm9sOXpBdHRyb2pwRkJUZXFMeGFxbGRUQVVxUjJMdVhBRzUrUTIzYXl5MzR0MEJmWS9NRFc4L3BvamlqZmhFRGMKekR4NWtlVmkxZ0NHSHlVb1BMa1FvYXh2aHBLdFFJOG5jMGYya1Q5VGtiaENkeTJ2N2dEMXV2U1o3SEw2aEZBVwphcFB4UWxKZjlDclh1SHZhZUMxTGZmNlpXQitlSmxVcG1DTzFNV1lnL0xlMGQrMTRpSnU0b3pmb3pMWlB1WmJTCkZISkM0c1Vrbk50Vmd4OVFIS2dTdWkzNWh1UFlhSFM3OHV1NExyZVZFZHFjdE42R0I2UW01a0k3UGdZMGlNdUgKcW9HUGhNL3F0Vms2NS83TVNMQTkvck84WnRKa2xlWkpiQnNUYmJzS2dFd1NKdU5EaGt5TVVzdWlReGllOEJMMwo0N242UnkvcWJHeFJUQ05oY3VIT05nRVlxekUwaVZTQ2FXb0JzN0Q1Tm11Q2ZEVFdMNjNhQzQ4a2FLeFNYVXJIClhHd3ZqTC9DOFBENkdDckQzU2dpMDJjMU9CNDhCUHZwWmRKY0pQbXYwSWNRUURUOUZ5UzYvSDMzQzlsWm42Y24KY1h1N0tOcXc2ZGRwNFErN0ZnQ0RWY0xucmk5TE4rczVMTGszSDJ1d3F6dGw0dkxTV3FkZG9jZkY4SDI1UTc5ZAp2VDNtRmRtOWJwS3B3YUZ3UGZnZCtabVJNWTViQmI2SXp2OTQ5Ymx6enRvd0pRam5DeHhFMVVWU0FoQlhSeG80Ckg3UjNubjU5RjJwTHQ3N0F3d2dheEpJUVNVa3preUg0d05FMDNyMFFma1JKaHBrTUlxQkwzeTBKeU5pK0p2TkIKTFhiSlRLWHN0QnZ1RmxnNFhHL3puMityMHJKUmZINHFnT25ib0FXT0lZNDhPNEZ6NjdpNHFHdjRCV1U2SktkSApDRWxQMEJwMklZM0MzVGFzMkc5UmxTNnYwY2Q5V3pFRkJ1bFY5WEt6TXdpMjZNOGMvU0xwcTl3aEIwZXdwVmxTClhXS241V09oM2gySGhQSUJpTVBvaE01blBpUUhUaDJyMGFyaXczYXNkMUVoaDA3RTdxanBxUmFuQmhuMnIwUTAKUzVFeHJBVldjYnYzVnVYWHVyL2RjWHByNjI3dHNUbi9VanlFZEd6a2NyeFllZUZPTW04NTdwSXlhRkc3SG50MQpJdUtmTnM0NlFOQURidHR1QzFGRm5RKzY2UzRWejQ0dTJ3OENEb2RoSGF3YWN2VmlTQktTNWVvbER5NWhjb1BECnBoUk1qem5jc2UzdVh6djgwNDNpc2E2amZLdEEyNUx2L1lYSzlKMFdkbmZvNUcyK0NDWk5BYUxzUFJHY0g2U1IKYk02Wk5YNlNzZkZJckU3SGMwMDdIcUJxTzJKUXZhbjdpRWJ0N3ordGtHbWJmaUhPCi0tLS0tRU5EIENPTlRBSU5FUi0tLS0tCg==";
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

//----------------------------------------------------------------------WildcardTicket---------------------------------------------------------------------------------------------------//
@$wildcard = 'MIIBlQIBATALBgkqhkiG9w0BAQUxYJ8BCsrZeufQAThIG8An0sUfFzzUmfD1AC77A9LdHD+2fTzQrqfh20HATlyABKWZp+XPQwAAAAA7u7u7u7u7u+flz4EAAAAAJ+XPwQBAAAAn5dABAEAAACfl0wEAAAAAASBgDKLTvYEgn6wwImK74yHjsaOmbKpOwzK+zM+7Iq0u/j601/yeUqroO0352v8NpEA84yWivTZSslUPpp8rovFwvCiQ7ksw/+6GK+aXcocOzFnO5Bugaj/vNo5PkB4kUneMk9XX0W0niuRVJdVJ/bHZwkcmrF7htyyawR9jd4n4XCao4GdMAsGCSqGSIb3DQEBAQOBjQAwgYkCgYEA7To/ZNHoIJzBUgY0734vsgl+ACxDQ+f4quvmSrPAtgDENSZwaVrHXpF+cRKBABqkDa00YcENx2dtS1tuHLKDNn1zMZLaZRpiK9UeiMPNZL6mlg12BWLwVjlFOGED8U6pfXwOw6D/FCDRgvyGBn7wsw8sEa7AdlYmMHGmkvwgOP0CAwEAAQ==';

$accountToken=
'{'.
	(isset($imei) ? "\n\t".'"InternationalMobileEquipmentIdentity" = "'.$imei.'";' : '').
	(isset($meid) ? "\n\t".'"MobileEquipmentIdentifier" = "'.$meid.'";' : '').
	"\n\t".'"SerialNumber" = "'.$Number.'";'.
	"\n\t".'"InternationalMobileSubscriberIdentity" = "'.@$imsi.'";'.
	"\n\t".'"ProductType" = "'.$ProductType.'";'.
	"\n\t".'"UniqueDeviceID" = "'.$uniqueDiviceID.'";'.
	"\n\t".'"ActivationRandomness" = "'.$activationRandomness.'";'.
	"\n\t".'"ActivityURL" = "https://albert.apple.com/deviceservices/activity";'.
	"\n\t".'"IntegratedCircuitCardIdentity" = "'.@$iccid.'";'.
	($deviceType == "iPhone" ? "\n\t".'"CertificateURL" = "https://albert.apple.com/deviceservices/certifyMe";' : '').
	($deviceType == "iPhone" ? "\n\t".'"PhoneNumberNotificationURL" = "https://albert.apple.com/deviceservices/phoneHome";' : '').
	"\n\t".'"WildcardTicket" = "'.@$wildcard.'";'.
	"\n".
'}';

	
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------FactoryActivationKey----------------------------------------------------------------------------------------------//
$private='-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQCzYmXsSN3d7UTU8f77wm9C0IIJAwCmAeixBwkmWxJl239RFe9P
RbOPzk0WHTiEARBXToxx4V7eZxR12kiaTG/wRWVm6Jy1okz0U8HsmGKQsJS+EvKg
rFx3FgdzclqXulBOZzBSHvAwTo+ypNPR+vhmeYeRL6HvTuZBjZQYKeDyzwIDAQAB
AoGBAKL7vzFND1CpWIXGDe9+vIpPWiaH9NngGCRoCRcxXejv4qCwtksnQDtjrMRv
7j55nPhGZPK/WuvlakCeAKM42eZF/q2gRBeAZJNQkSHBW9d/OEt7bla92Fj+8IjP
A3cQ+eyo/KyNtF6OL9KE6ghMskKsGBkdMZkDJHMxVu+sK35pAkEA3QBbOwB4tPdK
4w+RwufoTmmSDxTGO5uvpsBRnFQ4K0s3WfPjhumDQRBeic+HxTDY72O1/iDpTbL9
pTW4f5qeswJBAM/K108a370DybA87FYVvMDOGBJsudIzLLhNj4eP4pO2+Dai955Y
qXTF1ntlOX7lD73QYFyrfrvMqWj43i3laXUCQFUymvkPAHm7T+pjCS1bW+pGtqEL
wDQgm8GsKIocyZ6fG5KY/CD5irkdh2SXVd8GKst25CU5KNfkZfY31I2U3RMCQQC4
DqGHNXPH1ooZrO1fF2QZmLSj5WD3u1K6ciFX3/DADUtyAgq6XSjFAdUJelFigH3g
Eaq5i0L4EMJi9EbBertdAkAdMef5SNkge26nq7nylq0/mVA0sEPTA/bSAMrZDVgV
4UBLXq12y1pQArJ/8rzkdL4x6fak50qzupAa/Jer8kie
-----END RSA PRIVATE KEY-----';
$pkeyid = openssl_pkey_get_private($private);
openssl_sign($accountToken, $signature, $pkeyid);
openssl_free_key($pkeyid);
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

//------------------------------------------------------------------AccountTokenCertificate------------------------------------------------------------------------------------------//

$accountTokenCertificateBase64 =base64_encode('-----BEGIN CERTIFICATE-----
MIIDZzCCAk+gAwIBAgIBAjANBgkqhkiG9w0BAQUFADB5MQswCQYDVQQGEwJVUzET
MBEGA1UEChMKQXBwbGUgSW5jLjEmMCQGA1UECxMdQXBwbGUgQ2VydGlmaWNhdGlv
biBBdXRob3JpdHkxLTArBgNVBAMTJEFwcGxlIGlQaG9uZSBDZXJ0aWZpY2F0aW9u
IEF1dGhvcml0eTAeFw0wNzA0MTYyMjU1MDJaFw0xNDA0MTYyMjU1MDJaMFsxCzAJ
BgNVBAYTAlVTMRMwEQYDVQQKEwpBcHBsZSBJbmMuMRUwEwYDVQQLEwxBcHBsZSBp
UGhvbmUxIDAeBgNVBAMTF0FwcGxlIGlQaG9uZSBBY3RpdmF0aW9uMIGfMA0GCSqG
SIb3DQEBAQUAA4GNADCBiQKBgQDFAXzRImArmoiHfbS2oPcqAfbEv0d1jk7GbnX7
+4YUlyIfprzBVdlmz2JHYv1+04IzJtL7cL97UI7fk0i0OMY0al8a+JPQa4Ug611T
bqEt+njAmAkge3HXWDBdAXD9MhkC7T/9o77zOQ1oli4cUdzlnYWfzmW0PduOxuve
AeYY4wIDAQABo4GbMIGYMA4GA1UdDwEB/wQEAwIHgDAMBgNVHRMBAf8EAjAAMB0G
A1UdDgQWBBShoNL+t7Rz/psUaq/NPXNPH+/WlDAfBgNVHSMEGDAWgBTnNCouIt45
YGu0lM53g2EvMaB8NTA4BgNVHR8EMTAvMC2gK6AphidodHRwOi8vd3d3LmFwcGxl
LmNvbS9hcHBsZWNhL2lwaG9uZS5jcmwwDQYJKoZIhvcNAQEFBQADggEBAF9qmrUN
dA+FROYGP7pWcYTAK+pLyOf9zOaE7aeVI885V8Y/BKHhlwAo+zEkiOU3FbEPCS9V
tS18ZBcwD/+d5ZQTMFknhcUJwdPqqjnm9LqTfH/x4pw8ONHRDzxHdp96gOV3A4+8
abkoASfcYqvIRypXnbur3bRRhTzAs4VILS6jTyFYymZeSewtBubmmigo1kCQiZGc
76c5feDAyHb2bzEqtvx3WprljtS46QT5CR6YelinZnio32jAzRYTxtS6r3JsvZDi
J07+EHcmfGdpxwgO+7btW1pFar0ZjF9/jYKKnOYNyvCrwszhafbSYwzAG5EJoXFB
4d+piWHUDcPxtcc=
-----END CERTIFICATE-----');


//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

//------------------------------------------------------------------DeviceCertificate--------------------------------------------------------------------------------------------------//

$deviceCertificate =base64_encode('-----BEGIN CERTIFICATE-----
MIIC8jCCAlugAwIBAgIJEJHd0JRzm8EzMA0GCSqGSIb3DQEBBQUAMFoxCzAJBgNV
BAYTAlVTMRMwEQYDVQQKEwpBcHBsZSBJbmMuMRUwEwYDVQQLEwxBcHBsZSBpUGhv
bmUxHzAdBgNVBAMTFkFwcGxlIGlQaG9uZSBEZXZpY2UgQ0EwHhcNMjEwNTExMDcz
OTE2WhcNMjQwNTExMDczOTE2WjCBgzEtMCsGA1UEAxYkODBDNzZBNEItQ0ZBQS00
RjMzLUFFODAtMzkyMzY3QzA2NDA3MQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0Ex
EjAQBgNVBAcTCUN1cGVydGlubzETMBEGA1UEChMKQXBwbGUgSW5jLjEPMA0GA1UE
CxMGaVBob25lMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDXgdMOH0HDK9nF
XwqG96EltZcUm6BgxHx5AQVVbm0tFDXrz0IOLdmSUOSJHFeglq5w/42UwgVQiV+r
AowEdpPvpFe9Q86cJoluflpjqDwAMCcJfJ8VNasK+IFhREGh6GDmcf7oIJwH/ASf
ukUUWbcmacZy0TRKs9eSG3RgPhCe/wIDAQABo4GVMIGSMB8GA1UdIwQYMBaAFLL+
ISNEhpVqedWBJo5zENinTI50MB0GA1UdDgQWBBQLZ+74IqRmVsbkIIz9rWr5iuBt
qDAMBgNVHRMBAf8EAjAAMA4GA1UdDwEB/wQEAwIFoDAgBgNVHSUBAf8EFjAUBggr
BgEFBQcDAQYIKwYBBQUHAwIwEAYKKoZIhvdjZAYKAgQCBQAwDQYJKoZIhvcNAQEF
BQADgYEAUFO9keS050dZYDLk9vH4pX/wDNZTW3ONQqOcKnW1GLR20Qnni0hCTtKE
4DDvoMnT1EyPvSrdg21DifuXa1/YWRhaRjh7ZTCTHsvktnv5ODaS1mucvbJq/hMM
7M97i2kMG6aGutuxM1XcPAHr3LEBJ256foKJ1Mo7+vDuUIX1/jA=
-----END CERTIFICATE-----');
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

//------------------------------------------------------------CodificaciÃ³n de AccountToken y AccountTokenSignature--------------------------------------------------------//
$accountTokenBase64= base64_encode($accountToken);
$accountTokenSignature= base64_encode($signature);
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//


//----------------------------------------------------------------activation_record.plist-----------------------------------------------------------------------------------------------//
$signos=base64_decode('J4F6cKeBJGUiIowkJw');
$uniquefinalroot='LS0tLS1CRUdJTiBDRVJUSUZJQ0FURS0tLS0tDQpNSUlDRnpDQ0FaeWdBd0lCQWdJSU9jVXFROElDL2hzd0NnWUlLb1pJemowRUF3SXdRREVVTUJJR0ExVUVBd3dMDQpVMFZRSUZKdmIzUWdRMEV4RXpBUkJnTlZCQW9NQ2tGd2NHeGxJRWx1WXk0eEV6QVJCZ05WQkFnTUNrTmhiR2xtDQpiM0p1YVdFd0hoY05NVFl3TkRJMU1qTTBOVFEzV2hjTk1qa3dOakkwTWpFME16STBXakJGTVJNd0VRWURWUVFJDQpEQXBEWVd4cFptOXlibWxoTVJNd0VRWURWUVFLREFwQmNIQnNaU0JKYm1NdU1Sa3dGd1lEVlFRRERCQkdSRkpFDQpReTFWUTFKVUxWTlZRa05CTUZrd0V3WUhLb1pJemowQ0FRWUlLb1pJemowREFRY0RRZ0FFYURjMk8vTXJ1WXZQDQpWUGFVYktSN1JSem42NkIxNC84S29VTXNFRGI3bkhrR0VNWDZlQyswZ1N0R0hlNEhZTXJMeVdjYXAxdERGWW1FDQpEeWtHUTN1TTJhTjdNSGt3SFFZRFZSME9CQllFRkxTcU9rT3RHK1YremdvTU9CcTEwaG5MbFRXek1BOEdBMVVkDQpFd0VCL3dRRk1BTUJBZjh3SHdZRFZSMGpCQmd3Rm9BVVdPL1d2c1dDc0ZUTkdLYUVyYUwyZTNzNmY4OHdEZ1lEDQpWUjBQQVFIL0JBUURBZ0VHTUJZR0NTcUdTSWIzWTJRR0xBRUIvd1FHRmdSMVkzSjBNQW9HQ0NxR1NNNDlCQU1DDQpBMmtBTUdZQ01RRGY1ek5paUtOL0pxbXMxdyszQ0RZa0VTT1BpZUpNcEVrTGU5YTBValdYRUJETDBWRXNxL0NkDQpFM2FLWGtjNlIxMENNUURTNE1pV2l5bVkrUnhrdnkvaGljRERRcUkvQkwrTjNMSHF6SlpVdXcyU3gwYWZEWDdCDQo2THlLaytzTHE0dXJrTVk9DQotLS0tLUVORCBDRVJUSUZJQ0FURS0t';
$beging='-----BEGING CERTIFICATE-----';
$endcer='-----END CERTIFICATE-----';
$unique='0‚Æ0‚k a/¨‘î0
*†HÎ=0E10U
California10U

Apple Inc.10UFDRDC-UCRT-SUBCA0
180125232032Z
180201233032Z0n10U
California10U

Apple Inc.10Uucrt Leaf Certificate1"0 U00008015-001C0C1124D3002E0Y0*†HÎ=*†HÎ=B ¯£tøyÀY:É°d…üŽÖ÷I^S'.$signos.'ÝëJÑø”ŸøZe=¶Ý@º!&ìÜÚ6ÉuSoV£‚0‚0Uÿ0 0Uÿð0÷	*†H†÷cd
é1æÿ„š¡’P
0CHIP €ÿ„ª’D0ECID$Ó .ÿ†“µÂc0bmac'.$BluetoothAddress.'ÿ†ËµÊi0imei'.$imei.'ÿ‡›ÉÜm0srnm'.$Number.'ÿ‡«‘Òd200udid('.$uniqueDiviceID.'ÿ‡»µÂc0wmac'.$BluetoothAddress.'
*†HÎ=I 0F! M˜<JM#rÖ‰žhD|µ5 öâÂ ÝàÔ‘åÏ˜;w! ë!õ†»¾yóyÒÂ<Ó‘<h 
¶>ƒàÔò2m';
$unique=base64_encode($unique);
$keygen='ukMtH9RdSQvHzBx7FiBGr7/KcmlxX/XwoWeWnWb6IRM=';
$uniquefinal=base64_encode(
''.$beging.'
'.$unique.'
'.$endcer.''.$keygen.'
');
$activationrecord='
<plist version="1.0">
<dict>
	<key>iphone-activation</key>
	<dict>
		<key>unbrick</key>
		<true/>
		<key>activation-record</key>
		<dict>
			<key>AccountTokenCertificate</key>
			<data>'.$accountTokenCertificateBase64.'</data>
			<key>AccountToken</key>
			<data>'.$accountTokenBase64.'</data>
			<key>AccountTokenSignature</key>
			<data>'.$accountTokenSignature.'</data>
			<key>DeviceCertificate</key>
			<data>'.$deviceCertificate.'</data>
			<key>FairPlayKeyData</key>
			<data>'.$fairPlayKeyData.'</data>
			<key>LDActivationVersion</key>
			<integer>2</integer>
			<key>UniqueDeviceCertificate</key>
			<data>'.$uniquefinal.'LS0tLS1CRUdJTiBDRVJUSUZJQ0FURS0tLS0tCk1JSUNGekNDQVp5Z0F3SUJBZ0lJT2NVcVE4SUMvaHN3Q2dZSUtvWkl6ajBFQXdJd1FERVVNQklHQTFVRUF3d0wKVTBWUUlGSnZiM1FnUTBFeEV6QVJCZ05WQkFvTUNrRndjR3hsSUVsdVl5NHhFekFSQmdOVkJBZ01Da05oYkdsbQpiM0p1YVdFd0hoY05NVFl3TkRJMU1qTTBOVFEzV2hjTk1qa3dOakkwTWpFME16STBXakJGTVJNd0VRWURWUVFJCkRBcERZV3hwWm05eWJtbGhNUk13RVFZRFZRUUtEQXBCY0hCc1pTQkpibU11TVJrd0Z3WURWUVFEREJCR1JGSkUKUXkxVlExSlVMVk5WUWtOQk1Ga3dFd1lIS29aSXpqMENBUVlJS29aSXpqMERBUWNEUWdBRWFEYzJPL01ydVl2UApWUGFVYktSN1JSem42NkIxNC84S29VTXNFRGI3bkhrR0VNWDZlQyswZ1N0R0hlNEhZTXJMeVdjYXAxdERGWW1FCkR5a0dRM3VNMmFON01Ia3dIUVlEVlIwT0JCWUVGTFNxT2tPdEcrVit6Z29NT0JxMTBobkxsVFd6TUE4R0ExVWQKRXdFQi93UUZNQU1CQWY4d0h3WURWUjBqQkJnd0ZvQVVXTy9XdnNXQ3NGVE5HS2FFcmFMMmUzczZmODh3RGdZRApWUjBQQVFIL0JBUURBZ0VHTUJZR0NTcUdTSWIzWTJRR0xBRUIvd1FHRmdSMVkzSjBNQW9HQ0NxR1NNNDlCQU1DCkEya0FNR1lDTVFEZjV6TmlpS04vSnFtczF3KzNDRFlrRVNPUGllSk1wRWtMZTlhMFVqV1hFQkRMMFZFc3EvQ2QKRTNhS1hrYzZSMTBDTVFEUzRNaVdpeW1ZK1J4a3Z5L2hpY0REUXFJL0JMK04zTEhxekpaVXV3MlN4MGFmRFg3Qgo2THlLaytzTHE0dXJrTVk9Ci0tLS0tRU5EIENFUlRJRklDQVRFLS0tLS0</data>
		</dict>
		<key>show-settings</key>
		<true/>
	</dict>
</dict>
</plist>';
header('Content-type: application/xml');
header('Content-Length: '.strlen($activationrecord));
echo $activationrecord;
die();
?>
