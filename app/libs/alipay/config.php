<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016100100636217",

		//商户私钥
		'merchant_private_key' => "MIIEowIBAAKCAQEAxhR1IceK9m9TQANqHqYEU0zW89QDUdWDD0+kUPJvrVtlUTeCElfmzykK/E9y0+ZbTeV/hmFW6uNUOEcAx8vya1mcsPTI020fs4sE4A0JkRnPiVwsghtYoNFOrjy8sphROqpi6nMrkt8GLp4vHq0HYQDucjt/sx31vQhNxnGdvTd0K/rEXJFhHOcBK5gfms0vDX9BV8vTqqxQM287jvxuju7J30LEtaNndP7HvKq6GSfJVXvcWm520ZhOBAtfOZwjm9IfV6nTssOGalrYj4sdRNe0jM6eQ8uPR1dGTOg2TDka3DBuv5OBddK5pGaAswHxP5OH9QKRhwSdrQzzRnLhXwIDAQABAoIBAF/WdBnk7yJvGKuHO2ga0Urwiawtr3F/ycq1sP4NXuVUrD/QiJmReDZRWGRdmGRYN2MIIFyHakN5vD0Cdak1z1QLZpnjxesuCEGZiMFS7YcMIvMF6u8EhixBOT1qW65ZriuhVvyyvqlwSRBzLr873q8bgUM58H5ch5JvmxnhzP1IJlAe4QFF547qKxVgkD1Z79MSSBCb40g0ygEchj5u6k7oqfUIpwuBcAAl2097FdEhN22SyWbJGWfgsvMSFCwuadkQJCPZgxE6IzH4xGt+oGK9tSWiAuLvieJbauxOWmsJf64Yd/slCDdXIQvLnhl7dkFtJfoXu2FAIqTf3PTDpQkCgYEA6rJ4Cyo4uJUROj7Msf2ABgTD/MlOYP3jpfrnMV85WkDyAeL7k7Oq0BbtWu2ZFy+Kldl6XTdnwEAm53FJ5FRB8nSvVF8DkdmHvo0MKCMD5q4odY86Ha79AZhmtDHYmh8WZ2rC25CiPKPyKQSBSEjzCQos594DK8RjpvFZUxSFzKMCgYEA2A8iPKvJkxKq8pTk5RPXi5o2sW+DQOz/zf60j9OBfCFVZWdFKhRVjXb3ty/AwSVRFJbQ4PMhc2XBwb165njbZAL1geYbjGqwzS8Zd01psJEhGSnxNpSsmy7WHKPEE9ApqZrX7OoZrnMNWFZbewscPQdhDzwQp5dPi1MKtw/cCBUCgYB5WboUG8qkNf9oXFw+k9KESiaEKBossFnq0maD8raW4gm/y/tEjZt+aLxlTYDgqiZAAOjyFdnBX+o9tSf9tUs77/VP7KjN2uoDLq7geepkdhxZXKsx+e67ym8gML3MQtK0ulDyckBQlnx5lOi71WxEekxpvzNoh+z2vsfu2yerfQKBgQDH6xDx9L7bAJ3/Qnid4wNCIJrVCer4S5PTJwgqQToCAtICt1DPQ+t5r4g9D8maro3csERssWvVXGWxgENVOKVAYGCNJr986UfZQ+ibdJ0EDPYEU8PnjiA8o1TpQTtwXd//GNENXfwPaFQD1jxlmP0zFz3fG+QJPsASme9DPkCJlQKBgBVz5W4Uv4VJqBitkza2Vxcbr4HuaaVh+aDKM3vajJZedV1fMyQFIfdXex3dtNt79HetZl8ay1mGgmS90gikhVyy8nTycMEM1a/i/+lHdVzm9IjdoVJJBTZ8T1GTz6WXujeKJiMbeCjyOT/uli+LTWz7m0JI6h7r9/LFAAY5pOia",
		
		//异步通知地址
		'notify_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAxhR1IceK9m9TQANqHqYEU0zW89QDUdWDD0+kUPJvrVtlUTeCElfmzykK/E9y0+ZbTeV/hmFW6uNUOEcAx8vya1mcsPTI020fs4sE4A0JkRnPiVwsghtYoNFOrjy8sphROqpi6nMrkt8GLp4vHq0HYQDucjt/sx31vQhNxnGdvTd0K/rEXJFhHOcBK5gfms0vDX9BV8vTqqxQM287jvxuju7J30LEtaNndP7HvKq6GSfJVXvcWm520ZhOBAtfOZwjm9IfV6nTssOGalrYj4sdRNe0jM6eQ8uPR1dGTOg2TDka3DBuv5OBddK5pGaAswHxP5OH9QKRhwSdrQzzRnLhXwIDAQAB",
);