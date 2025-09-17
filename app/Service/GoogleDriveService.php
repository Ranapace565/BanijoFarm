<?php

namespace App\Services;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;

class GoogleDriveService
{
    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setAuthConfig(storage_path('app/google/credentials.json'));
        $this->client->addScope(Google_Service_Drive::DRIVE);

        $this->service = new Google_Service_Drive($this->client);
    }

    public function uploadVideo($filePath, $fileName, $folderId)
    {
        $fileMetadata = new Google_Service_Drive_DriveFile([
            'name' => $fileName,
            'parents' => [$folderId]
        ]);

        $content = file_get_contents($filePath);

        $file = $this->service->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => 'video/mp4',
            'uploadType' => 'multipart',
            'fields' => 'id, webViewLink, webContentLink'
        ]);

        return $file;
    }

    public function listVideos($folderId)
    {
        $response = $this->service->files->listFiles([
            'q' => "'{$folderId}' in parents and mimeType contains 'video/' and trashed = false",
            'fields' => 'files(id, name, webViewLink, webContentLink)'
        ]);
        return $response->files;
    }

    public function deleteVideo($fileId)
    {
        return $this->service->files->delete($fileId);
    }
}
