<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Persistence;

/**
 * @method \SprykerDemo\Zed\MerchantOnboarding\Persistence\MerchantOnboardingPersistenceFactory getFactory()
 */
interface MerchantOnboardingRepositoryInterface
{
    /**
     * @param array<int> $stateIds
     *
     * @return array<\Generated\Shared\Transfer\StateMachineItemTransfer>
     */
    public function getStateMachineItemsByStateIds(array $stateIds): array;
}
