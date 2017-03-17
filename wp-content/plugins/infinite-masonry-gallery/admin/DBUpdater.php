<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 26.03.2015
 * Time: 15:35
 */

//require_once(dirname(__FILE__) .'/config.php');


class IMG_DBUpdater {
//    static $versions = array('1.0.0','1.0.1','1.1.0','1.1.1','1.1.2','1.2.0','1.2.1','1.2.2','2.0.0','2.1.0',
//                             '2.1.1','2.1.2','2.2.0','2.2.1','2.2.2','2.2.3','2.3.0','2.3.1','2.3.2','2.3.3',
//                             '2.3.4','2.3.5','2.3.6','2.4.0','2.4.1','2.4.2','2.5.0','2.6.0','2.6.1');
    static $currVersion;




    static function version_to_func_name($newVersion){
        $tempNew = str_replace(".", "_", $newVersion);

        return "update_to_$tempNew";
    }

    static function updateClients(){
        global $cc_img_config;
        IMG_DBUpdater::$currVersion = $cc_img_config['version'];
        $oldVersion = get_option( 'cc_img_curr_version' );

        $funcContainer = new IMG_FunctionContainer();
        $funcContainer->legacy();

        if($oldVersion === IMG_DBUpdater::$currVersion)return;

//        update_option('codeneric_register_status', 42);
        flush_rewrite_rules();

        if($oldVersion === false){ //first installation
            $oldVersion = '1.0.0';
        }


        update_option( 'cc_img_curr_version',IMG_DBUpdater::$currVersion );
//        $oldVersionIndex = array_search($oldVersion, IMG_DBUpdater::$versions);
//        $funcContainer = new IMG_FunctionContainer();

        $functions = get_class_methods('IMG_FunctionContainer'); //get all functions
        $funcName = IMG_DBUpdater::version_to_func_name($oldVersion); //get the function which was (potentially) executed last time

        if(!function_exists('cc_img_filter_functions')){
            function cc_img_filter_functions($v){return strpos($v,'update_to_') === 0;}
        }

        $update_funcs = array_filter($functions, 'cc_img_filter_functions'); //we want only update_to_ functions!
        $update_funcs[] = $funcName; //insert last executed function name to make sure it is in the array
        $update_funcs = array_unique($update_funcs); //remove our entry if it was already contained
        natsort($update_funcs); //sort the functions s.t. they are executed in the correct order!
        $update_funcs = array_values($update_funcs); //natsort sorts the keys too. we do not want this, cut them off.


        $oldVersionIndex = array_search($funcName, $update_funcs); //now lookup the current index, s.t. we can apply all remaining functions

//        for($i = $oldVersionIndex+1; $i< count(IMG_DBUpdater::$versions); $i++ ){
//            $funcName = IMG_DBUpdater::version_to_func_name(IMG_DBUpdater::$versions[$i]);
//
//            if(method_exists ($funcContainer, $funcName)){ //we have to perform some operations on the database
//                $funcContainer->$funcName();
//            }
//        }
        for($i = $oldVersionIndex+1; $i< count($update_funcs); $i++ ){ //start from $oldVersionIndex+1 because we already applied $oldVersionIndex in the last version
            $funcName = $update_funcs[$i]; //helper

            if(method_exists ($funcContainer, $funcName)){ //we have to perform some operations on the database
                $funcContainer->$funcName();
            }
        }

        /////////// AFTER INSTALL/UPGRADE
        do_action('codeneric/img/base-plugin-updated');

    }


}

class IMG_FunctionContainer{



    function legacy(){


    }


}