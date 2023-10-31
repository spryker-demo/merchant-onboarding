<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\Merchant\Business\MerchantFacadeInterface;
use SprykerDemo\Zed\MerchantOnboarding\MerchantOnboardingDependencyProvider;

class MerchantOnboardingCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Spryker\Zed\Merchant\Business\MerchantFacadeInterface
     */
    public function getMerchantFacade(): MerchantFacadeInterface
    {
        return $this->getProvidedDependency(MerchantOnboardingDependencyProvider::FACADE_MERCHANT);
    }

    /**
     * @return array<\Spryker\Zed\StateMachine\Dependency\Plugin\ConditionPluginInterface>
     */
    public function getStateMachineConditionPlugins(): array
    {
        return $this->getProvidedDependency(MerchantOnboardingDependencyProvider::PLUGINS_STATE_MACHINE_CONDITION);
    }

    /**
     * @return array<\Spryker\Zed\StateMachine\Dependency\Plugin\CommandPluginInterface>
     */
    public function getStateMachineCommandPlugins(): array
    {
        return $this->getProvidedDependency(MerchantOnboardingDependencyProvider::PLUGINS_STATE_MACHINE_COMMAND);
    }
}
