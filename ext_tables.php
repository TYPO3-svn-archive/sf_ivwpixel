<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$tempColumns = Array (
	'tx_sfivwpixel_type' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:sf_ivwpixel/Resources/Private/Language/locallang_tca.xml:pages.tx_sfivwpixel_type',
		'config' => Array (
			'type' => 'select',
			'items' => Array (
				Array('LLL:EXT:sf_ivwpixel/Resources/Private/Language/locallang_tca.xml:pages.tx_sfivwpixel_type.I.0', 'CP'),
				Array('LLL:EXT:sf_ivwpixel/Resources/Private/Language/locallang_tca.xml:pages.tx_sfivwpixel_type.I.1', 'NP'),
			),
			'size' => 1,
			'maxitems' => 1,
		)
	),
	'tx_sfivwpixel_code' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:sf_ivwpixel/Resources/Private/Language/locallang_tca.xml:pages.tx_sfivwpixel_code',
		'config' => Array (
			'type' => 'input',
			'size' => '12',
			'max' => '12',
		)
	),
	'tx_sfivwpixel_comment' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:sf_ivwpixel/Resources/Private/Language/locallang_tca.xml:pages.tx_sfivwpixel_comment',
		'config' => Array (
			'type' => 'input',
			'size' => '30',
		)
	),
);

t3lib_div::loadTCA('pages');
t3lib_extMgm::addTCAcolumns('pages', $tempColumns, 1);
t3lib_extMgm::addToAllTCAtypes('pages', '--div--;LLL:EXT:sf_ivwpixel/Resources/Private/Language/locallang_tca.xml:pages.tx_sfivwpixel_div, tx_sfivwpixel_type;;;;1-1-1, tx_sfivwpixel_code, tx_sfivwpixel_comment');

t3lib_div::loadTCA('tt_news');
t3lib_extMgm::addTCAcolumns('tt_news', $tempColumns, 1);
t3lib_extMgm::addToAllTCAtypes('tt_news', '--div--;LLL:EXT:sf_ivwpixel/Resources/Private/Language/locallang_tca.xml:tt_news.tx_sfivwpixel_div, tx_sfivwpixel_type;;;;1-1-1, tx_sfivwpixel_code, tx_sfivwpixel_comment');



t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/', 'IVW Pixel');

?>