<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 24.03.2015
 * Time: 14:35
 */


//add_action( 'admin_menu', 'cc_img_options' );
//
//function cc_img_options() {
//    add_submenu_page( 'edit.php?post_type=client', 'Settings', 'Settings', 'manage_options', 'my-custom-submenu-page', 'cc_img_options_view' );
//}
//
//
//function cc_img_options_view() {
//    if ( !current_user_can( 'manage_options' ) )  {
//        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
//    }
//
//    include_once('options_view.php');
//
//}


//


//add_action( 'admin_menu', 'cc_img_add_settings_page' );
//add_action( 'admin_init', 'cc_img_settings_init' );

class Infinite_Masonry_Gallery_Base_Options
{


    private $plugin_name;
    private $version;
    private $slug;

    private $page_name = 'options';
    public function __construct( $plugin_name, $version, $slug ) {

        $this->plugin_name =    $plugin_name;
        $this->version     =    $version;
        $this->slug     =       $slug;



    }


    public function add_settings_page()
    {

        add_submenu_page('edit.php?post_type='.$this->slug, 'IMG '.__('Settings'), __('Settings'), 'manage_options', $this->page_name, array($this,'options_page'));

    }


    public function settings_init()
    {

        //unregister_setting('cc_img_settings_slug', 'cc_img_settings' );
        //return;

        register_setting('cc_img_settings_slug', 'cc_img_settings');

        add_settings_section(
            'cc_img_cc_img_settings_slug_section',
            __('', 'wordpress'),
            array($this, 'settings_section_callback'),
            'cc_img_settings_slug'
        );

        add_settings_field(
            'cc_img_slider',
            __('Activate Image Lightbox', 'wordpress'),
            array($this, 'image_box_render'),
            'cc_img_settings_slug',
            'cc_img_cc_img_settings_slug_section'
        );
//        add_settings_field(
//            'cc_img_enable_styling',
//            __('Enable Styling', 'wordpress'),
//            array($this, 'enable_styling_render'),
//            'cc_img_settings_slug',
//            'cc_img_cc_img_settings_slug_section'
//        );
//        add_settings_field(
//            'cc_img_enable_watermarking',
//            __('Enable Watermarking', 'wordpress'),
//            array($this, 'enable_watermarking_render'),
//            'cc_img_settings_slug',
//            'cc_img_cc_img_settings_slug_section'
//        );
//
//        add_settings_field(
//            'cc_img_canned_email',
//            __('Canned Email', 'wordpress'),
//            array($this, 'canned_email'),
//            'cc_img_settings_slug',
//            'cc_img_cc_img_settings_slug_section'
//        );
//    add_settings_field(
//        'cc_img_checkbox_field_1',
//        __( 'Settings field description', 'wordpress' ),
//        'cc_img_checkbox_field_1_render',
//        'cc_img_settings_slug',
//        'cc_img_cc_img_settings_slug_section'
//    );
//
//    add_settings_field(
//        'cc_img_checkbox_field_2',
//        __( 'Settings field description', 'wordpress' ),
//        'cc_img_checkbox_field_2_render',
//        'cc_img_settings_slug',
//        'cc_img_cc_img_settings_slug_section'
//    );

//        add_settings_field(
//            'cc_img_download_text',
//            __('Download-Button text', 'wordpress'),
//            array($this, 'download_text_render'),
//            'cc_img_settings_slug',
//            'cc_img_cc_img_settings_slug_section'
//        );

//        add_settings_field(
//            'cc_img_container_width',
//            __('Theme Container Width', 'wordpress'),
//            array($this, 'container_width_render'),
//            'cc_img_settings_slug',
//            'cc_img_cc_img_settings_slug_section'
//        );
//
//        add_settings_field(
//            'cc_img_portal_page',
//            __('Client Portal Page', 'wordpress'),
//            array($this, 'portal_page_render'),
//            'cc_img_settings_slug',
//            'cc_img_cc_img_settings_slug_section'
//        );

//
//        add_settings_field(
//            'cc_email_recipient',
//            __('Email recipients for notifications', 'wordpress'),
//            array($this, 'email_recipient_render'),
//            'cc_img_settings_slug',
//            'cc_img_cc_img_settings_slug_section'
//        );

        // add_settings_field(
        //     'cc_expose_cover_images',
        //     __('Expose cover images', 'wordpress'),
        //     array($this, 'expose_cover_images'),
        //     'cc_img_settings_slug',
        //     'cc_img_cc_img_settings_slug_section'
        // );

//        add_settings_field(
//            'cc_remove_images_on_project_deletion',
//            __('Remove images on project deletion ', 'wordpress'),
//            array($this, 'remove_images_on_project_deletion'),
//            'cc_img_settings_slug',
//            'cc_img_cc_img_settings_slug_section'
//        );
    }


