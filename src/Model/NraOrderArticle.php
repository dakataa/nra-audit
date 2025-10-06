<?php

namespace App\Component\Nra\Audit\Model;

use App\Component\Nra\Audit\Model\Interface\NraOrderArticleInterface;

readonly class NraOrderArticle implements NraOrderArticleInterface
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
		return $this->amount;
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
		return bcmul($this->amount, bcdiv($this->vatRate, 100, 2), 2);
	}

	public function getNraTotalAmount(): string
	{
		return bcadd($this->amount, $this->getNraVatAmount(), 2);
	}
}
