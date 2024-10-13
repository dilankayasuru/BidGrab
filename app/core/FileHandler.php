<?php

class FileHandler
{
    private $dirname; // Directory name where files will be stored
    private $targetFile; // Target file path
    private $error; // Error message
    private $imageFileType; // Image file type (extension)
    private $inputName; // Input name from the form
    public $tempFile; // Temporary file information

    // Constructor to initialize the input name and temporary file
    public function __construct($inputName)
    {
        $this->inputName = $inputName;
        $this->tempFile = $_FILES[$this->inputName];
        $this->dirname = "../app/server/";
    }

    // Validate the uploaded file
    private function validateFile(): bool
    {
        // Check if the file is an actual image
        if (!getimagesize($this->tempFile["tmp_name"])) {
            $this->error = "Error on getimagesize";
            return false;
        }
        // Check if the file already exists
        if (file_exists($this->targetFile)) {
            $this->error = "Error on file_exists";
            return false;
        }

        // Check the file size
        if ($this->tempFile["size"] > 5000000) {
            return false;
        }

        // Get the file extension and validate it
        $this->imageFileType = strtolower(pathinfo($this->targetFile, PATHINFO_EXTENSION));
        if ($this->imageFileType != "jpg" && $this->imageFileType != "png" && $this->imageFileType != "jpeg" && $this->imageFileType != "webp") {
            $this->error = "Error on file type";
            return false;
        }

        return true;
    }

    // Get the profile picture URL
    public static function getProfilePic($sellerPic = "", $sellerName = ""): string
    {
        $dirName = "../app/server/profileImages";

        // If no seller picture or name is provided, use the session user data
        if (empty($sellerPic) && empty($sellerName)) {
            $userName = $_SESSION["user"]["first_name"] . "+" . $_SESSION["user"]["last_name"];
            $userPic = $_SESSION["user"]["profile_pic"];
            return glob("$dirName/$userPic") ?
                "/bidgrab/app/server/profileImages/$userPic" : "https://avatar.iran.liara.run/username?username=$userName";
        }

        // Return the seller's profile picture or a default avatar
        return glob("$dirName/$sellerPic") ?
            "/bidgrab/app/server/profileImages/$sellerPic" : "https://avatar.iran.liara.run/username?username=$sellerName";
    }

    // Get the category image URL
    public static function getCategoryImage($image)
    {
        $dirName = "../app/server/categoryImages";
        // Return the category image if it exists, otherwise return a placeholder
        if (!empty($image) && glob("$dirName/$image")) {
            return "/bidgrab/app/server/categoryImages/$image";
        }
        return "/bidgrab/public/images/placeholder.png";
    }

    // Upload a file to the server
    public function uploadFile($name, $subDir)
    {
        $this->targetFile = $this->dirname . $subDir . '/' . basename($this->tempFile["name"]);

        // Validate the file before uploading
        if (!$this->validateFile()) {
            return false;
        }

        // Remove existing files with the same name
        $files = glob($this->dirname . $subDir . '/' . "$name.*");
        if ($files) {
            foreach ($files as $file) {
                unlink($file);
            }
        }

        // Move the uploaded file and rename it
        $resultMove = move_uploaded_file($this->tempFile["tmp_name"], $this->targetFile);
        $resultRename = rename($this->targetFile, $this->dirname . "$subDir/" . $name . "." . $this->imageFileType);

        // Return the new file name or false if the upload failed
        return ($resultRename && $resultMove) ? "$name.$this->imageFileType" : false;
    }

    // Remove an image from the server folder
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

    // Remove auction images keeping remaining images
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