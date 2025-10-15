<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{
    /**
     * Upload an image file to storage
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param int $maxSize Maximum file size in KB
     * @param array $allowedTypes
     * @return string|null
     */
    public function uploadImage(UploadedFile $file, string $directory = 'images', int $maxSize = 2048, array $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']): ?string
    {
        // Validate file type
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, $allowedTypes)) {
            throw new \InvalidArgumentException('Invalid file type. Allowed types: ' . implode(', ', $allowedTypes));
        }

        // Validate file size (convert KB to bytes)
        if ($file->getSize() > ($maxSize * 1024)) {
            throw new \InvalidArgumentException("File size exceeds maximum allowed size of {$maxSize}KB");
        }

        // Generate unique filename
        $filename = Str::uuid() . '.' . $extension;
        
        // Store file
        $path = $file->storeAs($directory, $filename, 'public');
        
        return $path;
    }

    /**
     * Delete an image file from storage
     *
     * @param string $path
     * @return bool
     */
    public function deleteImage(string $path): bool
    {
        if (empty($path)) {
            return true;
        }

        return Storage::disk('public')->delete($path);
    }

    /**
     * Update an image (delete old and upload new)
     *
     * @param UploadedFile $file
     * @param string|null $oldPath
     * @param string $directory
     * @param int $maxSize
     * @param array $allowedTypes
     * @return string|null
     */
    public function updateImage(UploadedFile $file, ?string $oldPath = null, string $directory = 'images', int $maxSize = 2048, array $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']): ?string
    {
        // Delete old image if exists
        if ($oldPath) {
            $this->deleteImage($oldPath);
        }

        // Upload new image
        return $this->uploadImage($file, $directory, $maxSize, $allowedTypes);
    }

    /**
     * Get the full URL for a stored image
     *
     * @param string|null $path
     * @return string|null
     */
    public function getImageUrl(?string $path): ?string
    {
        if (empty($path)) {
            return null;
        }

        return Storage::disk('public')->url($path);
    }

    /**
     * Upload book image
     *
     * @param UploadedFile $file
     * @return string|null
     */
    public function uploadBookImage(UploadedFile $file): ?string
    {
        return $this->uploadImage($file, 'books', 2048, ['jpg', 'jpeg', 'png', 'gif']);
    }

    /**
     * Upload profile picture
     *
     * @param UploadedFile $file
     * @return string|null
     */
    public function uploadProfilePicture(UploadedFile $file): ?string
    {
        return $this->uploadImage($file, 'profiles', 1024, ['jpg', 'jpeg', 'png', 'gif']);
    }

    /**
     * Update book image
     *
     * @param UploadedFile $file
     * @param string|null $oldPath
     * @return string|null
     */
    public function updateBookImage(UploadedFile $file, ?string $oldPath = null): ?string
    {
        return $this->updateImage($file, $oldPath, 'books', 2048, ['jpg', 'jpeg', 'png', 'gif']);
    }

    /**
     * Update profile picture
     *
     * @param UploadedFile $file
     * @param string|null $oldPath
     * @return string|null
     */
    public function updateProfilePicture(UploadedFile $file, ?string $oldPath = null): ?string
    {
        return $this->updateImage($file, $oldPath, 'profiles', 1024, ['jpg', 'jpeg', 'png', 'gif']);
    }
}
