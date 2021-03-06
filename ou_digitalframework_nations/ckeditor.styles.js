/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/*
 * This file is used/requested by the 'Styles' button.
 * The 'Styles' button is not enabled by default in DrupalFull and DrupalFiltered toolbars.
 */
if(typeof(CKEDITOR) !== 'undefined') {
    CKEDITOR.addStylesSet( 'drupal',
    [
            /* Block Styles */

            // These styles are already available in the "Format" drop-down list, so they are
            // not needed here by default. You may enable them to avoid placing the
            // "Format" drop-down list in the toolbar, maintaining the same features.
            /*
            { name : 'Paragraph'		, element : 'p' },
            { name : 'Heading 1'		, element : 'h1' },
            { name : 'Heading 2'		, element : 'h2' },
            { name : 'Heading 3'		, element : 'h3' },
            { name : 'Heading 4'		, element : 'h4' },
            { name : 'Heading 5'		, element : 'h5' },
            { name : 'Heading 6'		, element : 'h6' },
            { name : 'Preformatted Text', element : 'pre' },
            { name : 'Address'			, element : 'address' },
            */


            /* Inline Styles */

            // These are core styles available as toolbar buttons. You may opt enabling
            // some of them in the "Styles" drop-down list, removing them from the toolbar.
            /*
            { name : 'Strong'			, element : 'strong', overrides : 'b' },
            { name : 'Emphasis'			, element : 'em'	, overrides : 'i' },
            { name : 'Underline'		, element : 'u' },
            { name : 'Strikethrough'	, element : 'strike' },
            { name : 'Subscript'		, element : 'sub' },
            { name : 'Superscript'		, element : 'sup' },
            */

            { name : 'Highlight',
			 element : 'mark'},

            { name : 'Preformatted',
			 element : 'pre'},

			{ name : 'icon',
			 element : 'i'},

            { name : 'Citation',
			 element : 'cite'},

 			{ name : 'Inline quotation',
			  element : 'q'},

{
    name : 'Image on Left',
    element : 'img',
    attributes :
    {
        'class' : 'align-left',
        'align' : 'left'}
},

{
    name : 'Image on Right',
    element : 'img',
    attributes :
    {
        'class' : 'align-right',
        'align' : 'right'}
},

{
    name : 'Centre Image',
    element : 'img',
    attributes :
    {
        'class' : 'centre-image',
        'align' : 'center'}
},

{
    name : 'Introductory Text',
    element : 'p',
    attributes :
    {
        'class' : 'int-intro-text'
    }
},

{
    name : 'OU list style',
    element : 'ul',
    attributes :
    {
        'class' : 'ou-list'}
}


  ]);
}