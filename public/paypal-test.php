<?php
echo "Testing PayPal Connection...<br>";

// Test DNS resolution
$host = 'api-m.sandbox.paypal.com';
$ip = gethostbyname($host);
echo "DNS Resolution for $host: " . ($ip === $host ? 'Failed' : "Success ($ip)") . "<br>";

// Test cURL connection
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://$host");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification for testing
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "HTTP Status: $httpCode<br>";
echo "cURL Error: " . ($error ?: 'None') . "<br>";
echo "Response: " . ($response ? 'Connected to PayPal' : 'No response');