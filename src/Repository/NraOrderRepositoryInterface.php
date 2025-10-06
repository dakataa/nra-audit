<?php

namespace App\Component\Nra\Audit\Repository;

use App\Component\Nra\Audit\Model\Interface\NraOrderInterface;
use App\Component\Nra\Audit\Model\Interface\NraShopInterface;
use Generator;

interface NraOrderRepositoryInterface
{
	/**
	 * @param NraShopInterface $shop
	 * @param int|null $year
	 * @param int|null $month
	 * @return NraOrderInterface[]
	 */
	public function getOrdersByShop(NraShopInterface $shop, int $year = null, int $month = null): Generator;
}
