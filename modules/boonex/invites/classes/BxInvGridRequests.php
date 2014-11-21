<?php defined('BX_DOL') or die('hack attempt');
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 *
 * @defgroup    Invites Invites
 * @ingroup     DolphinModules
 * 
 * @{
 */

bx_import('BxDolModule');
bx_import('BxTemplGrid');

class BxInvGridRequests extends BxTemplGrid
{
	protected $_sModule;
	protected $_oModule;

    public function __construct ($aOptions, $oTemplate = false)
    {
        parent::__construct ($aOptions, $oTemplate);

		$this->_sModule = 'bx_invites';
		$this->_oModule = BxDolModule::getInstance($this->_sModule);
    }

	public function performActionInvite($aParams = array())
    {
    	$iProfileId = $this->_oModule->getProfileId();

    	$mixedAllowed = $this->_oModule->isAllowedInvite($iProfileId);
    	if($mixedAllowed !== true) {
	    	$this->_echoResultJson(array('msg' => $mixedAllowed));
			exit;
    	}

        $iAffected = 0;
        $aIds = bx_get('ids');
        if(!$aIds || !is_array($aIds)) {
            $this->_echoResultJson(array());
            exit;
        }

        $sText = _t('_bx_invites_msg_invitation');

        $aIdsAffected = array ();
        foreach($aIds as $iId) {
			$aRequest = $this->_oModule->_oDb->getRequests(array('type' => 'by_id', 'value' => $iId));
			if(empty($aRequest) || !is_array($aRequest))
				continue;

        	$mixedResult = $this->_oModule->invite($aRequest['email'], $sText);
        	if($mixedResult === false)
        		continue;

			$this->_oModule->isAllowedInvite($iProfileId, true);

            $aIdsAffected[] = $iId;
            $iAffected++;
        }

        $this->_echoResultJson($iAffected ? array('grid' => $this->getCode(false), 'blink' => $aIdsAffected, 'msg' => _t('_bx_invites_msg_invitation_sent', $iAffected)) : array('msg' => _t('_bx_invites_err_invite')));
    }
	public function performActionDelete($aParams = array())
    {
    	$iProfileId = $this->_oModule->getProfileId();

    	$mixedAllowed = $this->_oModule->isAllowedDeleteRequest($iProfileId);
    	if($mixedAllowed !== true) {
	    	$this->_echoResultJson(array('msg' => $mixedAllowed));
			exit;
    	}

        $iAffected = 0;
        $aIds = bx_get('ids');
        if(!$aIds || !is_array($aIds)) {
            $this->_echoResultJson(array());
            exit;
        }

        bx_import('BxDolForm');
        $oForm = BxDolForm::getObjectInstance($this->_oModule->_oConfig->getObject('form_request'), $this->_oModule->_oConfig->getObject('form_display_request_send'));

        $aIdsAffected = array ();
        foreach($aIds as $iId) {
        	if(!$oForm->delete($iId))
                continue;

			$this->_oModule->isAllowedDeleteRequest($iProfileId, true);

            $aIdsAffected[] = $iId;
            $iAffected++;
        }

        $this->_echoResultJson($iAffected ? array('grid' => $this->getCode(false), 'blink' => $aIdsAffected) : array('msg' => _t('_bx_invites_err_delete_request')));
    }

	protected function _getCellNip($mixedValue, $sKey, $aField, $aRow)
    {
        return parent::_getCellDefault(long2ip($mixedValue), $sKey, $aField, $aRow);
    }

	protected function _getCellDate($mixedValue, $sKey, $aField, $aRow)
    {
        return parent::_getCellDefault(bx_time_js($mixedValue), $sKey, $aField, $aRow);
    }
}

/** @} */
