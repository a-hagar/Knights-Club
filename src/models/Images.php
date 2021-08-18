<?php
//namespace
namespace Webappdev\Knightsclub\models;


use PDO;

class Images
{
    //Getting a list of images of a particular user using their id
    public function getImagesById($id, $db)
    {
        $selectQuery = "SELECT u.username, g.image_name, g.main_image, g.id AS image_id
                        FROM gallery g
                        JOIN user u
                            ON g.user_id =  u.id
                        WHERE g.user_id = :id";
        $pdostmt = $db->prepare($selectQuery);
        $pdostmt->bindParam(':id', $id);
        $pdostmt->execute();

        $selectedUser = $pdostmt->fetchAll(PDO::FETCH_OBJ);
        return $selectedUser;
    }

    public function getUserNameById($id, $db)
    {
        $selectQuery = "SELECT username
                        FROM user
                        WHERE id = :id";
        $pdostmt = $db->prepare($selectQuery);
        $pdostmt->bindParam(':id', $id);
        $pdostmt->execute();

        $selectedUser = $pdostmt->fetch(PDO::FETCH_OBJ);
        return $selectedUser;
    }
    //Not sure if need to implement a method to fetch all the image in the database, will consider this later

    //Might need to implement a method to get the profile image only

    public function uploadImage($id, $imgName, $db)
    {
        $not_main_status = "";

        $selectQuery = "INSERT INTO gallery (user_id, image_name,main_image)
                        VALUES (:id, :imgName,:not_main_status)";
        $pdostmt = $db->prepare($selectQuery);

        $pdostmt->bindParam(':id', $id);
        $pdostmt->bindParam(':imgName', $imgName);
        $pdostmt->bindParam(':not_main_status', $not_main_status);

        $count = $pdostmt->execute();

        return $count;
    }

    public function changeImageStatus($id, $status, $db)
    {
        $selectQuery = "UPDATE gallery
                        SET main_image = :status
                        WHERE id = :id";
        $pdostmt = $db->prepare($selectQuery);

        $pdostmt->bindParam(':id', $id);
        $pdostmt->bindParam(':status', $status);

        $count = $pdostmt->execute();
        return $count;
    }

    public function deleteImage($id, $db)
    {
        $selectQuery = "DELETE FROM gallery
                        WHERE id = :id";
        $pdostmt = $db->prepare($selectQuery);

        $pdostmt->bindParam(':id', $id);

        $count = $pdostmt->execute();
        return $count;
    }

    public function getImageStatus($id, $db)
    {
        $selectQuery = "SELECT main_image FROM gallery
                        WHERE id = :id";
        $pdostmt = $db->prepare($selectQuery);

        $pdostmt->bindParam(':id', $id);

        $pdostmt->execute();

        $selectedUser = $pdostmt->fetch(PDO::FETCH_OBJ);
        return $selectedUser;
    }
}
