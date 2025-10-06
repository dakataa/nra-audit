<?php

namespace Dakataa\NraAudit\Repository;

use Dakataa\NraAudit\Model\Interface\NraAuditFileInterface;

interface NraAuditRepositoryInterface
{
	public function getNraAuditFiles(int $year = null, int $month = null): array;

	public function addNraAuditFile(NraAuditFileInterface $file): void;

	public function removeNraAuditFile(NraAuditFileInterface $file): void;

}
