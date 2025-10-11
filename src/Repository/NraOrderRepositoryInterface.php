<?php

namespace Dakataa\NraAudit\Repository;

use Dakataa\NraAudit\Model\Interface\NraOrderInterface;
use Dakataa\NraAudit\Model\Interface\NraShopInterface;
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

	public function getOrderByNumber(int|string $number): ?NraOrderInterface;
}
