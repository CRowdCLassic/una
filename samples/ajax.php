<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 *
 * @defgroup    DolphinCore Samples
 * @{
 */

/** 
 * @page samples
 * @section ajax AJAX loader
 */

$aPathInfo = pathinfo(__FILE__);
require_once ($aPathInfo['dirname'] . '/../inc/header.inc.php');
require_once(BX_DIRECTORY_PATH_INC . "params.inc.php");
require_once(BX_DIRECTORY_PATH_INC . "design.inc.php");

bx_import('BxDolLanguages');
bx_import('BxTemplFunctions');

if  (bx_get('ajax') || (isset( $_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    sleep(5);
    echo '<div class="bx-def-padding bx-def-color-bg-block">AJAX content here: ' .  date(DATE_RFC822) . '</div>';
    exit;
}

$oTemplate = BxDolTemplate::getInstance();
$oTemplate->setPageNameIndex (BX_PAGE_DEFAULT);
$oTemplate->setPageHeader ("AJAX");
$oTemplate->setPageContent ('page_main_code', PageCompMainCode());
$oTemplate->getPageCode();


/**
 * page code function
 */
function PageCompMainCode() {

    ob_start();

    echo '<button class="bx-btn" onclick="getHtmlData(\'bx-result\', \'' . BX_DOL_URL_ROOT . 'samples/ajax.php?ajax=1\')">Нажми Меня</button><div class="bx-clear"></div>';
    echo '<div id="bx-result" style="width:500px; height:200px;" class="bx-def-border bx-def-round-corners bx-def-margin-top"></div>';

    return DesignBoxContent("AJAX", ob_get_clean(), BX_DB_PADDING_DEF);
}


/** @} */
