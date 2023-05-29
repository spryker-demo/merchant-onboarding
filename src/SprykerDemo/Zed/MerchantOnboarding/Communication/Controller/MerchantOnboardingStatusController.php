<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Communication\Controller;

use Generated\Shared\Transfer\MerchantCriteriaTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\MerchantGui\Communication\MerchantGuiCommunicationFactory getFactory()
 */
class MerchantOnboardingStatusController extends AbstractController
{
    /**
     * @var string
     */
    public const URL_PARAM_REDIRECT_URL = 'redirect-url';

    /**
     * @var string
     */
    public const PARAM_ID_MERCHANT = 'id-merchant';

    /**
     * @var string
     */
    public const PARAM_MERCHANT_STATUS = 'merchant-status';

    /**
     * @var string
     */
    protected const MESSAGE_SUCCESS_MERCHANT_STATUS_UPDATE = 'merchant_gui.success_merchant_status_update';

    /**
     * @uses \Spryker\Zed\MerchantGui\Communication\Controller\ListMerchantController::indexAction()
     *
     * @var string
     */
    protected const URL_REDIRECT_MERCHANT_LIST = '/merchant-gui/list-merchant';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(Request $request): RedirectResponse
    {
        $idMerchant = $request->query->getInt(static::PARAM_ID_MERCHANT);
        $newMerchantStatus = $request->query->get(static::PARAM_MERCHANT_STATUS);

        if (!$idMerchant || !$newMerchantStatus) {
            return $this->redirectResponse($request);
        }

        $merchantCriteriaTransfer = new MerchantCriteriaTransfer();
        $merchantCriteriaTransfer->setIdMerchant($idMerchant);
        $merchantTransfer = $this->getFactory()->getMerchantFacade()->findOne($merchantCriteriaTransfer);
        if (!$merchantTransfer) {
            return $this->redirectResponse($request->getRequestUri());
        }

        $merchantTransfer->setStatus((string)$newMerchantStatus);

        $merchantResponseTransfer = $this->getFactory()->getMerchantFacade()->updateMerchant($merchantTransfer);

        if (!$merchantResponseTransfer->getIsSuccess()) {
            return $this->redirectResponse($request);
        }

        $this->addSuccessMessage(static::MESSAGE_SUCCESS_MERCHANT_STATUS_UPDATE);

        return $this->redirectResponse($request->headers->get('referer', static::URL_REDIRECT_MERCHANT_LIST));
    }
}
