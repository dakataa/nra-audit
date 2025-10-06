<?php

namespace App\Component\Nra\Audit\Model;

use App\Component\Nra\Audit\Enum\PaymentMethodEnum;
use App\Component\Nra\Audit\Enum\ReturnPaymentMethodEnum;
use App\Component\Nra\Audit\Model\Interface\NraDocumentInterface;
use DateTimeInterface;

readonly class NraDocument implements NraDocumentInterface
{
	public function __construct(
		private int $number,
		private DateTimeInterface $date
	) {
	}

	public function getNraNumber(): int
	{
		return $this->number;
	}

	public function getNraDate(): DateTimeInterface
	{
		return $this->date;
	}
}
