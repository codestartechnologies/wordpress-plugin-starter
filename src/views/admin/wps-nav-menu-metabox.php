<div id="<?php echo $identifier; ?>-div">
    <div id="tabs-panel-<?php echo $identifier; ?>-all" class="tabs-panel tabs-panel-active">
        <ul id="<?php echo $identifier ?>-checklist-pop" class="categorychecklist form-no-clear">
            <?php echo walk_nav_menu_tree( array_map( 'wp_setup_nav_menu_item', $my_items ), 0, (object) array( 'walker' => $walker ) ); ?>
        </ul>
        <p class="button-controls">
            <span class="add-to-menu">
                <input type="submit" class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e( 'Add to Menu', 'wps' ); ?>"
                    name="add-<?php echo $identifier; ?>-menu-item" id="submit-<?php echo $identifier ?>-div"
                    <?php wp_nav_menu_disabled_check( $nav_menu_selected_id ); ?> />
                <span class="spinner"></span>
            </span>
        </p>
    </div>
</div>