<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Merchant\Business\MerchantFacadeInterface;
use Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface;
use SprykerDemo\Zed\MerchantOnboarding\Business\Merchant\MerchantUpdater;
use SprykerDemo\Zed\MerchantOnboarding\Business\Merchant\MerchantUpdaterInterface;
use SprykerDemo\Zed\MerchantOnboarding\MerchantOnboardingDependencyProvider;

class MerchantOnboardingBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface
     */
    public function getStateMachineFacade(): StateMachineFacadeInterface
    {
        return $this->getProvidedDependency(MerchantOnboardingDependencyProvider::FACADE_STATE_MACHINE);
    }

    /**
     * @return \Spryker\Zed\Merchant\Business\MerchantFacadeInterface
     */
    public function getMerchantFacade(): MerchantFacadeInterface
    {
        return $this->getProvidedDependency(MerchantOnboardingDependencyProvider::FACADE_MERCHANT);
    }

    /**
     * @return \SprykerDemo\Zed\MerchantOnboarding\Business\Merchant\MerchantUpdaterInterface
     */
    public function createMerchantUpdater(): MerchantUpdaterInterface
    {
        return new MerchantUpdater(
            $this->getStateMachineFacade(),
            $this->getMerchantFacade(),
        );
    }
}
