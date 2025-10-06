<?php

namespace App\Component\Nra\Audit\Model\Interface;

use App\Component\Nra\Audit\Enum\PaymentMethodEnum;
use App\Component\Nra\Audit\Enum\ReturnPaymentMethodEnum;
use DateTimeInterface;

interface NraOrderInterface
{
	public function getNraNumber(): string;

	public function getNraDate(): DateTimeInterface;

	public function getNraDocument(): NraDocumentInterface | null;

	public function getNraPaymentMethod(): PaymentMethodEnum;

	public function getNraVirtualPOSNumber(): string | null;

	public function getNraTransactionNumber(): string | null;

	/**
	 *
	 * For Bulgarian UIC (EIK) or VAT Number for foreign payment providers
	 *
	 * @return string|null
	 */
	public function getNraProcessorId(): string | null;


	/**
	 * Amount is returned as string because of problematic float precision. Use bcmath for money calculation and rounding.
	 *
	 * @return string
	 */
	public function getNraAmount(): string;

	public function getNraVatAmount(): string;

	public function getNraDiscountAmount(): string;

	public function getNraTotalAmount(): string;

	public function getNraReturnDate(): DateTimeInterface | null;

	public function getNraReturnPayment(): ReturnPaymentMethodEnum | null;
}
