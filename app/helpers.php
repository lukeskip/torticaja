<?php 
// use App\Models\Config;
// use App\Models\Provider;


if(!function_exists('format_number')){
    function format_number($total){  
        $total = round($total,2);   
        return number_format( $total,1,'.',',' );
    }   
};

// if(!function_exists('get_config')){
//     function get_config($label){
//         if (!isset($_SESSION[$label])){
//             $config = Config::where('label',$label)->first();
//             if($config){
//                 $value = $_SESSION[$label]=$config->value;
//             } else{
//                 $value = false; 
//             }
//         }else{
//             $value = $_SESSION[$label];
//         }

//         return $value;        

//     }   
// };

if(!function_exists('sack_to_kg')){
    function sack_to_kg($sacks){
        $result = 0;
        $kgs    = $sacks * 20;
        $result = $kgs * get_config('dough_ratio');
        return $result;
    }   
};

if(!function_exists('make_slug')){
    function make_slug($slug){
        strtolower($slug);
        $slug = strtr(utf8_decode($slug), utf8_decode(' àáâãäçèéêëìíîïñòóôõöùúûüýÿ'), '-aaaaaceeeeiiiinooooouuuuyy');
        return strtolower($slug);
    }   
};

// if(!function_exists('send_sms')){
//     function send_sms($phone,$message){
        
//         $sid    = env("TWILIO_AUTH_SID"); 
//         $token  = env("TWILIO_AUTH_TOKEN"); 
         
        
        
        
//         $twilio = new Client($sid, $token);
//         $message = $twilio->messages
//         ->create($phone, // to
//                 [
//                     "body" => $message,
//                     "from" => env("TWILIO_FROM")
//                 ]
//         );

//         print_r($message->sid);
        
//         return true;
//     }   
// };

if(!function_exists('get_code')){
    function get_code($length){
        return substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, $length);
    }
}

if(!function_exists('get_average')){
    function get_average($array){
        $min = array_search(min($array), $array);
        $max = array_search(max($array), $array);
        unset($array[$min],$array[$max]);
        $average = array_sum($array) / count($array);
        return $average;
    }
}



