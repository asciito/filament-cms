<?php

namespace Asciito\FilamentCms\Models\Concerns;

use Asciito\FilamentCms\Models\Contracts\ContentType;
use Asciito\FilamentCms\Models\Enumerables\Status;
use Asciito\FilamentCms\Models\Exceptions\DoesNotImplementContentTypeClassException;
use Illuminate\Support\Str;

trait WithContentType
{
    public static function bootWithContentType(): void
    {
        static::creating(function ($model) {
            if (! ($model instanceof ContentType)) {
                $class = get_class($model);

                throw new DoesNotImplementContentTypeClassException("The $class::class doesn't implement `ContentType`");
            }

            $model->status = Status::DRAFT;

            $model->type = static::getContentType();
        });
    }

    protected static function getContentType(): string
    {
        return Str::of(static::class)->classBasename()->kebab();
    }

    public function getType(): string
    {
        return $this->type;
    }

    protected function hasStatus(Status $status): bool
    {
        return $this->status === $status;
    }

    public function isDraft(): bool
    {
        return $this->hasStatus(Status::DRAFT);
    }

    public function isPublished(): bool
    {
        return $this->hasStatus(Status::PUBLISHED);
    }

    public function isArchived(): bool
    {
        return $this->hasStatus(Status::ARCHIVED);
    }

    public function publish(): bool
    {
        if ($this->isPublished()) {
            return true;
        }

        return $this->update(['status' => Status::PUBLISHED]);
    }
}
