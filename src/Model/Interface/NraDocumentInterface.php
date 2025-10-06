<?php

namespace App\Component\Nra\Audit\Model\Interface;

use DateTimeInterface;

interface NraDocumentInterface
{
	public function getNraNumber(): int;

	public function getNraDate(): DateTimeInterface;
}
