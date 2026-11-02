<?php
// Protect Admin User
// Protect Admin User / Kiri Vadivelu / 2026	
class Protected_User {

    // Select capabilities from the default 'Administrator' role
    public function __construct() {
        add_filter('editable_roles', array($this, 'filter_editable_roles'));
        add_filter('map_meta_cap', array($this, 'filter_map_meta_cap'), 10, 4);
    }

    // Remove 'Administrator' role if the current user is not a protected user
    public function filter_editable_roles($roles) {
        if (isset($roles['administrator']) && !current_user_can('administrator')) {
            unset($roles['administrator']);
        }
        return $roles;
    }

    // Prevent edit, delete or promote from 'Administrator' capabilities 
    public function filter_map_meta_cap($caps, $cap, $user_id, $args) {
        // Define the ID of the protected 'Administrator' user (Example 1)
        $protected_user_id = 1; 

        switch ($cap) {
            case 'edit_user':
            case 'remove_user':
            case 'promote_user':
                if (isset($args[0]) && $args[0] == $protected_user_id) {
                    if (!current_user_can('administrator') || $user_id !== $protected_user_id) {
                        $caps[] = 'do_not_allow';
                    }
                }
                break;
            case 'delete_user':
            case 'delete_users':
                if (isset($args[0]) && $args[0] == $protected_user_id) {
                    if (!current_user_can('administrator') || $user_id !== $protected_user_id) {
                        $caps[] = 'do_not_allow';
                    }
                }
                break;
        }
        return $caps;
    }
}

new Protected_User();   