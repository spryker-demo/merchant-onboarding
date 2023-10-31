<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Persistence;

use Generated\Shared\Transfer\StateMachineItemTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerDemo\Zed\MerchantOnboarding\Persistence\MerchantOnboardingPersistenceFactory getFactory()
 */
class MerchantOnboardingRepository extends AbstractRepository implements MerchantOnboardingRepositoryInterface
{
    /**
     * @param array<int> $stateIds
     *
     * @return array<\Generated\Shared\Transfer\StateMachineItemTransfer>
     */
    public function getStateMachineItemsByStateIds(array $stateIds): array
    {
        $merchantStateMachineItemMapper = $this->getFactory()
            ->createMerchantStateMachineItemMapper();
        $merchantEntities = $this->getFactory()
            ->getPropelMerchantQuery()
            ->filterByFkStateMachineItemState_In($stateIds)
            ->find();

        $stateMachineItemTransfers = [];

        foreach ($merchantEntities as $merchantEntity) {
            $stateMachineItemTransfers[] = $merchantStateMachineItemMapper->mapMerchantEntityToStateMachineItemTransfer(
                $merchantEntity,
                new StateMachineItemTransfer(),
            );
        }

        return $stateMachineItemTransfers;
    }
}
