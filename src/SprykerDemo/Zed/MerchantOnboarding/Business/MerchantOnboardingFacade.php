<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Business;

use Generated\Shared\Transfer\MerchantResponseTransfer;
use Generated\Shared\Transfer\MerchantTransfer;
use Generated\Shared\Transfer\StateMachineItemTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerDemo\Zed\MerchantOnboarding\Business\MerchantOnboardingBusinessFactory getFactory()
 * @method \SprykerDemo\Zed\MerchantOnboarding\Persistence\MerchantOnboardingRepositoryInterface getRepository()
 */
class MerchantOnboardingFacade extends AbstractFacade implements MerchantOnboardingFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $stateIds
     *
     * @return array<\Generated\Shared\Transfer\StateMachineItemTransfer>
     */
    public function getStateMachineItemsByStateIds(array $stateIds): array
    {
        return $this->getRepository()->getStateMachineItemsByStateIds($stateIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\StateMachineItemTransfer $stateMachineItemTransfer
     *
     * @return bool
     */
    public function saveStateMachineItemToMerchant(StateMachineItemTransfer $stateMachineItemTransfer): bool
    {
        return $this->getFactory()->createStateMachineItemSaver()
            ->saveStateMachineItemToMerchant($stateMachineItemTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantTransfer
     */
    public function expandMerchantWithStateMachineData(MerchantTransfer $merchantTransfer): MerchantTransfer
    {
        return $this->getFactory()->createMerchantStateMachineDataExpander()
            ->expand($merchantTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantResponseTransfer
     */
    public function updateMerchantWithOnboardingStateMachine(MerchantTransfer $merchantTransfer): MerchantResponseTransfer
    {
        return $this->getFactory()
            ->createMerchantStateMachineUpdater()
            ->updateMerchantWithOnboardingStateMachine($merchantTransfer);
    }
}
