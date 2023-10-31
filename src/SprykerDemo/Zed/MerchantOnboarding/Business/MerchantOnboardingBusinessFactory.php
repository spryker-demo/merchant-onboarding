<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Merchant\Business\MerchantFacadeInterface;
use Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface;
use SprykerDemo\Zed\MerchantOnboarding\Business\Expander\MerchantStateMachineDataExpander;
use SprykerDemo\Zed\MerchantOnboarding\Business\Expander\MerchantStateMachineDataExpanderInterface;
use SprykerDemo\Zed\MerchantOnboarding\Business\Saver\StateMachineItemSaver;
use SprykerDemo\Zed\MerchantOnboarding\Business\Saver\StateMachineItemSaverInterface;
use SprykerDemo\Zed\MerchantOnboarding\Business\Updater\StateMachineMerchantUpdater;
use SprykerDemo\Zed\MerchantOnboarding\Business\Updater\StateMachineMerchantUpdaterInterface;
use SprykerDemo\Zed\MerchantOnboarding\MerchantOnboardingDependencyProvider;

class MerchantOnboardingBusinessFactory extends AbstractBusinessFactory
{
 /**
  * @return \SprykerDemo\Zed\MerchantOnboarding\Business\Saver\StateMachineItemSaverInterface
  */
    public function createStateMachineItemSaver(): StateMachineItemSaverInterface
    {
        return new StateMachineItemSaver($this->getMerchantFacade());
    }

    /**
     * @return \SprykerDemo\Zed\MerchantOnboarding\Business\Expander\MerchantStateMachineDataExpanderInterface
     */
    public function createMerchantStateMachineDataExpander(): MerchantStateMachineDataExpanderInterface
    {
        return new MerchantStateMachineDataExpander($this->getStateMachineFacade());
    }

    /**
     * @return \SprykerDemo\Zed\MerchantOnboarding\Business\Updater\StateMachineMerchantUpdaterInterface;
     */
    public function createMerchantStateMachineUpdater(): StateMachineMerchantUpdaterInterface
    {
        return new StateMachineMerchantUpdater(
            $this->getStateMachineFacade(),
            $this->getMerchantFacade(),
        );
    }

    /**
     * @return \Spryker\Zed\Merchant\Business\MerchantFacadeInterface
     */
    public function getMerchantFacade(): MerchantFacadeInterface
    {
        return $this->getProvidedDependency(MerchantOnboardingDependencyProvider::FACADE_MERCHANT);
    }

    /**
     * @return \Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface
     */
    public function getStateMachineFacade(): StateMachineFacadeInterface
    {
        return $this->getProvidedDependency(MerchantOnboardingDependencyProvider::FACADE_STATE_MACHINE);
    }
}
