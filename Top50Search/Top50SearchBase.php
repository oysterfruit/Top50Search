<?php

//aws keys removed

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

//echo "Signed URL: \"".$request_url."\"";

//Catch the response in the $response object
$response = file_get_contents($request_url);
//echo $response;
$parsed_xml = simplexml_load_string($response);

$category = "FashionWomen";

printSearchResults($parsed_xml, $category);


function printSearchResults($parsed_xml, $SearchIndex){
  $numOfItems = $parsed_xml->Items->TotalResults;

  if($numOfItems>0){

    //set up table headers
    $table_headers = "<thead><tr><th class='col-fixed-160'>Image</th><th>Description</th><th>Price</th><th>Buy</th>";
    $table_headers = $table_headers . "</tr></thead>";
     echo $table_headers;

      $table_data = "<tbody>";
      foreach($parsed_xml->Items->Item as $current){
      if (isset($current->ItemAttributes->Title)) {
          $table_data =$table_data . "<tr><td></td><td class='left_cell'>".$current->ItemAttributes->Title."</td>";  }
      if   (isset($current->Offers->Offer->Price->FormattedPrice)){
        $table_data =$table_data . "<td class='center_cell'>".$current->Offers->Offer->Price->FormattedPrice."</td>";  }
      $table_data =$table_data . "<td class='center_cell'><a href=# target='_blank' role='button' class='btn btn-info'><i class='fa fa-shopping-bag' aria-hidden='true'></i></a></td></tr>";
      }


    $table_data = $table_data . "</tbody>";
    echo $table_data;

  }
    else{  print("<center>No matches found.</center>");   }


}


?>

