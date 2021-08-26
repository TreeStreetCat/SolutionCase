<?php

namespace App\Http\Controllers\ShortLink;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShortLinkController extends Controller
{
    public function test(){
        $username = 'username';
        $password = 'password';
        $api_url =  'http://www.yourls.com/yourls-api.php';

        // Init the CURL session
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result
        curl_setopt($ch, CURLOPT_POST, 1);              // This is a POST request
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(     // Data to POST
            'url' => 'https://www.jianshu.com/p/46c530400955',
            'format'   => 'json',
            'action'   => 'shorturl',
            'username' => $username,
            'password' => $password
        ));

        // Fetch and return content
                $data = curl_exec($ch);
                curl_close($ch);

        // Do something with the result. Here, we echo the long URL
                $data = json_decode( $data );
                return $data;

    }
}
