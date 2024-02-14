<?php

function get_images($dir, $one=False, $admin=False){
    $imgdir = "img/".$dir;
    if($admin){
        $imgdir = "../img/".$dir;
    }
    $files = glob($imgdir."/*.{jpg,jpeg,png}", GLOB_BRACE);
    if($files){
        if($one){
            rsort($files, SORT_STRING);
            return $files[0];
        }else{
            shuffle($files);
            return $files;
        }
    }
}

function date_from_filename($filename, $format=null){
    if(!isset($format)){
        $format = "jS F Y";
    }
    $file = explode("/",$filename);
    $file = $file[count($file)-1];
    $d = str_replace(".jpg","",$file);
    $date = DateTime::createfromformat("Ymd", $d);
    return $date->format($format);
}

function get_days($file="days.csv"){
    $handle = fopen($file, "r");
    while (($data = fgetcsv($handle)) !== FALSE) {
        return $data;
    }
}

function get_delivery_string(){
    $days = get_days();
    if(count($days) == 0){
        return "Unfortunately we are <strong>not delivering</strong> this week.";
    }elseif(count($days) == 1){
        $msg = "We are delivering on <strong>".$days[0]." only</strong> this week";
    }elseif(count($days) == 2){
        $msg = "We deliver on <strong>".implode(" and ", $days)."</strong>";
    }elseif(count($days) > 2){
        $last = array_pop($days);
        $on = implode(", ", $days);
        $msg = "We deliver on <strong>".$on." and ".$last."</strong>";
    }

    $msg .= ", from <strong>5:30pm to 9:30pm</strong>.";
    return $msg;
}

function write_days($data){
    $fp = fopen("../days.csv", "w");
    fputcsv($fp, $data);
    fclose($fp);
    return $data;
}

?>