<?php

require $_SERVER["DOCUMENT_ROOT"] . '/controller/News.php';


if (trim($_POST["newsTitle"]) != '' || $_POST["newsDetail"] != '') {
    $newsObject = new news();

    if ($_POST["newsId"] == '') {
        //IMAGE HANDLING
        $imageName = $_FILES["newsImage"]["name"];
        $tmpName = $_FILES["newsImage"]["tmp_name"];
        $imageSize = $_FILES["newsImage"]["size"];
        $imageExtension = strtolower(end(explode(".", $imageName)));
        $validExtension = ["jpg", "jpeg", "png"];

        $newsImage = date("mdyhis") . '.' . $imageExtension;

        if (in_array($imageExtension, $validExtension)) {
            if ($imageSize < 10000000) {
                $newsObject->setNewsVariables($_POST, $newsImage);

                $inserted = $newsObject->insertNews();

                if ($inserted) {

                    list($uplodWidth, $uplodHeight) = getimagesize($tmpName);

                    $sWidth = 1200;
                    $sHeight = 700;

                    $sImage = imagecreatetruecolor($sWidth, $sHeight);

                    $sorceFile = imagecreatefromjpeg($tmpName);

                    imagecopyresized($sImage, $sorceFile, 0, 0, 0, 0, $sWidth, $sHeight, $uplodWidth, $uplodHeight);

                    imagejpeg($sImage, "../../lib/images/news/" . $newsImage);

                    // move_uploaded_file($tmpName, "../../lib/images/news/" . $newsImage);

                    echo "news inserted successfully";
                } else {
                    echo "Error in inserting data";
                }
            } else {
                echo "Image size must be less than 2 mb";
            }
        } else {
            echo "Only .jpg or .jpeg or .png files allowed";
        }
    } else {
        //OLD DATA
        $oldNewsData = $newsObject->fetchNews('*', ["news_id" => $_POST["newsId"]]);

        $oldNewsImage = $oldNewsData[0]["news_image"];

        //UPDATING DATA
        if ($_FILES["newsImage"]["name"] != '') {

            //IMAGE HANDLING
            $imageName = $_FILES["newsImage"]["name"];

            $tmpName = $_FILES["newsImage"]["tmp_name"];
            $imageSize = $_FILES["newsImage"]["size"];
            $imageExtension = strtolower(end(explode(".", $imageName)));
            $validExtension = ["jpg", "jpeg"];

            $newsImage = date("mdyhis") . '.' . $imageExtension;

            if (in_array($imageExtension, $validExtension)) {
                if ($imageSize < 10000000) {
                    $newsObject->setNewsVariables($_POST, $newsImage);

                    $updated = $newsObject->updateNews($_POST["newsId"]);

                    if ($updated) {
                        list($uplodWidth, $uplodHeight) = getimagesize($tmpName);

                        $sWidth = 1200;
                        $sHeight = 700;

                        $sImage = imagecreatetruecolor($sWidth, $sHeight);

                        $sorceFile = imagecreatefromjpeg($tmpName);

                        imagecopyresized($sImage, $sorceFile, 0, 0, 0, 0, $sWidth, $sHeight, $uplodWidth, $uplodHeight);

                        imagejpeg($sImage, "../../lib/images/news/" . $newsImage);

                        unlink("../../lib/images/news/" . $oldNewsImage);
                        // move_uploaded_file($tmpName, "../../lib/images/news/" . $newsImage);

                        echo "news updated successfully";
                    } else {
                        echo "Error in updating data";
                    }
                } else {
                    echo "Image size must be less than 2 mb";
                }
            } else {
                echo "Only .jpg or .jpeg files allowed";
            }
        } else {

            $newsObject->setNewsVariables($_POST, $oldNewsImage);

            $updated = $newsObject->updateNews($_POST["newsId"]);

            if ($updated) {
                echo "news updated successfully";
            } else {
                echo "Error in updating data";
            }
        }
    }
} else {
    echo "Fields can not be empty";
}
