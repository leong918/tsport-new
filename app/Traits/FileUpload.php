<?php

namespace App\Traits;

use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait FileUpload
{
    public $uploaded_filename = '';
    public $uploaded_thumb_filename = '';
    public $upload_path = 'default';

    private $allowed_image = [
        'image/bmp',
        'image/gif',
        'image/jpeg',
        'image/png',
        'image/webp',
    ];

    private $allowed_file = [
        'application/pdf',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation', // pptx
        'application/vnd.ms-powerpoint', // ppt
        'application/pdf',
        'image/svg+xml', // svg, put here is because no need resize
        'application/msword', // doc
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // docx
        'application/epub+zip', // epub
        'application/vnd.ms-excel', // xls
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // xlsx
        'text/csv',
        'video/x-msvideo',
        'video/mpeg',
        'video/ogg',
        'video/webm',
        'video/mp4',
    ];

    public function uploadFile($file)
    {
        $this->processUpload($file);
    }

    /**
     * Use for non generated thumbnail generated, because this doesn't remove thumbnail
     *
     * @param File $file
     * @param string $old_file_url
     *
     * @return void
     */
    public function overwriteFile($file, $old_file_url)
    {
        $this->deleteFile($old_file_url);
        $this->processUpload($file);
    }

    public function processUpload($file): string
    {
        $filename = $file->hashName();
        $dir = $this->getUploadPath();
        $path = Storage::putFileAs($dir . '/', $file, $filename);

        if ($this->isValidImage($file) === false && $this->isValidFile($file) === false) {
            throw new GeneralException('File type is not valid');
        }

        if ((bool) $path) {
            $generated_file = $dir . '/' . basename($path);
            $this->uploaded_filename = env('FILESYSTEM_DRIVER') != 's3' ? $generated_file : $this->formatUploadedPath($generated_file);

            if ($this->isValidImage($file)) {
                $this->generateThumbnail($file, $path);
            }
        }

        return $this->uploaded_filename;
    }

    public function makeDirectory($dir)
    {
        if (!File::isDirectory($dir)) { // check if dir not exist, create one
            File::makeDirectory($dir, 0777, true, true);
        }
    }

    public function generateThumbnail($file, $path)
    {
        $img = Image::make($file);
        $img->orientate();
        $img->resize(100, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $resized_image = $img->stream()->detach();
        $dir = $this->getUploadPath() . '/thumb';
        $this->makeDirectory($dir);
        // upload thumbnail
        Storage::put($dir . '/' . basename($path), $resized_image);

        $generated_file = $dir . '/' . basename($path);

        $this->uploaded_thumb_filename = $this->formatUploadedPath($generated_file);
    }

    public function deleteFile($file_url)
    {
        // extract dir and file name only
        $filename = substr($file_url, strpos($file_url, $this->upload_path));
        if (env('FILESYSTEM_DRIVER') === 'local') {
            $filename = 'public/' . $filename;
        }
        Storage::delete($filename);
    }

    public function getUploadPath(): string
    {
        $dir = 'public/' . $this->upload_path;
        if (env('FILESYSTEM_DRIVER') !== 'local') {
            $dir = $this->upload_path;
        }

        return $dir;
    }

    public function formatUploadedPath($file_url): string
    {
        $upload_path = asset(Storage::url($file_url));
        if (env('FILESYSTEM_DRIVER') !== 'local') {
            $upload_path = Storage::url($file_url);
        }

        return $upload_path;
    }

    public function isValidImage($file): bool
    {
        $mimeType = $file->getClientMimeType();

        return in_array($mimeType, $this->allowed_image);
    }

    public function isValidFile($file): bool
    {
        $mimeType = $file->getClientMimeType();

        return in_array($mimeType, $this->allowed_file);
    }
}
