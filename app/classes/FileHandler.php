<?php


namespace App\Classes;


trait FileHandler
{
    protected $filePath;

    public function readjsonFile()
    {
        if (file_exists($this->filePath)) {
            return json_decode(file_get_contents($this->filePath), true);
        }
    }

    public function writejsonFile($data)
    {
        return file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
    }
}