<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Business\Updater;

use Generated\Shared\Transfer\MerchantResponseTransfer;
use Generated\Shared\Transfer\MerchantTransfer;

interface StateMachineMerchantUpdaterInterface
{
 /**
  * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
  *
  * @return \Generated\Shared\Transfer\MerchantResponseTransfer
  */
    public function updateMerchantWithOnboardingStateMachine(MerchantTransfer $merchantTransfer): MerchantResponseTransfer;
}
