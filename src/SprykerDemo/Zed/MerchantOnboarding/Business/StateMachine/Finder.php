<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboarding\Business\StateMachine;

use Generated\Shared\Transfer\StateMachineProcessTransfer;
use Spryker\Zed\StateMachine\Persistence\StateMachineQueryContainerInterface;

class Finder implements FinderInterface
{
 /**
  * @var \Spryker\Zed\StateMachine\Persistence\StateMachineQueryContainerInterface
  */
    protected $queryContainer;

    /**
     * @param \Spryker\Zed\StateMachine\Persistence\StateMachineQueryContainerInterface $queryContainer
     */
    public function __construct(
        StateMachineQueryContainerInterface $queryContainer
    ) {
        $this->queryContainer = $queryContainer;
    }

    /**
     * @param \Generated\Shared\Transfer\StateMachineProcessTransfer $stateMachineProcessTransfer
     *
     * @return int|null
     */
    public function findStateMachineProcessId(StateMachineProcessTransfer $stateMachineProcessTransfer): ?int
    {
        $stateMachineProcessEntity = $this->queryContainer->queryProcessByStateMachineAndProcessName(
            $stateMachineProcessTransfer->getStateMachineName(),
            $stateMachineProcessTransfer->getProcessName(),
        )->findOne();

        if ($stateMachineProcessEntity) {
            return $stateMachineProcessEntity->getIdStateMachineProcess();
        }

        return null;
    }
}
