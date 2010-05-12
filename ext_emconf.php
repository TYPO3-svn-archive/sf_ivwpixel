<?php

########################################################################
# Extension Manager/Repository config file for ext "sf_ivwpixel".
#
# Auto generated 10-05-2010 10:15
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'IVW Pixel',
	'description' => 'This extension inserts the IVW pixel at first in the body. The type, code and comment can be insert in the page settings. If non are found the tree gets search recursiv upwards. Empty values are then filled with values from TypoScript.',
	'category' => 'Sebastian Fischer',
	'shy' => 0,
	'version' => '0.0.1',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => 'pages, tt_news',
	'clearcacheonload' => 1,
	'lockType' => '',
	'author' => 'Sebastian Fischer',
	'author_email' => 'typo3@evoweb.de',
	'author_company' => 'evoWeb',
	'CGLcompliance' => '4.3',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:8:{s:12:"ext_icon.gif";s:4:"8c88";s:14:"ext_tables.php";s:4:"1820";s:14:"ext_tables.sql";s:4:"e7a5";s:34:"Configuration/TypoScript/setup.txt";s:4:"5ed4";s:44:"Resources/Private/Language/locallang_tca.xml";s:4:"c35a";s:38:"Resources/Private/Templates/image.html";s:4:"19a6";s:43:"Resources/Private/Templates/javascript.html";s:4:"0f0a";s:31:"pi1/class.tx_sfivwpixel_pi1.php";s:4:"2e7c";}',
	'suggests' => array(
	),
);

?>