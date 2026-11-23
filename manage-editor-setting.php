<?php
// Manage Editor Setting / Kiri Vadivelu / 2026
// Removes the Openverse tab from the Media section 
// Disable contentOnly editing mode for unsynced patterns
// Plus other editor default configuration in the callback
add_filter( 'block_editor_settings_all', function ( $settings ) {
    $settings['enableOpenverseMediaCategory'] = false;
    $settings['disableContentOnlyForUnsyncedPatterns'] = true;
    $settings['disableContentOnlyForTemplateParts'] = true;
    $settings['codeEditingEnabled'] = false;
    $settings['canLockBlocks'] = false;
    $settings['blockStatesEditingEnabled'] = false;
    $settings['responsiveEditingEnabled'] = false;
    $settings['generateAnchors'] = true;
    return $settings;
}, 10 );  