    public function image_box_render()
    {

        $options = get_option('cc_img_settings');
        if (!isset($options['cc_img_slider']))
            $options['cc_img_slider'] = 0;
        ?>
        <input type='checkbox'
               name='cc_img_settings[cc_img_slider]' <?php checked($options['cc_img_slider'], 1); ?>
               value='1'>


        <?php
    }

    public function enable_styling_render()
    {

        $options = get_option('cc_img_settings');

        if (!isset($options['cc_img_enable_styling']))
            $options['cc_img_enable_styling'] = 0;

        ?>

        <input id="enable_styling_check" type='checkbox'
               name='cc_img_settings[cc_img_enable_styling]'<?php checked($options['cc_img_enable_styling'], 1); ?>
               value='1'>
        <div class="tip">
            <p>Enable a basic styling for the client view in case your theme does not handle it well.</p>
        </div>
        <!--    <div id="cc_img_enable_styling_details" --><?php //if(!isset($options['cc_img_enable_styling']) || in_array(null,$options['cc_img_enable_styling'])) echo 'style="display:none;"'; ?><!-->
        <!--        <label for="cc_img_settings[cc_img_enable_styling][accent]">-->
        <!--            <small>Accent Color (hex value)</small>-->
        <!--            <input type="text" name="cc_img_settings[cc_img_enable_styling][accent]" value="--><?php //echo $options['cc_img_enable_styling']['accent']; ?><!--"  pattern=".{3,7}" />-->
        <!--        </label>-->
        <!--    </div>-->
        <!---->
        <!--    <script>-->
        <!--        jQuery('#enable_styling_check').click(function () {-->
        <!--            jQuery('#cc_img_enable_styling_details').toggle();-->
        <!--        });-->
        <!--    </script>-->


        <?php
    }

    public function enable_watermarking_render()
    {

        $options = get_option('cc_img_settings');

        if (!isset($options['watermark']))
            $options['watermark'] = false;

        ?>

        <input id="enable_styling_check" type='checkbox'
               name='cc_img_settings[watermark]'<?php checked(1, $options['watermark']); ?>
               value='1'>
        <div class="tip">
            <p>Watermarks are only applied to images which were uploaded via IMG.</p>
        </div>


        <?php
    }

    public function download_text_render()
    {

        $options = get_option('cc_img_settings');
        if (!isset($options['cc_img_download_text']))
            $options['cc_img_download_text'] = 'Download all';
        ?>
        <input type='text' name='cc_img_settings[cc_img_download_text]'
               value='<?php echo $options['cc_img_download_text']; ?>'>
        <?php
    }

    public function container_width_render()
    {
        $options = get_option('cc_img_settings');
//    if(!isset($options['cc_img_download_text']))
//        $options['cc_img_download_text'] = 'Download all';
        ?>

        <input type='number' name='cc_img_settings[cc_img_container_width]'
               value='<?php echo isset($options['cc_img_container_width']) ? $options['cc_img_container_width'] : ''; ?>'>
        <div class="tip">
            <p>The plugin tries to figure out the custom content max-width of your theme automatically. Optionally, you
                can set the exact pixel value here.</p>
        </div>
        <?php

    }

    public function portal_page_render()
    {
        $options = get_option('cc_img_settings');
//    if(!isset($options['cc_img_download_text']))
//        $options['cc_img_download_text'] = 'Download all';


        ?>


        <select name='cc_img_settings[cc_img_portal_page]' id="cc_img_portal"
                value="<?php echo isset($options['cc_img_portal_page']) ? $options['cc_img_portal_page'] : ''; ?>">
            <option value="none">None</option>
            <?php
            $pages = get_pages();
            foreach ($pages as $page) {
                $id = $page->ID;
                $title = $page->post_title;
                $selected = '';
                if (isset($options['cc_img_portal_page']) && $id . '' === $options['cc_img_portal_page'])
                    $selected = 'selected';
                echo "<option value=\"$id\" $selected >$title</option>";
            }
            ?>
        </select>
        <input class="hidden" name='cc_img_settings[cc_img_portal_page_old]' id="cc_img_old_portal"/>
        <script>jQuery('#cc_img_old_portal').val(jQuery('#cc_img_portal').val());</script>
        <div class="tip">
            <p>
                If you want to provide a publicly visible login page for your clients,
                you can select it here. The project and client links displayed on the edit page stay valid.
                However, by setting a page as your Portal, your galleries will be additionally accessible through it.
            </p>
        </div>

        <?php


        if (isset($options['cc_img_portal_page_old']) && $options['cc_img_portal_page_old'] !== 'none') {
            $old_page_content = get_post_field('post_content', $options['cc_img_portal_page_old']);
            $old_page_stripped_content = str_replace('[cc_img_portal]', '', $old_page_content);
            $old_page = array(
                'ID' => $options['cc_img_portal_page_old'],
                'post_content' => $old_page_stripped_content
            );
            wp_update_post($old_page);
        }
        if (isset($options['cc_img_portal_page']) && $options['cc_img_portal_page'] !== 'none') {
            $page_content = get_post_field('post_content', $options['cc_img_portal_page']);
            $pos = strpos($page_content, '[cc_img_portal]');
            if ($pos === false) {
                $page_content = $page_content . '[cc_img_portal]';
                $old_page = array(
                    'ID' => $options['cc_img_portal_page'],
                    'post_content' => $page_content
                );

                wp_update_post($old_page);
            }


        }

    }

