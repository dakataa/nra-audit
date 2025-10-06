<?php

namespace App\Component\Nra\Audit\Model\Interface;

interface NraOrderArticleInterface
{
	public function getNraName(): string;

	public function getNraQuantity(): int;

	public function getNraVatRate(): int;

	public function getNraAmount(): string;

	public function getNraVatAmount(): string;

	public function getNraTotalAmount(): string;

}
