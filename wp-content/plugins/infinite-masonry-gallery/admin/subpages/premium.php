<?php

//add_action( 'admin_menu', 'codeneric_img_premium_page' );

class Infinite_Masonry_Gallery_Base_Premium
{

    private $plugin_name;
    private $version;
    private $slug;

    private $page_name = 'premium';
    public function __construct( $plugin_name, $version, $slug ) {

        $this->plugin_name =    $plugin_name;
        $this->version     =    $version;
        $this->slug     =       $slug;



    }

    public function add_premium_page()
    {

        add_submenu_page('edit.php?post_type='.$this->slug, 'Infinite Masonry Gallery Premium', __('Premium'), 'manage_options', $this->page_name, array($this, 'render_premium_page'));

    }

    public function render_premium_page()
    {



        ?>
        <div id="premium-modal"></div>
        <script>
            jQuery('#cc_img_notice_wrap').hide(); //better remove_action than this
        </script>

        <div class="wrap">
            <div class="postbox">
                <div id="cc-img-container" class="inside" style="width: 50%;">
                    <div style="background:url('images/spinner.gif') no-repeat;background-size: 20px 20px;vertical-align: middle;margin: 0 auto;height: 20px;width: 20px;display:block;"></div>
                </div>
            </div>
            <br><br>
            <strong><?php echo __('Join our <a style="color: coral" target="_blank" href="https://www.facebook.com/groups/1529247670736165/">facebook group</a> to get immediate help or get in contact with other photographers using WordPress!',$this->plugin_name); ?></strong>

        </div>


        <?php
    }

}