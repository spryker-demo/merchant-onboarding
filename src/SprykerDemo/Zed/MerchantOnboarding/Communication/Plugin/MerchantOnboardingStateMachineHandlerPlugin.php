<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Communication\Plugin;

use Generated\Shared\Transfer\StateMachineItemTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\StateMachine\Dependency\Plugin\StateMachineHandlerInterface;
use SprykerDemo\Zed\MerchantOnboarding\MerchantOnboardingConfig;

/**
 * @method \SprykerDemo\Zed\MerchantOnboarding\Communication\MerchantOnboardingCommunicationFactory getFactory()
 * @method \SprykerDemo\Zed\MerchantOnboarding\Business\MerchantOnboardingFacade getFacade()
 * @method \SprykerDemo\Zed\MerchantOnboarding\MerchantOnboardingConfig getConfig()
 */
class MerchantOnboardingStateMachineHandlerPlugin extends AbstractPlugin implements StateMachineHandlerInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array<\Spryker\Zed\StateMachine\Dependency\Plugin\CommandPluginInterface>
     */
    public function getCommandPlugins(): array
    {
        return $this->getFactory()->getStateMachineCommandPlugins();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array<\Spryker\Zed\StateMachine\Dependency\Plugin\ConditionPluginInterface>
     */
    public function getConditionPlugins(): array
    {
        return $this->getFactory()->getStateMachineConditionPlugins();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getStateMachineName(): string
    {
        return MerchantOnboardingConfig::MERCHANT_ONBOARDING_STATE_MACHINE_NAME;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array<string>
     */
    public function getActiveProcesses(): array
    {
        return $this->getConfig()->getDemoStateMachineProcesses();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $processName
     *
     * @return string
     */
    public function getInitialStateForProcess($processName): string
    {
        return $this->getConfig()->getDemoProcessInitialState();
    }

    /**
     * {@inheritDoc}
     * - Updates merchant item state.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\StateMachineItemTransfer $stateMachineItemTransfer
     *
     * @return bool
     */
    public function itemStateUpdated(StateMachineItemTransfer $stateMachineItemTransfer): bool
    {
        return $this->getFacade()->saveStateMachineItemToMerchant($stateMachineItemTransfer);
    }

    /**
     * {@inheritDoc}
     * - Finds merchants with provided state ids.
     * - Returns StateMachineItem transfers with identifier(id of merchant) and idItemState.
     *
     * @api
     *
     * @param array<int> $stateIds
     *
     * @return array<\Generated\Shared\Transfer\StateMachineItemTransfer>
     */
    public function getStateMachineItemsByStateIds(array $stateIds = []): array
    {
        return $this->getFacade()->getStateMachineItemsByStateIds($stateIds);
    }
}
