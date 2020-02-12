<!DOCTYPE html>
<html lang="en">
<body>

<?php
function curlGet($url)
{
    $curl = curl_init();
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
    $result = curl_exec($curl);
    if (!$result) {
        die("Connection Failure");
    }
    curl_close($curl);
    return $result;
}

$origin = "Disneyland";
$dest = "Universal Studios Hollywood";
$key = getenv("GOOGLE_API_KEY");

$url = 'https://maps.googleapis.com/maps/api/directions/json?origin=' . urlencode($origin) . '&destination=' . urlencode($dest) . '&key=' . $key;
$data = curlGet($url);
$decoded_data = json_decode($data);
echo "<h1>Decoded data with PHP (Geocoded Waypoints)</h1>";
echo print_r($decoded_data->geocoded_waypoints);

echo "<h1>Full JSON Response from Google</h1>";
echo $data;

?>

</body>
</html>