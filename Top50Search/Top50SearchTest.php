<?php

// Your AWS Access Key ID, as taken from the AWS Your Account page
$aws_access_key_id = "AKIAJ7U2MZ5G6FALOIHQ";

// Your AWS Secret Key corresponding to the above ID, as taken from the AWS Your Account page
$aws_secret_key = "eqqJlQIsFDkeJLOr6/zWUvIvRrEmJJlcB0KslSAO";

// The region you are interested in
$endpoint = "webservices.amazon.com";

$uri = "/onca/xml";

$params = array(
    "Service" => "AWSECommerceService",
    "Operation" => "ItemSearch",
    "AWSAccessKeyId" => "AKIAJ7U2MZ5G6FALOIHQ",
    "AssociateTag" => "oysterfruit-20",
    "SearchIndex" => "FashionWomen",
    "Keywords" => "sunglasses",
    "ResponseGroup" => "Images,ItemAttributes,Offers",
    "Sort" => "-price"
);

// Set current timestamp if not set
if (!isset($params["Timestamp"])) {
    $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
}

// Sort the parameters by key
ksort($params);

$pairs = array();

foreach ($params as $key => $value) {
    array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
}

// Generate the canonical query
$canonical_query_string = join("&", $pairs);

// Generate the string to be signed
$string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;

// Generate the signature required by the Product Advertising API
$signature = base64_encode(hash_hmac("sha256", $string_to_sign, $aws_secret_key, true));

// Generate the signed URL
$request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);

echo "Signed URL: \"".$request_url."\"";

//Catch the response in the $response object
$response = file_get_contents($request_url);
//echo $response;
$parsed_xml = simplexml_load_string($response);

$category = "FashionWomen";

printSearchResults($parsed_xml, $category);


function printSearchResults($parsed_xml, $SearchIndex){
  $numOfItems = $parsed_xml->Items->TotalResults;

  if($numOfItems>0){
  print("<p>Items found:" . $numOfItems . "</p>");
  print("<table>");
    foreach($parsed_xml->Items->Item as $current){
      print("<td><font size='-1'><b>".$current->ItemAttributes->Title."</b>");
      if (isset($current->ItemAttributes->Title)) {
        print("<br>Title: ".$current->ItemAttributes->Title);  }
      elseif(isset($current->ItemAttributes->Author)) {
        print("<br>Author: ".$current->ItemAttributes->Author);  }
      elseif   (isset($current->Offers->Offer->Price->FormattedPrice)){
        print("<br>Price:    ".$current->Offers->Offer->Price->FormattedPrice);  }

    }
    print("</table>");
  }
    else{  print("<center>No matches found.</center>");   }


}


?>

