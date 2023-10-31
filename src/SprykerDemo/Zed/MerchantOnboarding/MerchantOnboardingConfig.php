<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class MerchantOnboardingConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const STATUS_APPROVED = 'approved';

    /**
     * @uses \Spryker\Zed\Merchant\MerchantConfig::STATUS_DENIED
     *
     * @var string
     */
    public const STATUS_DENIED = 'denied';

    /**
     * @var string
     */
    public const MERCHANT_ONBOARDING_STATE_MACHINE_INITIAL_STATE = 'registered';

    /**
     * @var string
     */
    public const MERCHANT_ONBOARDING_STATE_MACHINE_NAME = 'MerchantOnboarding';

    /**
     * @api
     *
     * @return string
     */
    public function getDemoProcessInitialState(): string
    {
        return static::MERCHANT_ONBOARDING_STATE_MACHINE_INITIAL_STATE;
    }

    /**
     * @var string
     */
    public const MERCHANT_ONBOARDING_STATE_PROCESS_NAME = 'MerchantOnboardingStateMachine';

    /**
     * @var int
     */
    public const MERCHANT_DETECTED_SCORE_RANGE_FROM = 700;

    /**
     * @var int
     */
    public const MERCHANT_DETECTED_SCORE_RANGE_TO = 1000;

    /**
     * @api
     *
     * @return array<string>
     */
    public function getDemoStateMachineProcesses(): array
    {
        return [
            $this->getDemoStateMachineDefaultProcessName(),
        ];
    }

    /**
     * @api
     *
     * @return string
     */
    public function getDemoStateMachineDefaultProcessName(): string
    {
        return static::MERCHANT_ONBOARDING_STATE_PROCESS_NAME;
    }
}
