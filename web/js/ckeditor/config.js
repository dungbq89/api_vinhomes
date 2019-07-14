/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

    config.extraPlugins = 'youtube,lineheight,videodetector,googledocs,letterspacing,audio';
    //config youtube
    config.youtube_width = '640';
    config.youtube_height = '480';
    config.youtube_related = true;
    config.youtube_older = false;
    config.youtube_privacy = false;
    //config line height
    config.line_height="22px;24px;25px;26px;28px;30px;32px";

    config.toolbar_Basic =
        [
             [ 'Bold','Italic','Underline','Strike','-','RemoveFormat' ],
             [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
             '-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
             [ 'Link','Unlink','Anchor' ] ,
             [ 'Image','Table','HorizontalRule' ],
            [ 'Styles','Format','Font','FontSize' ] ,
            [ 'TextColor','BGColor' ],
            [ 'ShowBlocks' ],
            [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ]
        ];
    config.toolbar_Full =
        [
            ['Source','DocProps','-','Save','NewPage','Preview','Templates'],
            [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
            [ 'Bold','Italic','Underline','Strike', 'Subscript', 'Superscript' ],
            [ 'list', 'indent', 'blocks', 'align', 'bidi' ],
            [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
                '-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
            [ 'Link','Unlink','Anchor' ] ,
            [ 'Image','Flash','Youtube','VideoDetector','audio','Googledocs','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
            [ 'TextColor','BGColor' ], [ 'FitWindow','ShowBlocks'],
            [ 'Styles','Format','Font','FontSize','lineheight','letterspacing' ]
        ];
    config.toolbar_simple =[];
	
}
CKEDITOR.plugins.setLang('lineheight','en', {
    title: 'Line Height'
} );
CKEDITOR.plugins.setLang('letterspacing','en', {
    title: 'Tracking'
} );
