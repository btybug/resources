<?php
// Classes Related Bread Crumbs
Breadcrumbs::register(
    'classes_text',
    function ($breadcrumbs) {
        $breadcrumbs->parent('admin');
        $breadcrumbs->push('Assests');
        $breadcrumbs->push('Classes / Text');
    }
);


Breadcrumbs::register(
    'assets_fonts',
    function ($breadcrumbs) {
        $breadcrumbs->parent('admin');
        $breadcrumbs->push('Assests');
        $breadcrumbs->push('Fonts');
    }
);

