<?php

namespace App\Component\Nra\Audit\Model\Interface;

use App\Component\Nra\Audit\Enum\ShopTypeEnum;

interface NraShopInterface
{

	public function getNraShopEik(): string;

	public function getNraShopNumber(): string;

	public function getNraShopDomain(): string;

	public function getNraShopType(): ShopTypeEnum;

}
