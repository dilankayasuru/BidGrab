<?php

class FileHandler
{
    private $dirname;
    private $targetFile;
    private $error;
    private $imageFileType;
    private $inputName;
    public $tempFile;

    public function __construct($inputName)
    {
        $this->inputName = $inputName;
        $this->tempFile = $_FILES[$this->inputName];
        $this->dirname = "../app/server/";
    }

    private function validateFile(): bool
    {
        if (!getimagesize($this->tempFile["tmp_name"])) {
            $this->error = "Error on getimagesize";
            return false;
        }
        if (file_exists($this->targetFile)) {
            $this->error = "Error on file_exists";
            return false;
        }

//        if ($this->tempFile["size"] > 500000) {
//            return false;
//        }

        $this->imageFileType = strtolower(pathinfo($this->targetFile, PATHINFO_EXTENSION));

        if ($this->imageFileType != "jpg" && $this->imageFileType != "png" && $this->imageFileType != "jpeg" && $this->imageFileType != "webp") {
            $this->error = "Error on file type";
            return false;
        }

        return true;
    }

    public static function getProfilePic($sellerPic = "", $sellerName = ""): string
    {
        $dirName = "../app/server/profileImages";

        if (empty($sellerPic) && empty($sellerName)) {
            $userName = $_SESSION["user"]["first_name"] . "+" . $_SESSION["user"]["last_name"];
            $userPic = $_SESSION["user"]["profile_pic"];
            return glob("$dirName/$userPic") ?
                "/bidgrab/app/server/profileImages/$userPic" : "https://avatar.iran.liara.run/username?username=$userName";
        }

        return glob("$dirName/$sellerPic") ?
            "/bidgrab/app/server/profileImages/$sellerPic" : "https://avatar.iran.liara.run/username?username=$sellerName";
    }

    public static function getCategoryImage($image)
    {
        $dirName = "../app/server/categoryImages";
        if (!empty($image) && glob("$dirName/$image")) {
            return "/bidgrab/app/server/categoryImages/$image";
        }
        return "/bidgrab/public/images/placeholder.png";
    }

    public function uploadFile($name, $subDir)
    {
        $this->targetFile = $this->dirname . $subDir . '/' . basename($this->tempFile["name"]);

        if (!$this->validateFile()) {
            return false;
        }

        $files = glob($this->dirname . $subDir . '/' . "$name.*");

        if ($files) {
            foreach ($files as $file) {
                unlink($file);
            }
        }

        $resultMove = move_uploaded_file($this->tempFile["tmp_name"], $this->targetFile);
        $resultRename = rename($this->targetFile, $this->dirname . "$subDir/" . $name . "." . $this->imageFileType);

        return ($resultRename && $resultMove) ? "$name.$this->imageFileType" : false;
    }

    public static function removeImage($name, $subDir)
    {
        if (empty($name)) {
            return;
        }
        $files = glob("../app/server/$subDir/$name");
        if ($files) {
            foreach ($files as $file) {
                unlink($file);
            }
        }
    }

    public static function removeAuctionImages($id, $keep = [])
    {
        $files = glob("../app/server/auctionImages/$id-*.*");

        if ($files) {
            foreach ($files as $file) {
                $fileParts = explode('/', $file);
                if (!in_array(end($fileParts), $keep)) {
                    unlink($file);
                }
            }
        }
    }

}