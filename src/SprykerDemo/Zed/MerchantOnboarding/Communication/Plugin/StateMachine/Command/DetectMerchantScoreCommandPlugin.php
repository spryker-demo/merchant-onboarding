<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Communication\Plugin\StateMachine\Command;

use Generated\Shared\Transfer\MerchantTransfer;
use Generated\Shared\Transfer\StateMachineItemTransfer;
use SprykerDemo\Zed\MerchantOnboarding\MerchantOnboardingConfig;

/**
 * @method \SprykerDemo\Zed\MerchantOnboarding\Communication\MerchantOnboardingCommunicationFactory getFactory()
 */
class DetectMerchantScoreCommandPlugin extends AbstractMerchantOnboardingStateMachineCommandPlugin
{
    /**
     * {@inheritDoc}
     * - Generates and sets detected score for a merchant related to the state machine item.
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
        $merchantTransfer->setDetectedScore(rand(
            MerchantOnboardingConfig::MERCHANT_DETECTED_SCORE_RANGE_FROM,
            MerchantOnboardingConfig::MERCHANT_DETECTED_SCORE_RANGE_TO,
        ));
        $this->getFactory()->getMerchantFacade()->updateMerchant($merchantTransfer);
    }
}
