<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\Merchant\Business\MerchantFacadeInterface;
use Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface;
use Spryker\Zed\StateMachine\Persistence\StateMachineQueryContainerInterface;
use SprykerDemo\Zed\MerchantOnboarding\Business\StateMachine\Finder;
use SprykerDemo\Zed\MerchantOnboarding\Business\StateMachine\FinderInterface;
use SprykerDemo\Zed\MerchantOnboarding\MerchantOnboardingDependencyProvider;

class MerchantOnboardingCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface
     */
    public function getStateMachineFacade(): StateMachineFacadeInterface
    {
        return $this->getProvidedDependency(MerchantOnboardingDependencyProvider::FACADE_STATE_MACHINE);
    }

    /**
     * @return \Spryker\Zed\StateMachine\Persistence\StateMachineQueryContainerInterface
     */
    public function getStateMachineQueryContainer(): StateMachineQueryContainerInterface
    {
        return $this->getProvidedDependency(MerchantOnboardingDependencyProvider::QUERY_CONTAINER_STATE_MACHINE);
    }

    /**
     * @return \Spryker\Zed\Merchant\Business\MerchantFacadeInterface
     */
    public function getMerchantFacade(): MerchantFacadeInterface
    {
        return $this->getProvidedDependency(MerchantOnboardingDependencyProvider::FACADE_MERCHANT);
    }

    /**
     * @return \SprykerDemo\Zed\MerchantOnboarding\Business\StateMachine\FinderInterface
     */
    public function createStateMachineFinder(): FinderInterface
    {
        return new Finder(
            $this->getStateMachineQueryContainer(),
        );
    }
}
