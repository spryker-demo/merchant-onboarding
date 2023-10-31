<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Business\Expander;

use Generated\Shared\Transfer\MerchantTransfer;
use Generated\Shared\Transfer\StateMachineItemTransfer;
use Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface;

class MerchantStateMachineDataExpander implements MerchantStateMachineDataExpanderInterface
{
    /**
     * @var \Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface
     */
    protected StateMachineFacadeInterface $stateMachineFacade;

    /**
     * @param \Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface $stateMachineFacade
     */
    public function __construct(StateMachineFacadeInterface $stateMachineFacade)
    {
        $this->stateMachineFacade = $stateMachineFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantTransfer
     */
    public function expand(MerchantTransfer $merchantTransfer): MerchantTransfer
    {
        if (!$merchantTransfer->getFkStateMachineItemState()) {
            return $merchantTransfer;
        }

        $stateMachineItemTransfer = $this->stateMachineFacade->getProcessedStateMachineItemTransfer(
            (new StateMachineItemTransfer())->setIdentifier($merchantTransfer->getIdMerchant())
                ->setIdItemState($merchantTransfer->getFkStateMachineItemState()),
        );

        if ($stateMachineItemTransfer !== null) {
            $merchantTransfer->setStateMachineItem($stateMachineItemTransfer);
        }

        return $merchantTransfer;
    }
}
