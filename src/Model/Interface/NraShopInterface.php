<?php

namespace Dakataa\NraAudit\Model\Interface;

use Dakataa\NraAudit\Enum\ShopTypeEnum;

interface NraShopInterface
{

	public function getNraShopEik(): string;

	public function getNraShopNumber(): string;

	public function getNraShopDomain(): string;

	public function getNraShopType(): ShopTypeEnum;

}
