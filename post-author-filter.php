<?php
/**
 * Plugin Name: Post Author Filter
 * Description: Adds an author filter dropdown to posts and pages in the WordPress admin dashboard
 * Version: 1.0.0
 * Author: Lee Tampkins
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: post-author-filter
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class Post_Author_Filter {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('restrict_manage_posts', array($this, 'add_author_filter_dropdown'));
        add_filter('parse_query', array($this, 'filter_posts_by_author'));
    }
    
    /**
     * Add author filter dropdown to admin screens
     */
    public function add_author_filter_dropdown($post_type) {
        // Only show for posts and pages
        if (!in_array($post_type, array('post', 'page'))) {
            return;
        }
        
        // Get all users who can edit posts
        $users = get_users(array(
            'who' => 'authors',
            'orderby' => 'display_name',
            'order' => 'ASC',
            'fields' => array('ID', 'display_name')
        ));
        
        // Get current selected author
        $selected_author = isset($_GET['author_filter']) ? intval($_GET['author_filter']) : '';
        
        // Output the dropdown
        echo '<select name="author_filter" id="author_filter">';
        echo '<option value="">' . esc_html__('All Authors', 'admin-author-filter') . '</option>';
        
        foreach ($users as $user) {
            printf(
                '<option value="%d"%s>%s</option>',
                $user->ID,
                selected($selected_author, $user->ID, false),
                esc_html($user->display_name)
            );
        }
        
        echo '</select>';
    }
    
    /**
     * Filter posts based on selected author
     */
    public function filter_posts_by_author($query) {
        global $pagenow;
        
        // Only apply on admin edit screen
        if (!is_admin() || $pagenow !== 'edit.php') {
            return $query;
        }
        
        // Check if author filter is set
        if (isset($_GET['author_filter']) && !empty($_GET['author_filter'])) {
            $query->set('author', intval($_GET['author_filter']));
        }
        
        return $query;
    }
}

// Initialize the plugin
new Post_Author_Filter();
