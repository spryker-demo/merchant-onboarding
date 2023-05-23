<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Communication\Plugin\Merchant;

use Generated\Shared\Transfer\MerchantResponseTransfer;
use Generated\Shared\Transfer\MerchantTransfer;
use Generated\Shared\Transfer\StateMachineProcessTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\MerchantExtension\Dependency\Plugin\MerchantPostCreatePluginInterface;
use SprykerDemo\Zed\MerchantOnboardingStateMachine\MerchantOnboardingStateMachineConfig;

/**
 * @method \SprykerDemo\Zed\MerchantOnboarding\Communication\MerchantOnboardingCommunicationFactory getFacade()
 */
class MerchantStateMachineMerchantPostCreatePlugin extends AbstractPlugin implements MerchantPostCreatePluginInterface
{
    /**
     * {@inheritDoc}
     * - Creates ACL group for provided merchant.
     * - Creates ACL role, ACL rules, ACL entity rules for provided merchant.
     * - Creates ACL entity segment for provided merchant.
     * - Returns `MerchantResponse` transfer object.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantResponseTransfer
     */
    public function postCreate(MerchantTransfer $merchantTransfer): MerchantResponseTransfer
    {
        $merchantTransfer->setFkStateMachineProcess(
            $this->getFactory()->getStateMachineFacade()->getStateMachineProcessId(
                (new StateMachineProcessTransfer())->setProcessName(MerchantOnboardingStateMachineConfig::MERCHANT_ON_BOARDING_STATE_PROCESS_NAME),
            ),
        );
        $merchantResponseTransfer = $this->getFactory()
            ->getMerchantFacade()
            ->updateMerchant($merchantTransfer);

        $stateMachineProcessTransfer = (new StateMachineProcessTransfer())
            ->setProcessName(MerchantOnboardingStateMachineConfig::MERCHANT_ON_BOARDING_STATE_PROCESS_NAME)
            ->setStateMachineName(MerchantOnboardingStateMachineConfig::MERCHANT_STATE_MACHINE_NAME);

        $this->getFactory()->getStateMachineFacade()->triggerForNewStateMachineItem(
            $stateMachineProcessTransfer,
            $merchantTransfer->getIdMerchantOrFail(),
        );

        return $merchantResponseTransfer;
    }
}
