<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Business\Saver;

use Generated\Shared\Transfer\MerchantCriteriaTransfer;
use Generated\Shared\Transfer\MerchantTransfer;
use Generated\Shared\Transfer\StateMachineItemTransfer;
use Spryker\Zed\Merchant\Business\MerchantFacadeInterface;

class StateMachineItemSaver implements StateMachineItemSaverInterface
{
    /**
     * @var \Spryker\Zed\Merchant\Business\MerchantFacadeInterface
     */
    protected MerchantFacadeInterface $merchantFacade;

    /**
     * @param \Spryker\Zed\Merchant\Business\MerchantFacadeInterface $merchantFacade
     */
    public function __construct(MerchantFacadeInterface $merchantFacade)
    {
        $this->merchantFacade = $merchantFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\StateMachineItemTransfer $stateMachineItemTransfer
     *
     * @return bool
     */
    public function saveStateMachineItemToMerchant(StateMachineItemTransfer $stateMachineItemTransfer): bool
    {
        $merchantTransfer = $this->merchantFacade->findOne(
            (new MerchantCriteriaTransfer())->setIdMerchant($stateMachineItemTransfer->getIdentifier()),
        );

        if ($merchantTransfer === null) {
            return false;
        }

        $merchantResponseTransfer = $this->merchantFacade->updateMerchant(
            $this->expandMerchantTransferWithStateMachineItemData($merchantTransfer, $stateMachineItemTransfer),
        );

        return $merchantResponseTransfer->getIsSuccess();
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
     * @param \Generated\Shared\Transfer\StateMachineItemTransfer $stateMachineItemTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantTransfer
     */
    protected function expandMerchantTransferWithStateMachineItemData(
        MerchantTransfer $merchantTransfer,
        StateMachineItemTransfer $stateMachineItemTransfer
    ): MerchantTransfer {
        $merchantTransfer->setIdMerchant($stateMachineItemTransfer->getIdentifier())
            ->setFkStateMachineItemState($stateMachineItemTransfer->getIdItemState());

        return $merchantTransfer;
    }
}
