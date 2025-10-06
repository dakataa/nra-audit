<?php

namespace Dakataa\NraAudit\Model\Interface;

use DateTimeInterface;

interface NraDocumentInterface
{
	public function getNraNumber(): int;

	public function getNraDate(): DateTimeInterface;
}
