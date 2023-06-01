<?php

declare(strict_types=1);

use function Pest\Laravel\withExceptionHandling;


it('can test', function (): void {
    withExceptionHandling();
    expect(true)->toBeTrue();
});
