<?php
/**
 * @version $Header$
 * 
 * @package liberty
 * @subpackage modules
 */
 
/**
 * Initial Setup
 */
global $gStructure, $gContent, $moduleParams;
extract( $moduleParams );

$struct = NULL;

if( is_object( $gStructure ) && $gStructure->isValid() ) {
	$struct = &$gStructure;
} elseif( @BitBase::verifyId( $module_params['structure_id'] ) ) {
		require_once( LIBERTYSTRUCTURE_PKG_PATH.'LibertyStructure.php' );
		$struct = new LibertyStructure( $module_params['structure_id'] );
		$struct->load();
} elseif( is_object( $gContent ) ) {
	require_once( LIBERTYSTRUCTURE_PKG_PATH.'LibertyStructure.php' );
	$structures = LibertyStructure::getStructures( $gContent );
	// We take the first structure. not good, but works for now - spiderr
	if( !empty( $structures[0] ) ) {
		$struct = new LibertyStructure( $structures[0]['structure_id'] );
		$struct->load();
	}
}

if( is_object( $struct ) && count( $struct->isValid() ) ) {
	$gBitSmarty->assign( 'modStructureTOC', $struct->getToc( $struct->mInfo['root_structure_id'] ) );
}
?>



