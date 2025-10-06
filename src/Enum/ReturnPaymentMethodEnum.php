<?php

namespace Dakataa\NraAudit\Enum;

enum ReturnPaymentMethodEnum: int
{
	case BankTransfer = 1;

	case Card = 2;

	case Cash = 3;

	case Other = 4;
}
