<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Business\Updater;

use Generated\Shared\Transfer\MerchantResponseTransfer;
use Generated\Shared\Transfer\MerchantTransfer;
use Generated\Shared\Transfer\StateMachineProcessTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;
use Spryker\Zed\Merchant\Business\MerchantFacadeInterface;
use Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface;
use SprykerDemo\Zed\MerchantOnboarding\MerchantOnboardingConfig;

class StateMachineMerchantUpdater implements StateMachineMerchantUpdaterInterface
{
    use TransactionTrait;

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
        $stateMachineProcessId = $this->getIdStateMachineProcess();

        if ($stateMachineProcessId) {
            return $this->updateMerchantWithStateMachineProcessId($merchantTransfer, $stateMachineProcessId);
        }

        return (new MerchantResponseTransfer())->setIsSuccess(false);
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
     * @param int $stateMachineProcessId
     *
     * @return \Generated\Shared\Transfer\MerchantResponseTransfer
     */
    protected function updateMerchantWithStateMachineProcessId(MerchantTransfer $merchantTransfer, int $stateMachineProcessId): MerchantResponseTransfer
    {
        $merchantTransfer->setFkStateMachineProcess($stateMachineProcessId);

        return $this->getTransactionHandler()->handleTransaction(function () use ($merchantTransfer) {
            return $this->executeUpdateMerchantWithStateMachineProcessIdTransaction($merchantTransfer);
        });
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantResponseTransfer
     */
    protected function executeUpdateMerchantWithStateMachineProcessIdTransaction(MerchantTransfer $merchantTransfer): MerchantResponseTransfer
    {
        $merchantResponseTransfer = $this->merchantFacade
            ->updateMerchant($merchantTransfer);

        $this->stateMachineFacade->triggerForNewStateMachineItem(
            $this->createStateMachineProcessTransfer(),
            $merchantTransfer->getIdMerchantOrFail(),
        );

        return $merchantResponseTransfer;
    }

    /**
     * @return int
     */
    protected function getIdStateMachineProcess(): int
    {
        return $this->stateMachineFacade->getStateMachineProcessId(
            $this->createStateMachineProcessTransfer(),
        );
    }

    /**
     * @return \Generated\Shared\Transfer\StateMachineProcessTransfer
     */
    protected function createStateMachineProcessTransfer(): StateMachineProcessTransfer
    {
        return (new StateMachineProcessTransfer())->setProcessName(MerchantOnboardingConfig::MERCHANT_ONBOARDING_STATE_PROCESS_NAME)
            ->setStateMachineName(MerchantOnboardingConfig::MERCHANT_ONBOARDING_STATE_MACHINE_NAME);
    }
}
