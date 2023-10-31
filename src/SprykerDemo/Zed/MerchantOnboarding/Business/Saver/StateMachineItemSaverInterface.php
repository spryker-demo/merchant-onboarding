<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Business\Saver;

use Generated\Shared\Transfer\StateMachineItemTransfer;

interface StateMachineItemSaverInterface
{
    /**
     * @param \Generated\Shared\Transfer\StateMachineItemTransfer $stateMachineItemTransfer
     *
     * @return bool
     */
    public function saveStateMachineItemToMerchant(StateMachineItemTransfer $stateMachineItemTransfer): bool;
}
