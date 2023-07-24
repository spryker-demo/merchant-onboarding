<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Business\StateMachine;

use Generated\Shared\Transfer\StateMachineProcessTransfer;

interface FinderInterface
{
    /**
     * @param \Generated\Shared\Transfer\StateMachineProcessTransfer $stateMachineProcessTransfer
     *
     * @return int|null
     */
    public function findStateMachineProcessId(StateMachineProcessTransfer $stateMachineProcessTransfer): ?int;
}
