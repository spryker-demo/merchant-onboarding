<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Communication\Controller;

use Generated\Shared\Transfer\StateMachineItemTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Spryker\Zed\MerchantGui\MerchantGuiConfig;
use SprykerDemo\Zed\MerchantOnboardingStateMachine\MerchantOnboardingStateMachineConfig;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerDemo\Zed\MerchantOnboarding\Communication\MerchantOnboardingCommunicationFactory getFactory()
 */
class MerchantOnboardingStateMachineController extends AbstractController
{
    /**
     * @var string
     */
    public const REQUEST_ID_MERCHANT = 'id-merchant';

    /**
     * @var string
     */
    protected const REQUEST_EVENT = 'event';

    /**
     * @var string
     */
    protected const REQUEST_ID_STATE_MACHINE_STATE = 'id_state_machine_state';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function triggerEventAction(Request $request): RedirectResponse
    {
        $idMerchant = $this->castId($request->get(static::REQUEST_ID_MERCHANT));
        $event = $request->get(static::REQUEST_EVENT);
        $idStateMachineState = $request->get(static::REQUEST_ID_STATE_MACHINE_STATE);

        $this->getFactory()->getStateMachineFacade()->triggerEvent(
            $event,
            (new StateMachineItemTransfer())->setIdentifier($idMerchant)
                ->setProcessName(MerchantOnboardingStateMachineConfig::MERCHANT_ONBOARDING_STATE_PROCESS_NAME)
                ->setStateMachineName(MerchantOnboardingStateMachineConfig::MERCHANT_ONBOARDING_STATE_MACHINE_NAME)
                ->setIdItemState($idStateMachineState),
        );

        return $this->redirectResponse($request->headers->get('referer', MerchantGuiConfig::URL_MERCHANT_LIST));
    }
}
