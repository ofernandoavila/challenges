<?php

namespace ofernandoavila\Community\Core;
use ofernandoavila\Community\Model\File;

abstract class FileManager {
    public static function CreateDirectory(string $directory) {
        global $configs;

        if (!is_dir($configs['storage_dir'] . '/' . $directory)) {
            return mkdir($configs['storage_dir'] . '/' . $directory, 0777, true);
        } else {
            throw new \Exception('Directory already exists: ' . $directory);
        }
    }

    public static function CheckIfFileExists(string $filePath) {
        global $configs;

        return file_exists($configs['storage_dir'] . $filePath);
    }

    public static function UpdateFile(File $file, string $path) {
        return rename($file->GetFile(), $path);
    }
}