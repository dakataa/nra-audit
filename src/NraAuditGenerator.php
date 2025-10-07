<?php

namespace Dakataa\NraAudit;

use Dakataa\NraAudit\Model\Interface\NraOrderArticleInterface;
use Dakataa\NraAudit\Model\NraOrder;
use Dakataa\NraAudit\Model\NraShop;
use Dakataa\NraAudit\Repository\NraOrderRepositoryInterface;
use DateTimeImmutable;
use DOMDocument;
use DOMElement;
use DOMException;
use Exception;

class NraAuditGenerator
{

	public function __construct(
		protected NraOrderRepositoryInterface $orderRepository,
	) {
	}

	/**
	 * @param NraShop $shop
	 * @param int $year
	 * @param int $month
	 * @return DOMDocument
	 * @throws DOMException
	 */
	public function generate(NraShop $shop, int $year, int $month): DOMDocument
	{
		$currentDate = new DateTimeImmutable;
		$selectedDate = (new DateTimeImmutable)->setDate($year, $month, 1);

		$orders = [];
		$returnedOrders = [];
		/** @var NraOrder $order */
		foreach ($this->orderRepository->getOrdersByShop($shop, $year, $month) as $order) {
			$orders[] = [
				'ord_n' => $order->getNraNumber(),
				'ord_d' => $order->getNraDate()->format('Y-m-d'),
				'doc_n' => sprintf('%010d', $order->getNraDocument()?->getNraNumber()),
				'doc_date' => ($order->getNraDocument()?->getNraDate() ?: $order->getNraDate())->format('Y-m-d'),
				'art' => [
					'artenum' => array_map(fn(NraOrderArticleInterface $article) => [
						'art_name' => $article->getNraName(),
						'art_quant' => $article->getNraQuantity(),
						'art_price' => $article->getNraAmount(),
						'art_vat_rate' => $article->getNraVatRate(),
						'art_vat' => $article->getNraVatAmount(),
						'art_sum' => $article->getNraTotalAmount(),
					], $order->getNraArticles()),
				],
				'ord_total1' => $order->getNraAmount(),
				'ord_disc' => $order->getNraDiscountAmount(),
				'ord_vat' => $order->getNraVatAmount(),
				'ord_total2' => $order->getNraTotalAmount(),
				'paym' => $order->getNraPaymentMethod()->value,
				'pos_n' => $order->getNraVirtualPOSNumber(),
				'trans_n' => $order->getNraTransactionNumber(),
				'proc_id' => $order->getNraProcessorId(),
			];

			if ($order->getNraReturnDate()) {
				$returnedOrders[] = [
					'r_ord_n' => $order->getNraNumber(),
					'r_amount' => $order->getNraAmount(),
					'r_date' => $order->getNraReturnDate()?->format('Y-m-d'),
					'r_paym' => $order->getNraReturnPayment()?->value,
				];
			}
		}

		if (empty($orders)) {
			throw new Exception('No orders found for selected period');
		}

		$data = [
			'eik' => $shop->getNraShopEik(),
			'e_shop_n' => $shop->getNraShopNumber(),
			'domain_name' => $shop->getNraShopDomain(),
			'e_shop_type' => $shop->getNraShopType()->value,
			'creation_date' => $currentDate->format('Y-m-d'),
			'mon' => $selectedDate->format('m'),
			'god' => $selectedDate->format('Y'),
			'order' => [
				'orderenum' => $orders ?: null,
			],
			'r_ord' => count($returnedOrders),
			...($returnedOrders ? [
				'rorder' => [
					'rorderenum' => $returnedOrders ?: null,
				],
			] : []),
		];

		$document = new DOMDocument("1.0", "windows-1251");
		$rootElement = $document->createElement('audit');
		$document->appendChild($rootElement);

		$generate = function (array $data, DOMElement $parentElement) use ($document, &$generate) {
			foreach ($data as $key => $value) {
				$isSimpleArray = is_array($value) && empty(array_filter($value, 'is_string', ARRAY_FILTER_USE_KEY));
				if (!$isSimpleArray) {
					$value = [$value];
				}

				foreach ($value as $elementValue) {
					$element = $document->createElement($key);
					if (is_array($elementValue)) {
						$generate($elementValue, $element);
					} else {
						$element->append((string)$elementValue);
					}
				}

				$parentElement->appendChild($element);
			}
		};

		$generate($data, $rootElement);

		if (false === $document->schemaValidate(__DIR__.DIRECTORY_SEPARATOR.'Resource/dec_audit.xsd')) {
			throw new Exception('Invalid Audit XML');
		}

		return $document;
	}
}
