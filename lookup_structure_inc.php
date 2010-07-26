<?php
/**
 * lookup_content_inc
 *
 * @author   spider <spider@steelsun.com>
 * @version  $Revision$
 * @package  liberty
 * @subpackage functions
 */
	global $gContent;

	/**
	 * required setup
	 */
	require_once( LIBERTYSTRUCTURE_PKG_PATH.'LibertyStructure.php');

	if( @BitBase::verifyId( $_REQUEST['structure_id'] ) ) {
		$_REQUEST['structure_id'] = preg_replace( '/[\D]/', '', $_REQUEST['structure_id'] );
		$gStructure = new LibertyStructure( $_REQUEST['structure_id'] );
	}elseif( @BitBase::verifyId( $_REQUEST['content_id'] ) ) {
		$gStructure = new LibertyStructure( NULL, $_REQUEST['content_id'] );
	}else{
		$gStructure = new LibertyStructure();
	}
	
	if( $gStructure->load() ) {
//	vd( $gStructure->mInfo );
			$gStructure->loadNavigation();
			$gStructure->loadPath();
			$gBitSmarty->assign( 'structureInfo', $gStructure->mInfo );
	//		$_REQUEST['page_id'] = $gStructure->mInfo['page_id'];
			if( $viewContent = $gStructure->getLibertyObject( $gStructure->mInfo['content_id'], $gStructure->mInfo['content_type']['content_type_guid'] ) ) {
				$viewContent->setStructure( $_REQUEST['structure_id'] );
				$gBitSmarty->assign_by_ref( 'pageInfo', $viewContent->mInfo );
				$gContent = &$viewContent;
				$gBitSmarty->assign_by_ref( 'gContent', $gContent );
			}
		}
	}

