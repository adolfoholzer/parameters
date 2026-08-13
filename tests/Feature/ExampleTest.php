<?php

declare(strict_types=1);

use Zitro\Parameters\Parameters;

it('resolves the singleton', function () {
    expect(app(Parameters::class))->toBeInstanceOf(Parameters::class);
});

it('returns the same instance from the container', function () {
    expect(app(Parameters::class))->toBe(app(Parameters::class));
});

it('merges the package config', function () {
    expect(config('parameters.placeholder'))->toBe('default');
});
