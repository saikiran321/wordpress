<?php

class AWPCP_CategoriesDropdown {

    public function render($params) {
        extract( $params = wp_parse_args( $params, array(
            'context' => 'default',
            'name' => 'category',
            'label' => __( 'Ad Category', 'AWPCP' ),
            'required' => true,
            'selected' => null,
        ) ) );

        if ( $context == 'search' ) {
            $labels['default-option-first-level'] = __( 'All Categories', 'AWPCP' );
            $labels['default-option-second-level'] = __( 'All Sub-categories', 'AWPCP' );
        } else {
            $labels['default-option-first-level'] = __( 'Select a Category', 'AWPCP' );

            if ( get_awpcp_option( 'noadsinparentcat' ) ) {
                $labels['default-option-second-level'] = __( 'Select a Sub-category', 'AWPCP' );
            } else {
                $labels['default-option-second-level'] = __( 'Select a Sub-category (optional)', 'AWPCP' );
            }
        }

        // export categories list to JavaScript, but don't replace an existing categories list
        $categories = $this->get_all_categories();
        awpcp()->js->set( 'categories', $categories, false );

        $chain = $this->get_category_parents( $selected );
        $use_multiple_dropdowns = get_awpcp_option( 'use-multiple-category-dropdowns' );

        ob_start();
        include( AWPCP_DIR . '/frontend/templates/html-widget-category-dropdown.tpl.php' );
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    private function get_all_categories() {
        $categories['root'] = $this->get_categories();

        foreach ( $categories['root'] as $category ) {
            $categories[ $category->id ] = $this->get_categories( $category->id );
        }

        return $categories;
    }

    private function get_categories($parent_id=0) {
        global $wpdb;

        $categories = AWPCP_Category::query( array(
            'where' => $wpdb->prepare( "category_parent_id = %d AND category_name <> ''", $parent_id ),
            'orderby' => 'category_order ASC, category_name',
            'order' => 'ASC',
        ) );

        return $categories;
    }

    private function get_category_parents( $category ) {
        if ( empty($category) ) return array();

        $categories = AWPCP_Category::query();
        $hierarchy = array();

        foreach ( $categories as $item ) {
            $hierarchy[ $item->id ] = $item->parent;
        }

        $parent = $category;
        $chain = array();

        do {
            $chain[] = $parent;
            $parent = $hierarchy[ $parent ];
        } while ( $parent != 0 );

        return array_reverse( $chain );
    }
}
