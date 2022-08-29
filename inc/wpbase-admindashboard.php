<?php

/* 
- [customize admin color scheme](https://developer.wordpress.org/reference/functions/wp_admin_css_color/)
	- plugin: https://wordpress.org/plugins/admin-color-schemes/
- [customize the login form](https://codex.wordpress.org/Customizing_the_Login_Form)
	- plugin: https://wordpress.org/plugins/custom-login/
- [add/remove admin menu links](https://developer.wordpress.org/reference/functions/remove_menu_page/)
	- plugin: https://wordpress.org/plugins/admin-menu-editor/
- [add/remove dashboard widget](https://developer.wordpress.org/apis/handbook/dashboard-widgets/)
	- OLDDATED plugin: https://wordpress.org/plugins/custom-dashboard-help/
- [customize admin footer text](https://developer.wordpress.org/reference/hooks/admin_footer_text/)

*/

/**
 * Removes some menus by page.
 */
function wpdocs_remove_menus()
{
	remove_menu_page('index.php');                  //Dashboard
	remove_menu_page('jetpack');                    //Jetpack* 
	remove_menu_page('edit.php');                   //Posts
	remove_menu_page('upload.php');                 //Media
	remove_menu_page('edit.php?post_type=page');    //Pages
	remove_menu_page('edit-comments.php');          //Comments
	remove_menu_page('themes.php');                 //Appearance
	remove_menu_page('plugins.php');                //Plugins
	remove_menu_page('users.php');                  //Users
	remove_menu_page('tools.php');                  //Tools
	remove_menu_page('options-general.php');        //Settings

}
// add_action('admin_menu', 'wpdocs_remove_menus');


