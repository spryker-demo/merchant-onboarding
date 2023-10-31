<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Communication\Plugin\StateMachine\Command;

use Generated\Shared\Transfer\MerchantCriteriaTransfer;
use Generated\Shared\Transfer\MerchantTransfer;
use Generated\Shared\Transfer\StateMachineItemTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\StateMachine\Dependency\Plugin\CommandPluginInterface;

/**
 * @method \SprykerDemo\Zed\MerchantOnboarding\Communication\MerchantOnboardingCommunicationFactory getFactory()
 */
abstract class AbstractMerchantOnboardingStateMachineCommandPlugin extends AbstractPlugin implements CommandPluginInterface
{
    /**
     * {@inheritDoc}
     * - Provides basic logic for merchant onboarding state machine plugins.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\StateMachineItemTransfer $stateMachineItemTransfer
     *
     * @return void
     */
    public function run(StateMachineItemTransfer $stateMachineItemTransfer): void
    {
        $merchantTransfer = $this->findMerchantByStateMachineItem($stateMachineItemTransfer);

        if (!$merchantTransfer) {
            return;
        }

        $this->updateMerchant($merchantTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\StateMachineItemTransfer $stateMachineItemTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantTransfer|null
     */
    protected function findMerchantByStateMachineItem(StateMachineItemTransfer $stateMachineItemTransfer): ?MerchantTransfer
    {
        $merchantCriteriaTransfer = new MerchantCriteriaTransfer();
        $merchantCriteriaTransfer->setIdMerchant(
            $stateMachineItemTransfer->getIdentifier(),
        );

        return $this->getFactory()
            ->getMerchantFacade()
            ->findOne($merchantCriteriaTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
     *
     * @return void
     */
    abstract protected function updateMerchant(MerchantTransfer $merchantTransfer): void;
}
