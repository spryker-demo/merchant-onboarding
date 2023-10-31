<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Communication\Plugin\StateMachine\Command;

use Generated\Shared\Transfer\MerchantTransfer;
use Generated\Shared\Transfer\StateMachineItemTransfer;

/**
 * @method \SprykerDemo\Zed\MerchantOnboarding\Communication\MerchantOnboardingCommunicationFactory getFactory()
 */
class ApproveMerchantCommandPlugin extends AbstractMerchantOnboardingStateMachineCommandPlugin
{
    /**
     * @uses {@link \Spryker\Zed\MerchantGui\MerchantGuiConfig::STATUS_APPROVED}
     *
     * @var string
     */
    protected const STATUS_APPROVED = 'approved';

    /**
     * {@inheritDoc}
     * - Sets `approved` onboarding status for a merchant related to the state machine item.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\StateMachineItemTransfer $stateMachineItemTransfer
     *
     * @return void
     */
    public function run(StateMachineItemTransfer $stateMachineItemTransfer): void
    {
        parent::run($stateMachineItemTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
     *
     * @return void
     */
    protected function updateMerchant(MerchantTransfer $merchantTransfer): void
    {
        $merchantTransfer->setStatus(static::STATUS_APPROVED);
        $this->getFactory()->getMerchantFacade()->updateMerchant($merchantTransfer);
    }
}
