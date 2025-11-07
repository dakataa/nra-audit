<?php

namespace Dakataa\NraAudit\Model;

use Dakataa\NraAudit\Model\Interface\NraOrderArticleInterface;

class NraOrderArticle implements NraOrderArticleInterface
{
	public function __construct(
		private string $name,
		private string $amount,
		private int $quantity = 1,
		private int $vatRate = 20
	) {
	}

	public function getNraName(): string
	{
		return $this->name;
	}

	public function getNraAmount(): string
	{
		return bcsub($this->amount, $this->getNraVatAmount(), 2);
	}

	public function getNraQuantity(): int
	{
		return $this->quantity;
	}

	public function getNraVatRate(): int
	{
		return $this->vatRate;
	}

	public function getNraVatAmount(): string
	{
		return bcsub($this->amount, bcdiv($this->amount, bcadd(1, bcdiv($this->vatRate, 100, 2), 2), 3), 2);
	}

	public function getNraTotalAmount(): string
	{
		return $this->amount * $this->quantity;
	}
}
