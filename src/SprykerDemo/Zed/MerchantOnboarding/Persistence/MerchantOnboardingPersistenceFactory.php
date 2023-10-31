<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Persistence;

use Orm\Zed\Merchant\Persistence\SpyMerchantQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use SprykerDemo\Zed\MerchantOnboarding\MerchantOnboardingDependencyProvider;
use SprykerDemo\Zed\MerchantOnboarding\Persistence\Propel\Mapper\MerchantStateMachineItemMapper;

class MerchantOnboardingPersistenceFactory extends AbstractPersistenceFactory
{
 /**
  * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery
  */
    public function getPropelMerchantQuery(): SpyMerchantQuery
    {
        return $this->getProvidedDependency(MerchantOnboardingDependencyProvider::PROPEL_QUERY_MERCHANT);
    }

    /**
     * @return \SprykerDemo\Zed\MerchantOnboarding\Persistence\Propel\Mapper\MerchantStateMachineItemMapper
     */
    public function createMerchantStateMachineItemMapper(): MerchantStateMachineItemMapper
    {
        return new MerchantStateMachineItemMapper();
    }
}
