<?php

namespace Dakataa\NraAudit\Model\Interface;

use Dakataa\NraAudit\Enum\ShopTypeEnum;

interface NraShopInterface
{
	public function getNraShopName(): string;

	public function getNraShopEik(): string;

	public function getNraShopMOL(): string;

	public function getNraShopNumber(): string;

	public function getNraShopDomain(): string;

	public function getNraShopType(): ShopTypeEnum;

	public function getNraShopEmail(): string;

	public function getNraShopPhone(): ?string;

	public function getNraShopAddress(): string;

}
