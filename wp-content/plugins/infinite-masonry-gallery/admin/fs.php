<?php

/**
 * Created by PhpStorm.
 * User: denis_000
 * Date: 28.10.2015
 * Time: 18:57
 */
class Infinite_Masonry_Gallery_Base_FS
{
    public static function rm_dir($dir){
        if ( is_dir( $dir ) ) {
            $objects = scandir( $dir );
            foreach ( $objects as $object ) {
                if ( $object != "." && $object != ".." ) {
                    if ( filetype( $dir . "/" . $object ) == "dir" ) {
                        Infinite_Masonry_Gallery_Base_FS::rm_dir( $dir . "/" . $object );
                    } else {
                        unlink( $dir . "/" . $object );
                    }
                }
            }
            reset( $objects );

            return rmdir( $dir );
        }
    }
}