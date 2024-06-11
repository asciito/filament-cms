<?php

namespace Asciito\FilamentCms\Models\Contracts;

interface ContentType
{
    public function getType(): string;

    public function isDraft(): bool;

    public function isPublished(): bool;

    public function isArchived(): bool;

    public function publish(): bool;
}
