<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016101800717585",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEogIBAAKCAQEAlp6frt3OqBD7kwWPbqjI189LsF3N+i8lra5161WnQyiEvHd/IkcKASdw8/1LEkFsnJ27ixejjKm7oPxerIcr1guvasbvUiWgr/fOO7khX7un8E4LOwcmWV3JyTO5AS1bfYsnCm2YMmn1zNpfCJRwBgCl8ZfEhFxxMZZK6G6KJokbnq3eFIqgsKyf3qOWYo1BJazyCZuBE9osmp/W6wJeI4uOfH/CnohW5iyVxn1cLFdu9I2oIsL0F+dtUv1XHPE53NA6fGUsYnWAo1jylv9Jjnfxkr1Ds80ZS3X9C7RBUCAcgMJKxyqOdeIqPA4062nYHIA23Zkmbf1qfXjS3AFrbwIDAQABAoIBAAGxBloQY6G/jxO3nETB4H+L9G2moAmPPf0VWH2sGJTIf7UeIm9gHNymdL5Iue8ajP21R8XoHg4WWeUU8Hs/iV5+AxpP4aAqjANt5QMGsTlCAkDQn4+qJOQcCYgY7Jr2x3BBf86+LFdkmT4Ttb2C7T8kArkT20EhSKQl6/FwTFziaNKsIvrKyv6GrOqmMb1BTXSjHT0etQknNIS//5MFXqfZJJ5zDumu9rwYbC81Gjc6KPRbvngsQUdAt7K0jQY1k0DwGRZLf/GHANLadWqW6pMAQJ+oK3a6urQJ5DSdAqoVARklGwO2cm6FA5XgLypL2AnudgJSPsu0Ghw97SIbawECgYEA6c0k048e1UhDp1kiHAmxMQBL5Y+gjytv4np4nzvbGKYqYZHcU821zIjK6aPpXVFOr1WIME8zzqWfT3zooRx+5vErvg6K5ThA2PFzmDQ/+kh/LY8qlWIBnl/lM/5VBcG2ZfTbxmVhxKeDQRVvOat4FAQNAGkFSeuIn270zZzCyrMCgYEApOui5rhIY/4XE+MITKAmQCq/AUO8+k3liL/5MRGbjs4lL9dFvdyxAPPvfPWb2Sz9jgyxAZgtQA1p322lgCwQbHssISl5f9ngW+swY8Khr/9sX98fgi4/2fUZDFrcs4YuLA9OzzpRyBQg9g8MiEzPj//tqw2IV6hno/sGUyYCalUCgYB/+OnPYuddltBxKTiiYCu8xozEenlH5F65eI/NmNW0CD/qaAxRUqfP7JAkkrOJgJexIQAKcU/KLJ2mxJgQl6hegGORBCTCkqfsFz1OcksSk9wI8/Q7EAoSxiqO6wdev0k3RW+GiLebDJWrajAXQOPZEN6M+u8KJwIBQpp8cPGuQQKBgBHNJX5F8fppGNCatvCecMKIWqmmSCW0dsw1/I3hWqslcToiwHJn+esiaX1RfYsJoizNDeYgKPI7AGyPh0e4eeVbvj2uHmFAgUkqr8R048L9jRMkIGCK4XWDUTrWK/Bs0VsMI/OWVfGEyrIEmdO0hssCUwMdqNPdZ6J5nAsplSUpAoGABO+QHD4QeiNfqlkrCnGPEfLmkGBO/y+1zefaOJqeMQxZKq8veZwHUd8OwnCGoDIC3Adb3dh+6EJKTSqiCZKWgLcvT+rcLxad3/fmMYtnn907W9JO9utvBpgUqtWG+lbwKTqaOZW19DHqG96hsOSuXH38pGLZJrVQAo7dgZknlxU=",
		
		//异步通知地址
		'notify_url' => "http://工程公网访问地址/alipay.trade.wap.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://localhost/alipay/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do
		",
		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAg+1uBfYMQgf8IqbjOTwnkW3QhPtfdL5UBhMOAcDP+SuzjetGtH6gQgCF365ynLamzoNgfAVG6dj3xcWx2E4OzbGrxEJw+prdNUa2E0+RZjTTITRN1HlRInIlDIgZdsP2jlUISFbRSHhfIAhouOsnveNHHjRen1zzVeIatSvp57yB8TrHCrrKNta2yzVx6lwpsbTUFUQD5ykJrqfP45C2i/q2wiHVMBCmxyS9fRCcWFyxHHrxYU3uZBfm9ltQCb/scUorO2139+jEkllDWdkRlzxmvMaVntfmIp5DJzJjOfzS8xyF2wOd9f4FhdpEjVvuejiJsFE7I7qQs5BmXGmK8wIDAQAB",
		
	
);