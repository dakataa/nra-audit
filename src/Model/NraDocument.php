<?php

namespace Dakataa\NraAudit\Model;

use Dakataa\NraAudit\Enum\PaymentMethodEnum;
use Dakataa\NraAudit\Enum\ReturnPaymentMethodEnum;
use Dakataa\NraAudit\Model\Interface\NraDocumentInterface;
use DateTimeInterface;

class NraDocument implements NraDocumentInterface
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
