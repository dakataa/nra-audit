<?php

namespace Dakataa\NraAudit\Model;

use Dakataa\NraAudit\Enum\PaymentMethodEnum;
use Dakataa\NraAudit\Enum\ReturnPaymentMethodEnum;
use Dakataa\NraAudit\Model\Interface\NraDocumentInterface;
use Dakataa\NraAudit\Model\Interface\NraOrderInterface;
use DateTimeInterface;

class NraOrder implements NraOrderInterface
{
	public function __construct(
		private string $number,
		private DateTimeInterface $date,
		private NraDocumentInterface|null $document,
		private PaymentMethodEnum $paymentMethod,
		private string $amount,
		private string $vatAmount,
		private string $discountAmount,
		private string $totalAmount,
		private array $articles,
		private DateTimeInterface|null $returnDate = null,
		private ReturnPaymentMethodEnum|null $returnPayment = null,
		private string|null $virtualPOSNumber = null,
		private string|null $transactionNumber = null,
		private string|null $processorId = null
	) {
	}

	public function getNraNumber(): string
	{
		return $this->number;
	}

	public function getNraDate(): DateTimeInterface
	{
		return $this->date;
	}

	public function getNraDocument(): NraDocumentInterface|null
	{
		return $this->document;
	}

	public function getNraPaymentMethod(): PaymentMethodEnum
	{
		return $this->paymentMethod;
	}

	public function getNraVirtualPOSNumber(): string|null
	{
		return $this->virtualPOSNumber;
	}

	public function getNraTransactionNumber(): string|null
	{
		return $this->transactionNumber;
	}

	public function getNraProcessorId(): string|null
	{
		return $this->processorId;
	}

	public function getNraAmount(): string
	{
		return $this->amount;
	}

	public function getNraVatAmount(): string
	{
		return $this->vatAmount;
	}

	public function getNraDiscountAmount(): string
	{
		return $this->discountAmount;
	}

	public function getNraTotalAmount(): string
	{
		return $this->totalAmount;
	}

	public function getNraReturnDate(): DateTimeInterface|null
	{
		return $this->returnDate;
	}

	public function getNraReturnPayment(): ReturnPaymentMethodEnum|null
	{
		return $this->returnPayment;
	}

	public function getNraArticles(): array
	{
		return $this->articles;
	}
}
