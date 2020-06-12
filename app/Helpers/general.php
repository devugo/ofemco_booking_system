<?php

use Illuminate\Support\Facades\URL;

if(!function_exists('currency'))
{
    function currency(){
        return 'NGN ';
    }
}

if(!function_exists('currencyFormatter'))
{
    function currencyFormatter($curr = '', $pre = true){
        if(!$curr){
            return $pre ? currency() . '0.00' : '0.00';
        }
        $curr = strval($curr); // Converts integer into string
        if((strlen($curr))/4 >= 1){
            $count = 0;
            $store = '';
            for($i=strlen($curr)-1; $i>=0; $i--){
                if($count == 3){
                    $store = $curr[$i] . ',' . $store;
                    $count = 1;
                    continue;
                }
                $store = $curr[$i] . $store;
                $count++;
            }
            return $pre ? currency() . $store . '.' . '00' : $store . '.' . '00';
        }
        return $pre ? currency() . $curr . '.' . '00' :  $curr . '.' . '00';
    }
}

if(!function_exists('flash'))
{
    function flash($message = 'Resource was created successfully', $type = 'success')
    {
        session()->flash('devugo_status', $message);
        session()->flash('devugo_type', $type);
    }
}

if(!function_exists('alertBox'))
{
    function alertBox()
    {
        $message = session('devugo_status');
        if(session()->exists('devugo_status')){
            return '
                <div id="alert-box" style="z-index: 5; width: 400px; position: fixed; top: 0; left: calc(50% - 200px);" class="text-center alert alert-' . session('devugo_type') . ' alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    ' . $message . '
                </div>
                <script>
                    var item = document.getElementById("alert-box");
                    setTimeout(function(){
                        item.style.display = "none";
                    }, 5000);
                </script>
            ';
        }
    }
}

if(!function_exists('strToSlug')){
    function strToSlug($str)
    {
        return preg_replace('/\s+/', '-', $str);
    }
}

if(!function_exists('baseUrl'))
{
    function baseUrl()
    {
        return 'http://127.0.0.1:8000';
    }
}

if(!function_exists('getLogo'))
{
    function getLogo()
    {
        $settings =  \App\Setting::all()->first();
        return URL::asset('storage/images/settings/'.$settings->logo);
    }
}

if(!function_exists('getFavicon'))
{
    function getFavicon()
    {
        $settings =  \App\Setting::all()->first();
        return URL::asset('storage/images/settings/'.$settings->favicon);
    }
}

if(!function_exists('getAppName'))
{
    function getAppName(){
        return 'APP';
        return URL::asset('storage/images/settings/' .$setings->app_name);
    }
}

