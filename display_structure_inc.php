<?php
/**
 * display_structure_inc
 *
 * @author   spider <spider@steelsun.com>
 * @version  $Revision$
 * @package  liberty
 * @subpackage functions
 */

/**
 * required setup
 */
	global $gContent;
	include_once( LIBERTYSTRUCTURE_PKG_PATH.'lookup_structure_inc.php' );
	if( is_object( $gContent ) && $gContent->isValid() ) {
		$gBitSystem->setBrowserTitle( $gStructure->getRootTitle().' : '.$gContent->getTitle() );
		include $gContent->getRenderFile();
	} else {
		$gBitSystem->setHttpStatus( 404 );
		$gBitSystem->fatalError( tra( 'Page cannot be found' ));
	}
?>
