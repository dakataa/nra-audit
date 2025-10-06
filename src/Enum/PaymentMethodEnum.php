<?php

namespace App\Component\Nra\Audit\Enum;

enum PaymentMethodEnum: int
{
	case PostalMoneyOrder = 1;

	case VPOS = 2;

	case CashOnDelivery = 3;

	case PaymentProvider = 4;

	case Other = 5;

	case FiscalReceipt = 6;
}
