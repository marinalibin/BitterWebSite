<?php
$format = "xml";
$url = "http://localhost/Codealong/Chapter18/MyFirstWS.php?temp=20&format=$format";
//cURL is versatile set of libraries that allow PHP to send/retrive data via HTTP
//Google and Amazon (AWS) use web services a lot
$cobj= curl_init($url);
curl_setopt($cobj, CURLOPT_RETURNTRANSFER, 1);// retrnsthe results to me,
//istead of displaying it directly on the screen
$data = curl_exec($cobj);
curl_close($cobj);//don't forget to close it
if($format=="json"){
$object = json_decode($data);//convert it back to an array
 echo $object->{"temp"};//dereferencing the array oject
 echo var_dump($object);
}
else{//xml
    $xmlObject = simplexml_load_string($data);
   // print_r($xmlObject);
    echo "the temp in F is " . $xmlObject->temp;
    
}

