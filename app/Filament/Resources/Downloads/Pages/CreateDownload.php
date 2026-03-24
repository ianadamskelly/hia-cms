<?php

namespace App\Filament\Resources\Downloads\Pages;

use App\Filament\Resources\Downloads\DownloadResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;

class CreateDownload extends CreateRecord
{
    protected static string $resource = DownloadResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        /** @var FilesystemAdapter $disk */
        $disk = Storage::disk('public');

        if (! empty($data['file_path']) && $disk->exists($data['file_path'])) {
            $data['original_name'] = basename($data['file_path']);
            $data['file_type'] = $disk->mimeType($data['file_path']);
            $data['file_size'] = $disk->size($data['file_path']);
        }

        return $data;
    }
}
