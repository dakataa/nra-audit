<?php

namespace App\Component\Nra\Audit\Model;

use App\Component\Nra\Audit\Enum\ShopTypeEnum;
use App\Component\Nra\Audit\Model\Interface\NraShopInterface;

readonly class NraShop implements NraShopInterface
{
	public function __construct(
		private string $eik,
		private string $number,
		private string $domain,
		private ShopTypeEnum $type
	) {
	}

	public function getNraShopEik(): string
	{
		return $this->eik;
	}

	public function getNraShopNumber(): string
	{
		return $this->number;
	}

	public function getNraShopDomain(): string
	{
		return $this->domain;
	}

	public function getNraShopType(): ShopTypeEnum
	{
		return $this->type;
	}
}
