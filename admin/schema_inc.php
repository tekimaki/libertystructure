<?php

// Common Content tables
$tables = array(

'liberty_structures' => "
	structure_id I4 PRIMARY,
	root_structure_id I4 NOTNULL,
	content_id I4 NOTNULL,
	structure_level I1 NOTNULL DEFAULT 1,
	pos I4,
	page_alias C(240),
	parent_id I4
",
//	CONSTRAINT ', CONSTRAINT `liberty_root_structure_id_ref` FOREIGN KEY (`root_structure_id`) REFERENCES `".BIT_DB_PREFIX."liberty_structures`( `structure_id` )'

);

global $gBitInstaller;

foreach( array_keys( $tables ) AS $tableName ) {
	$gBitInstaller->registerSchemaTable( LIBERTYSTRUCTURE_PKG_NAME, $tableName, $tables[$tableName], TRUE );
}

// Constraints which must be installed after table creation
/*
$constraints = array(
);
foreach( array_keys($constraints) AS $tableName ) {
	$gBitInstaller->registerSchemaConstraints( LIBERTYSTRUCTURE_PKG_NAME, $tableName, $constraints[$tableName]);
}
*/

$gBitInstaller->registerPackageInfo( LIBERTYSTRUCTURE_PKG_NAME, array(
	'description' => "LibertyStructure is the legacy addon to liberty providing a means to store hierarchical data in early versions of bitweaver.",
	'license' => '<a href="http://www.gnu.org/licenses/licenses.html#LGPL">LGPL</a>',
) );

// ### Indexes
$indices = array (
	'structures_root_idx' => array( 'table' => 'liberty_structures', 'cols' => 'root_structure_id', 'opts' => NULL),
	'structures_parent_idx' => array( 'table' => 'liberty_structures', 'cols' => 'parent_id', 'opts' => NULL),
	'structures_content_idx' => array( 'table' => 'liberty_structures', 'cols' => 'content_id', 'opts' => NULL),
);
$gBitInstaller->registerSchemaIndexes( LIBERTYSTRUCTURE_PKG_NAME, $indices );

// ### Sequences
$sequences = array (
	'liberty_structures_id_seq'  => array( 'start' => 4 ),
);
$gBitInstaller->registerSchemaSequences( LIBERTYSTRUCTURE_PKG_NAME, $sequences );

// ### Default Preferences
/*
$gBitInstaller->registerPreferences( LIBERTYSTRUCTURE_PKG_NAME, array(
) );

// ### Default Values
$gBitInstaller->registerSchemaDefault( LIBERTYSTRUCTURE_PKG_NAME, array(
) );

// ### Default UserPermissions
$gBitInstaller->registerUserPermissions( LIBERTYSTRUCTURE_PKG_NAME, array(
));
*/

// Package Requirements
$gBitInstaller->registerRequirements( LIBERTYSTRUCTURE_PKG_NAME, array(
	'liberty'   => array( 'min' => '2.1.5' ),
));

?>
