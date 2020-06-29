<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgTransifex module for xoops
 *
 * @copyright      2020 XOOPS Project (https://xooops.org)
 * @license        GPL 2.0 or later
 * @package        wgtransifex
 * @since          1.0
 * @min_xoops      2.5.9
 * @author         TDM XOOPS - Email:<info@email.com> - Website:<http://xoops.org>
 */

use Xmf\Request;
use XoopsModules\Wgtransifex;
use XoopsModules\Wgtransifex\Constants;
use XoopsModules\Wgtransifex\Common;

require __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'wgtransifex_languages.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$op    = Request::getCmd('op', 'list');
$start = Request::getInt('start', 0);
$limit = Request::getInt('limit', $helper->getConfig('userpager'));
$langId = Request::getInt('lang_id', 0);

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);

$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('wgtransifex_url', WGTRANSIFEX_URL);
$GLOBALS['xoopsTpl']->assign('modPathIconFlags', WGTRANSIFEX_IMAGE_URL . '/flags/');

$keywords = [];

$GLOBALS['xoopsTpl']->assign('showItem', $langId > 0);

switch ($op) {
	case 'show':
	case 'list':
	default:
		$crLanguages = new \CriteriaCompo();
		if ($langId > 0) {
			$crLanguages->add(new \Criteria('lang_id', $langId));
		}
		$languagesCount = $languagesHandler->getCount($crLanguages);
		$GLOBALS['xoopsTpl']->assign('languagesCount', $languagesCount);
		$crLanguages->setSort('lang_name');
        $crLanguages->setStart($start);
		$crLanguages->setLimit($limit);
		$languagesAll = $languagesHandler->getAll($crLanguages);
		if ($languagesCount > 0) {
			$languages = [];
			// Get All Languages
			foreach (array_keys($languagesAll) as $i) {
				$languages[$i] = $languagesAll[$i]->getValuesLanguages();
				$keywords[$i] = $languagesAll[$i]->getVar('lang_name');
			}
			$GLOBALS['xoopsTpl']->assign('languages', $languages);
			unset($languages);
			// Display Navigation
			if ($languagesCount > $limit) {
				include_once XOOPS_ROOT_PATH . '/class/pagenav.php';
				$pagenav = new \XoopsPageNav($languagesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
			$GLOBALS['xoopsTpl']->assign('type', $helper->getConfig('table_type'));
			$GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
			$GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
		}
		break;
}

// Breadcrumbs
$xoBreadcrumbs[] = ['title' => _MA_WGTRANSIFEX_LANGUAGES];

// Keywords
wgtransifexMetaKeywords($helper->getConfig('keywords') . ', ' . implode(',', $keywords));
unset($keywords);

// Description
wgtransifexMetaDescription(_MA_WGTRANSIFEX_LANGUAGES_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', WGTRANSIFEX_URL.'/languages.php');
$GLOBALS['xoopsTpl']->assign('wgtransifex_upload_url', WGTRANSIFEX_UPLOAD_URL);

require __DIR__ . '/footer.php';
