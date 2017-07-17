<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(
    ['prefix' => 'resources'],
    function () {
        Route::get(
            '/',
            function () {
                dd('This is the Resources module index page.');
            }
        );
    }
);
Route::get('/admin/test2', function () {
    return view('resources::test');
});
Route::group(
    ['prefix' => 'admin/resources'],
    function () {
        Route::get('/widgets/backend', 'WidgetController@getIndex');
        Route::post('/widgets/widget-with-type', 'WidgetController@postUiWithType');
        Route::post('/widgets/upload-widget', 'WidgetController@postUploadUi');
        Route::get('/widgets/frontend', 'WidgetController@getFrontend');
        Route::get('/widgets/widgets-variations/{slug}', 'WidgetController@getUiVariations');
        Route::post('/widgets/widgets-variations/{slug}', 'WidgetController@postUiVariations');
        Route::get('/widgets/settings/{slug}', 'WidgetController@getSettings');
        Route::get('/widgets/settings-live/{slug}', 'WidgetController@widgetPerview');
        Route::get('/widgets/settings-iframe/{slug}/{settings?}', 'WidgetController@widgetPerviewIframe');
        Route::post('/widgets/settings-iframe/{id}/{save?}', 'WidgetController@postSettings');
        Route::post('/widgets/settings/{id}/{save?}', 'WidgetController@postSettings');
        Route::post('/widgets/delete', 'WidgetController@postDelete');
        Route::any('/widgets/delete-variation/{slug}', 'WidgetController@getDeleteVariation');
        Route::any('/widgets/make-default/{slug}', 'WidgetController@getMakeDefault');
        Route::any('/widgets/make-default-variation/{slug}', 'WidgetController@getDefaultVariation');

        Route::get('/core_assest', 'AssestController@getIndex');
        Route::get('/core_assest/fonts', 'AssestController@getFonts');
        Route::get('/core_assest/fonts-list', 'AssestController@getFontsList');
        Route::get('/core_assest/font-icons/{lib}', 'AssestController@getFontIcons');

        // Units
        Route::get('/units/backend', 'UnitController@getIndex');
        Route::get('/units/frontend', 'UnitController@getFrontend');
        Route::post('/units/unit-with-type', 'UnitController@postUnitWithType');
        Route::post('/units/upload-unit', 'UnitController@postUploadUnit');
        Route::post('/units/delete', 'UnitController@postDelete');
        Route::get('units/units-variations/{slug}', 'UnitController@getUnitVariations');
        Route::post('/units/units-variations/{slug}', 'UnitController@postUnitVariations');
        Route::get('units/delete-variation/{slug}', 'UnitController@getDeleteUnit');
        Route::get('/units/settings/{slug}', 'UnitController@getSettings');
        Route::get('/units/live-settings/{slug}', 'UnitController@unitPreview');
        Route::get('/units/settings-iframe/{slug}/{settings?}', 'UnitController@unitPerviewIframe');
        Route::post('/units/settings/{id}/{save?}', 'UnitController@postSettings');
        Route::any('/units/make-default/{slug}', 'UnitController@getMakeDefault');
        Route::any('/units/make-default-variation/{slug}', 'UnitController@getDefaultVariation');


        //classes
        Route::get('/styles', 'StylesController@getIndex');
        Route::post('/styles/upload', 'StylesController@postUpload');
        Route::get('/styles/optimize', 'StylesController@getOptimize');
        Route::post('/styles/render-styles', 'StylesController@postRenderStyles');
        Route::post('/styles/show_popup', 'StylesController@postShowPopUp');
        Route::get('/styles/create-sub/{type}', 'StylesController@getCreateSub');

        Route::get('/styles/delete/{id}', 'StylesController@getStyleDelete');
        Route::post('/styles/add-sub', 'StylesController@postAddSub');
        Route::get('/styles/make-default/{style_id}/{id}', 'StylesController@makeDefault');
        Route::get('/styles/style_preview/{style_id}', 'StylesController@getStylePreview');
        Route::post('/styles/style_preview/{style_id}', 'StylesController@postStylePreview');
        Route::post('/styles/style_preview/css', 'StylesController@postStyleCssUpdate');


        Route::get('/form-validation', 'FieldValidationController@getIndex');
        Route::post('/form-test', 'FieldValidationController@postFormTest');
        Route::get('/form-types-rules', 'FieldValidationController@getRules');
        Route::post('/form-rule', 'FieldValidationController@postFormRule');
        Route::post('/form-rule-save', 'FieldValidationController@postFormRuleSave');


        Route::get('/pages-layout', 'PagesLayoutController@getPagesLayout');
        Route::get('/pages-layout/delete/{slug}', 'PagesLayoutController@getPagesLayoutDelete');
        Route::get('/pages-layout/settings/{slug}', 'PagesLayoutController@settings');
        Route::post('/pages-layout/settings/{slug}/{save?}', 'PagesLayoutController@postLayoutSettings');
        Route::post('/upload-layout', 'PagesLayoutController@postUploadLayout');

        Route::get('/files', 'FilesController@getIndex');
        Route::post('/files/files-with-type', 'FilesController@postFilesWithType');
        Route::post('/files/upload', 'FilesController@postUpload');
    }
);
Route::group(['prefix' => 'admin/templates', 'middleware' => ['admin:Users']], function () {

    Route::get('/', 'TemplateController@getIndex');
    Route::get('/front-themes', 'TemplateController@gatFrontThemes');
    Route::get('/front-themes-activate/{slug}', 'TemplateController@activateFrontTheme');
    Route::get('/tpl-variations/{slug}', 'TemplateController@getTplVariations');
    Route::post('/tpl-variations/{slug}', 'TemplateController@postTplVariations');
    Route::post('/get-variations', 'TemplateController@postGetVariations');
    Route::post('/edit-variation', 'TemplateController@postEditVariation');
    Route::get('/delete-variation/{slug}', 'TemplateController@getDeleteVariation');
    Route::get('/settings-live/{slug}', 'TemplateController@TemplatePerview');
    Route::get('/settings-iframe/{slug}/{page_id}/{edit?}', 'TemplateController@TemplatePerviewIframe');
    Route::get('/settings-edit-theme/{slug}/{settings?}', 'TemplateController@TemplatePerviewEditIframe');
    Route::post('/settings/{id}/{save?}', 'TemplateController@postSettings');


    Route::post('/new-type', 'TemplateController@postNewType');
    Route::post('/delete-type', 'TemplateController@postDeleteType');
    Route::post('/delete', 'TemplateController@postDelete');
    Route::post('/upload-template', 'TemplateController@postUploadTemplate');
    Route::post('/templates-with-type', 'TemplateController@postTemplatesWithType');
    Route::post('/templates-in-modal', 'TemplateController@postTemplatesInModal');
});
Route::group(['prefix' => 'api/resources'], function () {
    Route::resource('/templates', 'Api\TemplatesController');
});