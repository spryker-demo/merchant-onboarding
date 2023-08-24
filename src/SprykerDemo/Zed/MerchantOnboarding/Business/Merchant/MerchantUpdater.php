<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Business\Merchant;

use Generated\Shared\Transfer\MerchantResponseTransfer;
use Generated\Shared\Transfer\MerchantTransfer;
use Generated\Shared\Transfer\StateMachineProcessTransfer;
use Spryker\Zed\Merchant\Business\MerchantFacadeInterface;
use Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface;

class MerchantUpdater implements MerchantUpdaterInterface
{
    /**
     * @uses {@link \SprykerDemo\Zed\MerchantOnboardingStateMachine\MerchantOnboardingStateMachineConfig::MERCHANT_ONBOARDING_STATE_PROCESS_NAME}
     *
     * @var string
     */
    public const PROCESS_NAME = 'MerchantOnboardingStateMachine';

    /**
     * @uses {@link \SprykerDemo\Zed\MerchantOnboardingStateMachine\MerchantOnboardingStateMachineConfig::MERCHANT_ONBOARDING_STATE_MACHINE_NAME}
     *
     * @var string
     */
    public const STATEMACHINE_NAME = 'MerchantOnboarding';

    /**
     * @var \Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface
     */
    protected StateMachineFacadeInterface $stateMachineFacade;

    /**
     * @var \Spryker\Zed\Merchant\Business\MerchantFacadeInterface
     */
    protected MerchantFacadeInterface $merchantFacade;

    /**
     * @param \Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface $stateMachineFacade
     * @param \Spryker\Zed\Merchant\Business\MerchantFacadeInterface $merchantFacade
     */
    public function __construct(
        StateMachineFacadeInterface $stateMachineFacade,
        MerchantFacadeInterface $merchantFacade
    ) {
        $this->stateMachineFacade = $stateMachineFacade;
        $this->merchantFacade = $merchantFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantResponseTransfer
     */
    public function updateMerchantWithOnboardingStateMachine(MerchantTransfer $merchantTransfer): MerchantResponseTransfer
    {
        $merchantResponseTransfer = new MerchantResponseTransfer();
        $merchantResponseTransfer->setIsSuccess(true);

        $stateMachineProcessTransfer = (new StateMachineProcessTransfer())
            ->setProcessName(static::PROCESS_NAME)
            ->setStateMachineName(static::STATEMACHINE_NAME);

        $idStateMachineProcess = $this->getIdStateMachineProcess($stateMachineProcessTransfer);

        if ($idStateMachineProcess) {
            $merchantTransfer->setfkStateMachineProcess($idStateMachineProcess);
            $merchantResponseTransfer = $this->merchantFacade
                ->updateMerchant($merchantTransfer);

            $this->stateMachineFacade->triggerForNewStateMachineItem(
                $stateMachineProcessTransfer,
                $merchantTransfer->getIdMerchantOrFail(),
            );
        }

        return $merchantResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\StateMachineProcessTransfer $stateMachineProcessTransfer
     *
     * @return int
     */
    protected function getIdStateMachineProcess(StateMachineProcessTransfer $stateMachineProcessTransfer): int
    {
        return $this->stateMachineFacade->getStateMachineProcessId($stateMachineProcessTransfer);
    }
}
