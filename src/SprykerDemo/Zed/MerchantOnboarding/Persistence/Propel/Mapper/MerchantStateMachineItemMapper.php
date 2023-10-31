<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\StateMachineItemTransfer;
use Orm\Zed\Merchant\Persistence\SpyMerchant;

class MerchantStateMachineItemMapper
{
    /**
     * @param \Orm\Zed\Merchant\Persistence\SpyMerchant $merchantEntity
     * @param \Generated\Shared\Transfer\StateMachineItemTransfer $stateMachineItemTransfer
     *
     * @return \Generated\Shared\Transfer\StateMachineItemTransfer
     */
    public function mapMerchantEntityToStateMachineItemTransfer(
        SpyMerchant $merchantEntity,
        StateMachineItemTransfer $stateMachineItemTransfer
    ): StateMachineItemTransfer {
        $stateMachineItemTransfer->setIdItemState($merchantEntity->getFkStateMachineItemState())
            ->setIdMerchant($merchantEntity->getIdMerchant());

        return $stateMachineItemTransfer;
    }
}
