# NRA Audit File Generator
If you have Online Store and you use alternative reporting mode,
this package helps you to generate an Audit File used by
Bulgarian National Revenue Agency to collect data for your monthly sales.

-- 

НАП (Национална агенция за приходите)
Алтернативен режим за регистриране и отчитане на продажбите.
Ако онлайн магазин е под алтернативен режим за регистриране и отчитане на продажбите пред НАП, 
то този пакет ще ви помогне да генерирате нужния аудиторски файл.

--

More info:
https://nra.bg/wps/portal/nra/uslugi/podavane-na-standartiziran-oditorski-fail
https://nra.bg/wps/portal/nra/fiskalni-ustroystva-supto-i-e-magazini/page.turgovia-v-internet-i-e-magazini/page.lternativen-rejim-za-registrirane-i-otchitane-na-prodajbite


#### To get started, install the bundle:

```shell
composer require dakataa/nra-audit
```
### Setup

### Create Order Repository
You have to implements `NraOrderRepositoryInterface`

Example:
```php
<?php

namespace App\Repository;

use Dakataa\NraAudit\Model\NraOrder;
use Dakataa\NraAudit\Model\NraOrderArticle;
use Dakataa\NraAudit\Repository\NraOrderRepositoryInterface;

class NraOrderRepository implements NraOrderRepositoryInterface
{
	public function getOrderByNumber(int|string $number): ?NraOrderInterface {
       
        // Your implementation
        
        return new NraOrder(
            ...
        )
	}
	
	public function getOrdersByShop(NraShopInterface $shop, int $year = null, int $month = null): Generator
	{
		// Find orders depend on arguments
		// ...
		
		foreach ($orders as $order) {
			yield new NraOrder(
				number: $order->id,
				date: $order->payedAt,
				document: $order->receiptNumber,
				paymentMethod: PaymentMethodEnum::VPOS,
				amount: $order->amountWithoutVat,
				vatAmount: $order->amountVat,
				discountAmount: $order->discountAmount
				articles: [
					new NraOrderArticle(
						name: 'Product 1',
						amount: '8.99',
						quantity: 1,
						vatRate: 20
					),
					new NraOrderArticle(
						name: 'Product 2',
						amount: '8.99',
						quantity: 1,
						vatRate: 20
					),
				],
				// VPOS Terminal Number
				virtualPOSNumber: $order->virualPOSTerminalId,
				transactionNumber: $order->virualPOSTransactionNumber,
				// Bulstat or VAT Number
				processorId: $order->processorEIKorVATNumber
			);
		}
	}
	
	
}
```

#### Generate Audit Report

Example:

```php

use App\Repository\NraOrderRepository;
use Dakataa\NraAudit\Model\NraShop;
use Dakataa\NraAudit\NraAuditGenerator;

// ....

$shop = new NraShop(
	type: ShopTypeEnum::Own,
	// NRA - Website registration number
	number: 'RF0015001',
	name: 'Фирма ЕООД',
	address: 'ул. Адрес №1',
	eik: '130107280',
	mol: 'Иван Иванов Иванов',
	domain: 'www.example.com',
	email: 'info@example.com',
	phone: '+359 888 8888 8888'
); 

$repository = new NraOrderRepository;
$generator = new NraAuditGenerator($repository)

$document = $generator->generate($shop, 2025, 10);
$document->save('nra-audit.xml');

```
