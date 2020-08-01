<?php

namespace App\Http\Controllers;
use Softon\Indipay\Facades\Indipay;
use Illuminate\Http\Request;
use Woocommerce;

class HomeController extends Controller
{
	public function pagenotfound()
	{
		return view('error.404');	    
	}
	public function demo11()
    {


       $localIP = getHostByName(getHostName());
       dump($localIP);

       //$url =  $localIP.'/wk/wp-json/wc/v3/products\-u ck_b40e1040391f086763b5062053f464b560c11e28:cs_b07dcafdbe32ac978edaed999800b1788764c6e4';

       $url2 = 'http://192.168.43.75/wk/wp-json/wc/v2/products -u ck_b40e1040391f086763b5062053f464b560c11e28:cs_b07dcafdbe32ac978edaed999800b1788764c6e4';

       $url ='http://localhost/wk/wp-json/wc/v2/products -u ck_b40e1040391f086763b5062053f464b560c11e28:cs_b07dcafdbe32ac978edaed999800b1788764c6e4';



       dump($url);

        $ch = curl_init();// set url
        curl_setopt($ch, CURLOPT_URL,$url);
        //return the as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        // echo output string
        $output = curl_exec($ch);
        echo $output;
        // close curl resource to free up system resources
        curl_close($ch);


    }

    public function demo13(){
    	$url1 ='http://api.ean.com/ean-services/rs/hotel/v3/avail?minorRev14&apiKey=p9ycn9cxb2zp3k3gfvbf5aym&cid=55505&locale=en_US&hotelId=122212&stateProvinceCode=%20NV%C2%A4cyCode=USD&arrivalDate=12/27/2012&departureDate=12/28/2012&room1=2,&room2=2,18,15&room3=3,16,16,15&room4=3,&includeDetails=true&includeRoomImages=true';

    	$localIP = getHostByName(getHostName());
       $url1 =  $localIP.'/wk/wp-json/wc/v3/products \-u ck_5f612444c78a5c92a769f584e66b6d510472022f:cs_685b5855b0971075d6e81fa520feaa8bfd25c3c6';

     $url =   'http://localhost/papers/wk/wp-json/wc/v3/products \-u ck_5f612444c78a5c92a769f584e66b6d510472022f:cs_685b5855b0971075d6e81fa520feaa8bfd25c3c6';


		$header = array("Accept: application/json");

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_ENCODING, "gzip");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');

		$retValue = curl_exec($ch);
		$response = json_decode(curl_exec($ch));
		$ee       = curl_getinfo($ch);
		print_r($ee);

		print_r($retValue);
    }

    public function demo1()
    {

      dump(env('WOOCOMMERCE_STORE_URL').'/wp-content/uploads/');

    	$data =  Woocommerce::get('products');

    	dd($data);




    }
	
}