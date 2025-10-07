<?php

namespace Dakataa\NraAudit;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DakataaNraAuditBundle extends Bundle
{

	public function build(ContainerBuilder $container): void
	{
		$container
			->autowire(NraAuditGenerator::class);
	}
}
