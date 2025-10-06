<?php

namespace App\Component\Nra\Audit\Repository;

use App\Component\Nra\Audit\Model\Interface\NraAuditFileInterface;

interface NraAuditRepositoryInterface
{
	public function getNraAuditFiles(int $year = null, int $month = null): array;

	public function addNraAuditFile(NraAuditFileInterface $file): void;

	public function removeNraAuditFile(NraAuditFileInterface $file): void;

}
