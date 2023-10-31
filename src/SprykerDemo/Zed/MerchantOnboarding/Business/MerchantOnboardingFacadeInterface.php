<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Business;

use Generated\Shared\Transfer\MerchantResponseTransfer;
use Generated\Shared\Transfer\MerchantTransfer;
use Generated\Shared\Transfer\StateMachineItemTransfer;

interface MerchantOnboardingFacadeInterface
{
    /**
     * Specification:
     * - Gets State machine items by state ids.
     *
     * @api
     *
     * @param array<int> $stateIds
     *
     * @return array<\Generated\Shared\Transfer\StateMachineItemTransfer>
     */
    public function getStateMachineItemsByStateIds(array $stateIds): array;

    /**
     * Specification:
     * - Updates merchant with `StateMachineItemTransfer.idItemState` relation.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\StateMachineItemTransfer $stateMachineItemTransfer
     *
     * @return bool
     */
    public function saveStateMachineItemToMerchant(StateMachineItemTransfer $stateMachineItemTransfer): bool;

    /**
     * Specification:
     * - Expands Merchant Transfer with State Machine data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantTransfer
     */
    public function expandMerchantWithStateMachineData(MerchantTransfer $merchantTransfer): MerchantTransfer;

    /**
     * Specification:
     * - Updates merchant with merchant onboarding state machine and triggers for new state machine item.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantResponseTransfer
     */
    public function updateMerchantWithOnboardingStateMachine(MerchantTransfer $merchantTransfer): MerchantResponseTransfer;
}