    public function email_recipient_render()
    {
        if(has_action('cc_img_register_prem_options_email_recipient')) {
            do_action('cc_img_register_prem_options_email_recipient');
        } else {
            $options = get_option('cc_img_settings');
            if (!isset($options['cc_email_recipient']))
                $options['cc_email_recipient'] = get_option('admin_email');
            ?>
            <input
                style="width: 50%"
                disabled
                type='text'
                name='cc_img_settings[cc_email_recipient]'
                value='premium feature' />
            <div class="tip">
                <p>The email addresses that will receive notifications of client actions such as favoriting.</p>
                <p>You can assign as many email adresses as you like. <strong>Separate each email address with a comma (,)</strong></p>
            </div>
            <?php
        }



    }

    public function canned_email()
    {

        if(has_action('cc_img_register_prem_options_canned_email')) {
            do_action('cc_img_register_prem_options_canned_email');
        } else {


        $options = get_option('cc_img_settings');

        ?>
        <div style="margin-bottom: 1em">
            <label for="cc_img_settings[canned_email_from]">
                <strong>From</strong>
            </label>
            <div>
                <input style="width: 50%" type="text"  placeholder="premium feature" disabled="disabled">
                <div class="tip">
                    <p>Should have the form: <br><strong>Name &lt;myemail@address.com&gt;</strong></p>
                </div>

            </div>

        </div>
        <div style="margin-bottom: 1em">
            <label for="cc_img_settings[canned_email_subject]">
                <strong>Subject</strong>
            </label>
            <div>
                <input style="width: 50%" type="text"  placeholder="premium feature" disabled="disabled" >
            </div>

        </div>
        <div style="margin-bottom: 1em">
            <strong>Message</strong>
        </div>

        <textarea
            style="width: 50%"
            rows="1"
            name='cc_img_settings[canned_email]'
            placeholder="premium feature"
            disabled="disabled"
            ></textarea>
        <div class="tip">
            <p>Here you can define a canned email which can be send to your clients with a single button press on the client edit-page.
        </div>
            <p><small>The following placeholders are available: <strong>[client-name], [username], [password]</strong></small></p>




        <?php
        }



    }

    public function expose_cover_images()
    {

        $options = get_option('cc_img_settings');

        if (!isset($options['expose_cover_images']))
            $options['expose_cover_images'] = false;

        ?>

        <input id="enable_styling_check" type='checkbox'
               name='cc_img_settings[expose_cover_images]'<?php checked(1, $options['expose_cover_images']); ?>
               value='1'>
        <div class="tip">
            <p>Before your client logs in, she will see a page with all your project-cover images.</p>
        </div>


        <?php
    }

    public function remove_images_on_project_deletion()
    {
        if(has_action('cc_img_register_prem_options_remove_images_on_project_deletion')) {
            do_action('cc_img_register_prem_options_remove_images_on_project_deletion');
        } else {

            $options = get_option('cc_img_settings');

            if (!isset($options['remove_images_on_project_deletion']))
                $options['remove_images_on_project_deletion'] = false;

            ?>

            <input id="enable_styling_check" type='checkbox' disabled
                   name='cc_img_settings[remove_images_on_project_deletion]'<?php checked(1, $options['remove_images_on_project_deletion']); ?>
                   value='1'>
            <div class="tip">
                <p>Delete the project images from the server when the project/client is deleted. <strong>[premium
                        feature]</strong></p>
            </div>


            <?php
        }
    }


    function settings_section_callback()
    {


    }


    function options_page()
    {

        ?>
        <form action='options.php' method='post'>

            <h2><?php echo __('Settings') ?></h2>

            <div class="postbox">
                <div class="inside">
                    <?php
                    settings_fields('cc_img_settings_slug');
                    do_settings_sections('cc_img_settings_slug');
                    submit_button();
                    ?>
                   
                </div>




            </div>

        </form>
        <?php

    }
}




?>
