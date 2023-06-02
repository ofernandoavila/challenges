<?php

namespace ofernandoavila\Community\Model;

class File {
    public string $name;
    public string $fullPath;
    public string $type;
    public string $tmp_name;
    public int $size;
    public string $error;
    public function __construct($file) {
        $this->name = $file['name'];
        $this->fullPath = $file['full_path'];
        $this->type = $file['type'];
        $this->tmp_name = $file['tmp_name'];
        $this->size = $file['size'];
        $this->error = $file['error'];
    }

    public function GetFile() {
        return $this->tmp_name;
    }

    public function GetFileType() {
        $type = explode('/', $this->type);

        return $type[1];
    }
}