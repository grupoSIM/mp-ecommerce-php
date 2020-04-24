<?php
// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042406-6aee9711d6bc4207c2dc79590031b6f0-469485398');

$merchant_order = null;

switch ($_GET["topic"]) {
    case "payment":
        $payment = MercadoPago\Payment::find_by_id($_GET["id"]);
        // Get the payment and the corresponding merchant_order reported by the IPN.
        $merchant_order = MercadoPago\MerchantOrder::find_by_id($payment->order->id);
        break;
    case "merchant_order":
        $merchant_order = MercadoPago\MerchantOrder::find_by_id($_GET["id"]);
        break;
}

date_default_timezone_set("America/Argentina/Buenos_Aires");
$log  = "Parametros = topic: " . $_GET['topic'] . ' - id: ' . $_GET['id'] . ' - PreferenceID: ' . $merchant_order->preference_id . ' - Fecha: ' . date(DATE_RSS) . PHP_EOL . '+++' . PHP_EOL;
file_put_contents('./log_' . date("Ynj") . '.log', $log, FILE_APPEND);
