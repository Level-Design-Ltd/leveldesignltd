<?php

/**
 * Handles CPTs
 */

if (class_exists('LevelDesignLteCpt') === false) {

    class LevelDesignLteCpt
    {
        /**
         * Contains a list of CPTs and English Labels
         *
         * @var array
         */
        private $cpts = [
            "our-work" => [
                "singleLower" => "work",
                "singleUpper" => "Work",
                "pluralLower" => "our work",
                "pluralUpper" => "Our Work",
                "dashicon"    => "schedule",
                "description" => "Our Work",
                "supports"    => [
                    "title",
                ],
            ],
        ];

        /**
         * Holds a list of custom taxonomies
         * @var array[]
         */
        private $taxonomies = [
            "technology" => [
                "cpt" => ["our-work"],
                "singleLower" => "technologies",
                "singleUpper" => "Technologies",
                "pluralLower" => "technology",
                "pluralUpper" => "Technology",
                "slug" => "technology",
                "hierarchical" => true,
            ],
        ];

        /**
         * List of updated labels for any existing CPTs
         * @var array[]
         */
        // private $labels = [
        //     "post" => [
        //         "singleUpper" => "News & Resource",
        //         "pluralUpper" => "News & Resources",
        //         "menu" => [
        //             [
        //                 "top_item" => 5,
        //                 "sub_item" => 0,
        //                 "value" => "News & Resources"
        //             ],
        //             [
        //                 "top_item" => 5,
        //                 "sub_item" => 6,
        //                 "value" => "dashicons-format-status"
        //             ],
        //         ],
        //         "submenu" => [
        //             [
        //                 "top_item" => 5,
        //                 "sub_item" => 0,
        //                 "value" => "News & Articles"
        //             ],
        //             [
        //                 "top_item" => 10,
        //                 "sub_item" => 0,
        //                 "value" => "Add News / Resource"
        //             ],
        //         ]
        //     ]
        // ];

        /**
         * ACF field groups
         *
         * @var array
         */
        private $acf = [];


        /**
         * LevelDesignLteCpt constructor.
         */
        public function __construct()
        {
            // Add the initiator.
            add_action("init", [$this, "init"], 2);
            // add_action("admin_menu", [$this, "changeMenus"], 100);
        } //end __construct()


        /**
         * Initiate the plugin
         */
        public function init()
        {
            $this->createCpts();
            $this->createTax();
            // $this->changeLabels();

            return null;
        } //end init()


        /**
         * Creates the *actual* custom post types
         * @return null
         */
        private function createCpts()
        {
            foreach ($this->cpts as $cpt => $label) {
                $label = (object) $label;

                $labels = [
                    "name"                     => __($label->pluralUpper),
                    "singular_name"            => __($label->singleUpper),
                    "menu_name"                => __($label->pluralUpper),
                    "all_items"                => __("All {$label->pluralUpper}"),
                    "add_new"                  => __("Add New"),
                    "edit_item"                => __("Edit {$label->singleUpper}"),
                    "new_item"                 => __("New {$label->singleUpper}"),
                    "view_item"                => __("View {$label->singleUpper}"),
                    "view_items"               => __("View {$label->pluralUpper}"),
                    "search_items"             => __("Search {$label->pluralUpper}"),
                    "not_found"                => __("Not found"),
                    "not_found_in_trash"       => __("Not found in Trash"),
                    "featured_image"           => __("Featured Image"),
                    "set_featured_image"       => __("Set Featured Image"),
                    "remove_featured_image"    => __("Remove Featured Image"),
                    "use_featured_image"       => __("Use as Featured Image"),
                    "archives"                 => __($label->pluralUpper),
                    "insert_into_item"         => __("Insert into {$label->singleLower}"),
                    "uploaded_to_this_item"    => __("Uploaded to this {$label->singleLower}"),
                    "filter_items_list"        => __("Filter {$label->singleLower} list"),
                    "items_list_navigation"    => __("{$label->singleUpper} list navigation"),
                    "items_list"               => __("{$label->singleUpper} list"),
                    "attributes"               => __("{$label->singleUpper} Attributes"),
                    "name_admin_bar"           => __("{$label->singleUpper}"),
                    "item_published"           => __("{$label->singleUpper} published"),
                    "item_published_privately" => __("{$label->singleUpper} published privately"),
                    "item_reverted_to_draft"   => __("{$label->singleUpper} reverted to draft"),
                    "item_scheduled"           => __("{$label->singleUpper} scheduled"),
                    "item_updated"             => __("{$label->singleUpper} updated"),
                ];
                $args   = [
                    "label"                 => __($label->pluralUpper),
                    "labels"                => $labels,
                    "description"           => $label->description,
                    "public"                => true,
                    "publicly_queryable"    => true,
                    "show_ui"               => true,
                    "show_in_rest"          => true,
                    "rest_base"             => $cpt,
                    "rest_controller_class" => "",
                    "has_archive"           => (isset($label->has_archive) ? $label->has_archive : false),
                    "show_in_menu"          => true,
                    "show_in_nav_menus"     => true,
                    "delete_with_user"      => false,
                    "exclude_from_search"   => true,
                    "capability_type"       => "post",
                    "map_meta_cap"          => true,
                    "hierarchical"          => (isset($label->hierarchical) ? $label->hierarchical : false),
                    "rewrite"               => [
                        "slug"       => $cpt,
                        "with_front" => false,
                    ],
                    "query_var"             => true,
                    "menu_position"         => 37,
                    "menu_icon"             => "dashicons-{$label->dashicon}",
                    "supports"              => $label->supports,
                ];

                // Check for overrides in the rewrite rules.
                if (isset($label->rewrite) === true) {
                    foreach ($label->rewrite as $key => $value) {
                        $args['rewrite'][$key] = $value;
                    }
                }

                // Register the actual post type
                register_post_type($cpt, $args);
            }

            return null;
        } //end createCpts()


        /**
         * Creates custom taxonomies
         */
        private function createTax()
        {
            foreach ($this->taxonomies as $tax => $label) {
                $label = (object) $label;

                // Build the labels
                $labels = array(
                    'name'                       => __($label->pluralUpper),
                    'singular_name'              => __($label->singleUpper),
                    'menu_name'                  => __($label->pluralUpper),
                    'all_items'                  => __("All {$label->pluralUpper}"),
                    'parent_item'                => __("Parent {$label->singleUpper}"),
                    'parent_item_colon'          => __("Parent {$label->singleUpper}:"),
                    'new_item_name'              => __("New {$label->singleUpper}"),
                    'add_new_item'               => __("Add New {$label->singleUpper}"),
                    'edit_item'                  => __("Edit {$label->singleUpper}"),
                    'update_item'                => __("Update {$label->singleUpper}"),
                    'view_item'                  => __("View {$label->singleUpper}"),
                    'separate_items_with_commas' => __("Separate items with commas"),
                    'add_or_remove_items'        => __("Add or remove {$label->pluralLower}"),
                    'choose_from_most_used'      => __("Choose from the most used"),
                    'popular_items'              => __("Popular $label->pluralUpper{}"),
                    'search_items'               => __("Search {$label->pluralUpper}"),
                    'not_found'                  => __("{$label->singleUpper} Not Found"),
                    'no_terms'                   => __("No {$label->pluralLower}"),
                    'items_list'                 => __("{$label->singleUpper} list"),
                    'items_list_navigation'      => __("{$label->singleUpper} list navigation"),
                );

                // Setup rewrite options
                $rewrite = array(
                    'slug'                       => $label->slug,
                    'with_front'                 => true,
                    'hierarchical'               => true,
                );

                // Build the custom taxonomy's type's Options Array
                $args = array(
                    'labels'                     => $labels,
                    'hierarchical'               => $label->hierarchical,
                    'public'                     => true,
                    'show_ui'                    => true,
                    'show_admin_column'          => true,
                    'show_in_nav_menus'          => true,
                    'show_tagcloud'              => false,
                    'rewrite'                    => $rewrite,
                );

                // Register the taxonomy
                register_taxonomy($tax, $label->cpt, $args);
            }
        } //end createTax()


        /**
         * Updates labels for existing CPTs
         */
        public function changeLabels()
        {
            // Start with the post type info
            global $wp_post_types;

            foreach ($this->labels as $cpt => $label) {
                // Confirm we have something to edit.
                if (isset($wp_post_types[$cpt]) === false) {
                    continue;
                }

                // Convert the label info to something easier to manage
                $label = (object) $label;

                // Grab the relevant global object
                $labels = &$wp_post_types[$cpt]->labels;

                // Update the labels
                $labels->name = $label->pluralUpper;
                $labels->singular_name = $label->singleUpper;
                $labels->add_new = "Add {$label->singleUpper}";
                $labels->add_new_item = "Add {$label->singleUpper}";
                $labels->edit_item = "Edit {$label->singleUpper}";
                $labels->new_item = $label->singleUpper;
                $labels->view_item = "View {$label->singleUpper}";
                $labels->search_items = "Search {$label->pluralUpper}";
                $labels->not_found = "No {$label->pluralUpper} found";
                $labels->not_found_in_trash = "No {$label->pluralUpper} found in Trash";
            }
        } //end changeLabels()


        /**
         * Updates menu names and icons, for existing CPTs
         */
        public function changeMenus()
        {
            // Collect the menu objects
            global $menu;
            global $submenu;

            foreach ($this->labels as $cpt => $label) {
                // Convert the label info to something easier to manage
                $label = (object) $label;

                // Iterate through the menu tweaks
                foreach ($label->menu as $tweak) {
                    $tweak = (object) $tweak;
                    $menu[$tweak->top_item][$tweak->sub_item] = $tweak->value;
                }

                // Iterate through the submenu tweaks
                foreach ($label->submenu as $tweak) {
                    $tweak = (object) $tweak;
                    $submenu['edit.php'][$tweak->top_item][$tweak->sub_item] = $tweak->value;
                }
            }
        } //end changeMenus()
    } //end class()

    // Instantiate the class
    $LevelDesignLteCpt = new LevelDesignLteCpt();
}//end if
