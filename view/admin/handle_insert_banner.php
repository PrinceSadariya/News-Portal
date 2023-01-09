<?php

require $_SERVER["DOCUMENT_ROOT"] . '/controller/Banner.php';

//FOR BANNER-STATUS SWITCH
if (isset($_POST["statusSwitch"]) && $_POST["statusSwitch"] == "change") {
    $crudObject = new CRUD();

    $updated = $crudObject->updateData('banners', ["banner_status" => $_POST["status"]], ["banner_id" => $_POST["bannerId"]]);
}

//FOR INSERTION AND UPDATION
if (trim($_POST["bannerTitle"]) != '' || $_POST["bannerStatus"] != '') {
    $bannerObject = new Banner();

    if ($_POST["bannerId"] == '') {
        //FOR INSERTION

        //IMAGE HANDLING
        $imageName = $_FILES["bannerImage"]["name"];
        $tmpName = $_FILES["bannerImage"]["tmp_name"];
        $imageSize = $_FILES["bannerImage"]["size"];
        $imageExtension = strtolower(end(explode(".", $imageName)));
        $validExtension = ["jpg", "jpeg"];

        $bannerImage = date("mdyhis") . '.' . $imageExtension;

        if (in_array($imageExtension, $validExtension)) {
            if ($imageSize < 10000000) {
                $bannerObject->setBannerVariables($_POST, $bannerImage);

                $inserted = $bannerObject->insertBanner();

                if ($inserted) {

                    list($uplodWidth, $uplodHeight) = getimagesize($tmpName);

                    //NEW WIDTH AND HEIGHT
                    $sWidth = 3500;
                    $sHeight = 2000;

                    $sImage = imagecreatetruecolor($sWidth, $sHeight);

                    $sorceFile = imagecreatefromjpeg($tmpName);

                    imagecopyresized($sImage, $sorceFile, 0, 0, 0, 0, $sWidth, $sHeight, $uplodWidth, $uplodHeight);

                    imagejpeg($sImage, "../../lib/images/banner/" . $bannerImage);

                    // move_uploaded_file($tmpName, "../../lib/images/banner/" . $bannerImage);

                    echo "Banner inserted successfully";
                } else {
                    echo "Error in inserting data";
                }
            } else {
                echo "Image size must be less than 2 mb";
            }
        } else {
            echo "Only .jpg or .jpeg files allowed";
        }
    } else {
        //OLD DATA
        $oldBannerData = $bannerObject->fetchBanner('*', ["banner_id" => $_POST["bannerId"]]);

        $oldBannerImage = $oldBannerData[0]["banner_image"];

        //UPDATING DATA
        if ($_FILES["bannerImage"]["name"] != '') {

            //IMAGE HANDLING
            $imageName = $_FILES["bannerImage"]["name"];

            $tmpName = $_FILES["bannerImage"]["tmp_name"];
            $imageSize = $_FILES["bannerImage"]["size"];
            $imageExtension = strtolower(end(explode(".", $imageName)));
            $validExtension = ["jpg", "jpeg", "png"];

            $bannerImage = date("mdyhis") . '.' . $imageExtension;

            if (in_array($imageExtension, $validExtension)) {
                if ($imageSize < 10000000) {
                    $bannerObject = new Banner();
                    $bannerObject->setBannerVariables($_POST, $bannerImage);

                    $updated = $bannerObject->updateBanner($_POST["bannerId"]);

                    if ($updated) {

                        list($uplodWidth, $uplodHeight) = getimagesize($tmpName);

                        $sWidth = 3500;
                        $sHeight = 2000;

                        $sImage = imagecreatetruecolor($sWidth, $sHeight);

                        $sorceFile = imagecreatefromjpeg($tmpName);

                        imagecopyresized($sImage, $sorceFile, 0, 0, 0, 0, $sWidth, $sHeight, $uplodWidth, $uplodHeight);

                        imagejpeg($sImage, "../../lib/images/banner/" . $bannerImage);

                        unlink("../../lib/images/banner/" . $oldBannerImage);
                        // move_uploaded_file($tmpName, "../../lib/images/banner/" . $bannerImage);

                        echo "Banner updated successfully";
                    } else {
                        echo "Error in updating data";
                    }
                } else {
                    echo "Image size must be less than 2 mb";
                }
            } else {
                echo "Only .jpg or .jpeg or .png files allowed";
            }
        } else {

            $bannerObject->setBannerVariables($_POST, $oldBannerImage);

            $updated = $bannerObject->updateBanner($_POST["bannerId"]);

            if ($updated) {
                echo "Banner updated successfully";
            } else {
                echo "Error in updating data";
            }
        }
    }
} else {
    echo "Fields can not be empty";
}
