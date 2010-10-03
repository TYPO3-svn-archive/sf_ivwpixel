<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010 Sebastian Fischer (typo3@evoweb.de)
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Plugin 'IVW Pixel' for the 'sf_ivwpixel' extension.
 *
 * @author	Sebastian Fischer <typo3@evoweb.de>
 */
class tx_sfivwpixel_pi1 {
	/**
	 * @var	array
	 */
	protected $settings = array();

	/**
	 * @var	boolean
	 */
	protected $isNewsDetailPage = false;

	/**
	 * Main method called for outputting the pixel on page
	 *
	 * @param	string
	 * @param	array
	 * @return	string
	 */
	public function main($content, $conf) {
		$this->init($conf);

		if ($this->isNewsDetailPage) {
			$data = $this->fetchNewsData();
		} else {
			$data = $this->fetchPageData($GLOBALS['TSFE']->id);
		}

		$ivwValues = $this->settings['default.'];
		foreach ($data as $key => $value) {
			if (!isset($ivwValues[$key]) OR
					$ivwValues[$key] == '' OR
					$value != '') {
				$ivwValues[$key] = $value;
			}
		}

		$content = $this->render($ivwValues);
		return $content;
	}

	/**
	 * Initialize some values for this class
	 *
	 * @param	array
	 * @return	void
	 */
	protected function init($settings) {
		$this->settings = $settings;

		$newsParam = t3lib_div::_GP('tx_ttnews');
		if (intval($newsParam['tt_news'])) {
			$this->isNewsDetailPage = true;
			$this->settings['newsUid'] = intval($newsParam['tt_news']);
		}
	}

	/**
	 * Fetch ivw values from news record
	 *
	 * @return	array
	 */
	protected function fetchNewsData() {
		$result = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
			'tx_sfivwpixel_type AS type,
				tx_sfivwpixel_code AS code,
				tx_sfivwpixel_comment AS comment',
			'tt_news',
			'uid = ' . $this->settings['newsUid'] . $this->cObj->enableFields('tt_news')
		);

		return $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result);
	}

	/**
	 * Fetch ivw values from page recursive
	 *
	 * @return	array
	 */
	protected function fetchPageData($uid) {
		$result = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
			'pid,
				tx_sfivwpixel_type AS type,
				tx_sfivwpixel_code AS code,
				tx_sfivwpixel_comment AS comment',
			'pages',
			'uid = ' . $uid . $this->cObj->enableFields('pages')
		);

		$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result);

		if ($row['code'] == '' AND
				$row['type'] == $this->settings['default.']['type'] AND
				$row['pid'] > 0) {
			$data = $this->fetchPageData($row['pid']);
		} else {
			unset($row['pid']);
			$data = $row;
		}

		return $data;
	}

	/**
	 * Fetch template put marker together and replace them in the template before
	 * output
	 *
	 * @param	array
	 * @return	string
	 */
	protected function render($data) {
		$template = $this->fetchTemplate();

		$markerArray = array(
			'supplyidentifier' => $this->settings['supplyidentifier'],
			'type' => $data['type'],
			'code' => $data['code'],
			'comment' => $data['comment'],
			'referrer' => $_SERVER["HTTP_REFERER"],
			'random' => mt_rand(),
		);

		return $this->cObj->substituteMarkerArray(
			$template,
			$markerArray,
			'###|###',
			true,
			true
		);
	}

	/**
	 * Fetch either javascript.html or image.html template content
	 *
	 * @return	string
	 */
	protected function fetchTemplate() {
		if ($this->settings['output'] == 'javascript') {
			$file = 'javascript.html';
		} else {
			$file = 'image.html';
		}

		return $this->cObj->fileResource($this->settings['templatePath'] . $file);
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sf_ivwpixel/pi1/class.tx_sfivwpixel_pi1.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sf_ivwpixel/pi1/class.tx_sfivwpixel_pi1.php']);
}

?>
