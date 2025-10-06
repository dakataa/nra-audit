<?php

namespace App\Component\Nra\Audit\Repository;

use App\Component\Nra\Audit\Model\Interface\NraShopInterface;
use Generator;

interface NraShopRepositoryInterface
{

	/**
	 * @param array & int[] & string[] & NraShopInterface[] |null $ids
	 * @return NraShopInterface[] | null
	 */
	public function getNraShops(array $ids = null): Generator|null;

	public function getNraShopById(int|string $id): ?NraShopInterface;
}
