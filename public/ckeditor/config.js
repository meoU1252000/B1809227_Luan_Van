/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
//	config.extraPlugins = 'eqneditor';
	config.filebrowserBrowseUrl = "{{ asset('ckfinder/ckfinder.html')}}";
	config.filebrowserImageBrowseUrl = "{{ asset('ckfinder/ckfinder.html?type=Images') }}";
	config.filebrowserFlashBrowseUrl = "{{ asset('ckfinder/ckfinder.html?type=Flash') }}";
	config.filebrowserUploadUrl = "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}";
	config.filebrowserImageUploadUrl = "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}";
	config.filebrowserFlashUploadUrl = "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}";
};
