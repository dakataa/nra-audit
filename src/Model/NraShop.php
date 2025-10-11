<?php

namespace Dakataa\NraAudit\Model;

use Dakataa\NraAudit\Enum\ShopTypeEnum;
use Dakataa\NraAudit\Model\Interface\NraShopInterface;

class NraShop implements NraShopInterface
{
	public function __construct(
		protected ShopTypeEnum $type,
		protected string $number,
		protected string $name,
		protected string $address,
		protected string $eik,
		protected string $mol,
		protected string $domain,
		protected string $email,
		protected ?string $phone = null,

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


	public function getNraShopName(): string
	{
		return $this->name;
	}

	public function getNraShopEmail(): string
	{
		return $this->email;
	}

	public function getNraShopPhone(): ?string
	{
		return $this->phone;
	}

	public function getNraShopAddress(): string
	{
		return $this->address;
	}

	public function getNraShopMOL(): string
	{
		return $this->mol;
	}
}
