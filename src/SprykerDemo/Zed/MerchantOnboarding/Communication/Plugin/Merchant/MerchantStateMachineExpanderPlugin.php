<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Communication\Plugin\Merchant;

use Generated\Shared\Transfer\MerchantTransfer;
use Generated\Shared\Transfer\StateMachineItemTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\MerchantExtension\Dependency\Plugin\MerchantExpanderPluginInterface;

/**
 * @method \SprykerDemo\Zed\MerchantOnboarding\Communication\MerchantOnboardingCommunicationFactory getFactory()
 */
class MerchantStateMachineExpanderPlugin extends AbstractPlugin implements MerchantExpanderPluginInterface
{
    /**
     * {@inheritDoc}
     * - Expands merchant by state machine data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantTransfer
     */
    public function expand(MerchantTransfer $merchantTransfer): MerchantTransfer
    {
        if ($merchantTransfer->getFkStateMachineItemState()) {
            $stateMachineItemTransfer = $this->getFactory()
                ->getStateMachineFacade()->getProcessedStateMachineItemTransfer(
                    (new StateMachineItemTransfer())->setIdentifier($merchantTransfer->getIdMerchant())
                        ->setIdItemState($merchantTransfer->getFkStateMachineItemState()),
                );

            if ($stateMachineItemTransfer !== null) {
                $merchantTransfer->setStateMachineItem($stateMachineItemTransfer);
            }
        }

        return $merchantTransfer;
    }
}
