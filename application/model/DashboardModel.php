<?php

class DashboardModel
{
    public static function addMaterialToOeuvre($oeuvre_id, $material_id)
    {
      $database = DatabaseFactory::getFactory()->getConnection();

      $sql = "INSERT INTO oeuvres_materials (employee_id, oeuvre_id, material_id)
                                    VALUES (:employee_id, :oeuvre_id, :material_id)";
            $query = $database->prepare($sql);
            $query->execute(array(':employee_id' => Session::get('user_id'),
                                  ':oeuvre_id' => $oeuvre_id,
                                  ':material_id' => $material_id));

            if ($query->rowCount() > 0) {
                return true;
            }

            // default return
            Session::add('feedback_negative', 'No se ha añadido en tu obra ningún material, marque algún material para añadirlos');
            return false;

    }

    public static function getAllOeuvreMaterials()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT o.oeuvre_id, o.oeuvre_name, m.material_id, material_name, material_price, material_weight, material_dimension_high, material_dimension_width,
                       material_dimension_profound, material_provider_id, material_has_photoMaterial, material_description, quantity
                FROM oeuvres_materials AS om, materials AS m, oeuvres AS o WHERE m.material_id = om.material_id AND o.oeuvre_id = om.oeuvre_id ";
        $query = $database->prepare($sql);

        $query->execute();
        $all_materials = array();

        foreach ($query->fetchAll() as $material) {

            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the material's values
            array_walk_recursive($material, 'Filter::XSSFilter');

            $all_materials[$material->material_id] = new stdClass();
            $all_materials[$material->material_id]->oeuvre_id = $material->oeuvre_id;
            $all_materials[$material->material_id]->oeuvre_name = $material->oeuvre_name;
            $all_materials[$material->material_id]->material_id = $material->material_id;
            $all_materials[$material->material_id]->material_name = $material->material_name;
            $all_materials[$material->material_id]->material_price = $material->material_price;
            $all_materials[$material->material_id]->material_weight = $material->material_weight;
            $all_materials[$material->material_id]->material_dimension_high = $material->material_dimension_high;
            $all_materials[$material->material_id]->material_dimension_width = $material->material_dimension_width;
            $all_materials[$material->material_id]->material_dimension_profound = $material->material_dimension_profound;
            $all_materials[$material->material_id]->material_provider_id = $material->material_provider_id;
            $all_materials[$material->material_id]->material_photoMaterial_link = (Config::get('USE_GRAVATAR') ? AvatarModel::getGravatarLinkByEmail($user->user_email) : MaterialModel::getPublicPhotoMaterialFilePathOfMaterial($material->material_has_photoMaterial, $material->material_id));
            $all_materials[$material->material_id]->material_description = $material->material_description;
            $all_materials[$material->material_id]->quantity = $material->quantity;
        }

        return $all_materials;
    }

    /**
     * Update an existing material
     * @return bool feedback (was the update successful ?)
     */
    public static function updateQuantityMaterialOeuvre($oeuvre_id, $material_id, $quantity)
    {

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE oeuvres_materials
                SET quantity = :quantity
                WHERE material_id = :material_id AND oeuvre_id = :oeuvre_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':oeuvre_id' => $oeuvre_id,
                              ':material_id' => $material_id,
                              ':quantity' => $quantity));

        if ($query->rowCount() == 1) {
            Session::add('feedback_positive', 'Se ha actualizado correctamente en tu obra la cantidad del material');
            return true;
        }

        Session::add('feedback_negative', 'No se ha podido actualizar la cantidad del material');
        return false;
    }

    /**
     * Delete a specific material
     * @param int $material id of the material
     * @return bool feedback (was the material deleted properly ?)
     */
    public static function deleteMaterialOeuvre($material_id, $oeuvreMaterial_id)
    {
        if (!$material_id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM oeuvres_materials WHERE material_id = :material_id AND oeuvre_id = :oeuvre_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':material_id' => $material_id, ':oeuvre_id' => $oeuvreMaterial_id));

        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_MATERIAL_DELETION_FAILED'));
        return false;
    }

    public static function addPhotoToOeuvre($oeuvre_id)
    {
      $database = DatabaseFactory::getFactory()->getConnection();

      $sql = "INSERT INTO oeuvres_photos (employee_id, oeuvre_id)
                                    VALUES (:employee_id, :oeuvre_id)";
            $query = $database->prepare($sql);
            $query->execute(array(':employee_id' => Session::get('user_id'),
                                  ':oeuvre_id' => $oeuvre_id));

            if ($query->rowCount() > 0) {
                $lastInsertId = $database->lastInsertId();
                createPhotoOeuvre($lastInsertId);
                return true;
            }

            // default return
            Session::add('feedback_negative', 'No se ha añadido en tu obra ningúna foto');
            return false;

    }

    public static function getAllOeuvrePhotos()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT oeuvre_photo_id, o.oeuvre_id, o.oeuvre_name, u.user_id, u.user_name
                FROM oeuvres_photos AS of, users AS u, oeuvres AS o WHERE u.user_id = of.employee_id AND o.oeuvre_id = of.oeuvre_id ";
        $query = $database->prepare($sql);

        $query->execute();
        $all_oeuvrePhotos = array();

        foreach ($query->fetchAll() as $oeuvrePhoto) {

            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the oeuvrePhoto's values
            array_walk_recursive($oeuvrePhoto, 'Filter::XSSFilter');

            $all_oeuvrePhotos[$oeuvrePhoto->oeuvrePhoto_id] = new stdClass();
            $all_oeuvrePhotos[$oeuvrePhoto->oeuvrePhoto_id]->oeuvre_id = $oeuvrePhoto->oeuvre_id;
            $all_oeuvrePhotos[$oeuvrePhoto->oeuvrePhoto_id]->employee_id = $oeuvrePhoto->user_id;
            $all_oeuvrePhotos[$oeuvrePhoto->oeuvrePhoto_id]->oeuvre_name = $oeuvrePhoto->oeuvre_name;
            $all_oeuvrePhotos[$oeuvrePhoto->oeuvrePhoto_id]->user_name = $oeuvrePhoto->user_name;
            $all_oeuvrePhotos[$oeuvrePhoto->oeuvrePhoto_id]->oeuvrePhoto_photoOeuvre_link = self::getPublicPhotoOeuvreFilePathOfOeuvre($oeuvrePhoto->oeuvre_has_photoOeuvre, $oeuvrePhoto->oeuvrePhoto_id));
        }

        return $all_oeuvrePhotos;
    }

    /**
     * Gets the user's avatar file path
     * @param int $user_has_avatar Marker from database
     * @param int $oeuvrePhoto_id OeuvrePhoto_id's id
     * @return string PhotoOeuvre file path
     */
    public static function getPublicPhotoOeuvreFilePathOfOeuvre($oeuvre_has_photoOeuvre, $oeuvrePhoto_id)
    {
        if ($oeuvre_has_photoOeuvre) {
            return Config::get('URL') . Config::get('PATH_OEUVRES_PUBLIC') . $oeuvrePhoto_id . '.jpg';
        }

    }

    public static function createPhotoOeuvre($oeuvre_photo_id)
    {
        // check photoMaterial folder writing rights, check if upload fits all rules
        if (self::isPhotoOeuvreFolderWritable() AND self::validateImageFile()) {
            // create a jpg file in the photoOeuvre folder, write marker to database
            $target_file_path = Config::get('PATH_OEUVRES') . $oeuvre_photo_id;
            self::resizePhotoOeuvreImage($_FILES['photoOeuvre_file']['tmp_name'], $target_file_path, Config::get('PHOTOOEUVRE_SIZE'), Config::get('PHOTOOEUVRE_SIZE'));
            self::writePhotoOeuvreToDatabase($oeuvre_photo_id);
            Session::set('oeuvre_has_photoOeuvre_file', self::getPublicPhotoOeuvreFilePathByOeuvreId($oeuvre_photo_id));
            Session::add('feedback_positive', Text::get('FEEDBACK_PHOTOOEUVRE_UPLOAD_SUCCESSFUL'));
        }
    }

    /**
     * Checks if the photoMaterial folder exists and is writable
     *
     * @return bool success status
     */
    public static function isPhotoOeuvreFolderWritable()
    {
        if (is_dir(Config::get('PATH_OEUVRES')) AND is_writable(Config::get('PATH_OEUVRES'))) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PHOTOOEUVRE_FOLDER_DOES_NOT_EXIST_OR_NOT_WRITABLE'));
        return false;
    }

    /**
     * Validates the image
     * Only accepts gif, jpg, png types
     * @see http://php.net/manual/en/function.image-type-to-mime-type.php
     *
     * @return bool
     */
    public static function validateImageFile()
    {
        if (!isset($_FILES['photoOeuvre_file'])) {
            Session::add('feedback_negative', Text::get('FEEDBACK_PHOTOOEUVRE_IMAGE_UPLOAD_FAILED'));
            return false;
        }

        // if input file too big (>5MB)
        if ($_FILES['photoOeuvre_file']['size'] > 5000000) {
            Session::add('feedback_negative', Text::get('FEEDBACK_PHOTOOEUVRE_UPLOAD_TOO_BIG'));
            return false;
        }

        // get the image width, height and mime type
        $image_proportions = getimagesize($_FILES['photoOeuvre_file']['tmp_name']);

        if(empty($image_proportions)){
          return false;
        }else{
          // if input file too small, [0] is the width, [1] is the height
          if ($image_proportions[0] < Config::get('PHOTOOEUVRE_SIZE') OR $image_proportions[1] < Config::get('PHOTOOEUVRE_SIZE')) {
              Session::add('feedback_negative', Text::get('FEEDBACK_PHOTOOEUVRE_UPLOAD_TOO_SMALL'));
              return false;
          }

          // if file type is not jpg, gif or png
          if (!in_array($image_proportions['mime'], array('image/jpeg', 'image/gif', 'image/png'))) {
              Session::add('feedback_negative', Text::get('FEEDBACK_PHOTOOEUVRE_UPLOAD_WRONG_TYPE'));
              return false;
          }
        }

        return true;
    }

    /**
     * Writes marker to database, saying oeuvre has an photoOeuvre now
     *
     * @param $oeuvre_id
     */
    public static function writePhotoOeuvreToDatabase($oeuvre_photo_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("INSERT INTO oeuvres_photos SET oeuvre_has_photoOeuvre = TRUE WHERE oeuvre_photo_id = :oeuvre_photo_id LIMIT 1");
        $query->execute(array(':oeuvre_photo_id' => $oeuvre_photo_id));
    }

    /**
     * Resize photoOeuvre image (while keeping aspect ratio and cropping it off in a clean way).
     * Only works with gif, jpg and png file types. If you want to change this also have a look into
     * method validateImageFile() inside this model.
     *
     * TROUBLESHOOTING: You don't see the new image ? Press F5 or CTRL-F5 to refresh browser cache.
     *
     * @param string $source_image The location to the original raw image
     * @param string $destination The location to save the new image
     * @param int $final_width The desired width of the new image
     * @param int $final_height The desired height of the new image
     *
     * @return bool success state
     */
    public static function resizePhotoOeuvreImage($source_image, $destination, $final_width = 300, $final_height = 300)
    {
        $imageData = getimagesize($source_image);
        $width = $imageData[0];
        $height = $imageData[1];
        $mimeType = $imageData['mime'];

        if (!$width || !$height) {
            return false;
        }

        switch ($mimeType) {
            case 'image/jpeg': $myImage = imagecreatefromjpeg($source_image); break;
            case 'image/png': $myImage = imagecreatefrompng($source_image); break;
            case 'image/gif': $myImage = imagecreatefromgif($source_image); break;
            default: return false;
        }

        // calculating the part of the image to use for thumbnail
        if ($width > $height) {
            $verticalCoordinateOfSource = 0;
            $horizontalCoordinateOfSource = ($width - $height) / 2;
            $smallestSide = $height;
        } else {
            $horizontalCoordinateOfSource = 0;
            $verticalCoordinateOfSource = ($height - $width) / 2;
            $smallestSide = $width;
        }

        // copying the part into thumbnail, maybe edit this for square photoOeuvres
        $thumb = imagecreatetruecolor($final_width, $final_height);
        imagecopyresampled($thumb, $myImage, 0, 0, $horizontalCoordinateOfSource, $verticalCoordinateOfSource, $final_width, $final_height, $smallestSide, $smallestSide);

        // add '.jpg' to file path, save it as a .jpg file with our $destination_filename parameter
        imagejpeg($thumb, $destination . '.jpg', Config::get('PHOTOOEUVRE_JPEG_QUALITY'));
        imagedestroy($thumb);

        if (file_exists($destination)) {
            return true;
        }
        return false;
    }


    /**
     * Delete a oeuvre's photoOeuvre
     *
     * @param int $oeuvre_photo_id
     * @return bool success
     */
    public static function deletePhotoOeuvre($oeuvre_photo_id)
    {
        if (!ctype_digit($oeuvre_photo_id)) {
            Session::add("feedback_negative", Text::get("FEEDBACK_PHOTOOEUVRE_IMAGE_DELETE_FAILED"));
            return false;
        }

        // try to delete image, but still go on regardless of file deletion result
        self::deletePhotoOeuvreImageFile($oeuvre_photo_id);

        $database = DatabaseFactory::getFactory()->getConnection();

        $sth = $database->prepare("UPDATE oeuvres_photos SET oeuvre_has_photoOeuvre = 0 WHERE oeuvre_photo_id = :oeuvre_photo_id LIMIT 1");
        $sth->bindValue(":oeuvre_photo_id", (int)$oeuvre_photo_id, PDO::PARAM_INT);
        $sth->execute();

        if ($sth->rowCount() == 1) {
            Session::set('oeuvre_photoOeuvre_file', self::getPublicPhotoOeuvreFilePathByOeuvreId($oeuvre_photo_id));
            Session::add("feedback_positive", Text::get("FEEDBACK_PHOTOOEUVRE_IMAGE_DELETE_SUCCESSFUL"));
            return true;
        } else {
            Session::add("feedback_negative", Text::get("FEEDBACK_PHOTOOEUVRE_IMAGE_DELETE_FAILED"));
            return false;
        }
    }

    /**
     * Removes the photoOeuvre image file from the filesystem
     *
     * @param integer $oeuvre_photo_id
     * @return bool
     */
    public static function deletePhotoOeuvreImageFile($oeuvre_photo_id)
    {
        // Check if file exists
        if (!file_exists(Config::get('PATH_OEUVRES') . $oeuvre_photo_id . ".jpg")) {
            Session::add("feedback_negative", Text::get("FEEDBACK_PHOTOOEUVRE_IMAGE_DELETE_NO_FILE"));
            return false;
        }

        // Delete photoOeuvre file
        if (!unlink(Config::get('PATH_OEUVRES') . $oeuvre_photo_id . ".jpg")) {
            Session::add("feedback_negative", Text::get("FEEDBACK_PHOTOOEUVRE_IMAGE_DELETE_FAILED"));
            return false;
        }

        return true;
    }

    /**
     * Gets the user's avatar file path
     * @param int $user_has_avatar Marker from database
     * @param int $user_id Material's id
     * @return string PhotoOeuvre file path
     */
    public static function getPublicPhotoOeuvreFilePathOfOeuvre($oeuvre_has_photoOeuvre, $oeuvre_photo_id)
    {
        if ($oeuvre_has_photoOeuvre) {
            return Config::get('URL') . Config::get('PATH_OEUVRES_PUBLIC') . $oeuvre_photo_id . '.jpg';
        }

        return Config::get('URL') . Config::get('PATH_OEUVRES_PUBLIC') . Config::get('PHOTOOEUVRE_DEFAULT_IMAGE');
    }


     /**
     * Gets the oeuvre's photoOeuvre file path
     * @param $oeuvre_photo_id integer The oeuvre's id
     * @return string photoOeuvre picture path
     */
    public static function getPublicPhotoOeuvreFilePathByOeuvreId($oeuvre_photo_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT oeuvre_has_photoOeuvre FROM oeuvres_photos WHERE oeuvre_photo_id = :oeuvre_photo_id LIMIT 1");
        $query->execute(array(':oeuvre_photo_id' => $oeuvre_photo_id));

        if ($query->fetch()->oeuvre_has_photoOeuvre) {
            return Config::get('URL') . Config::get('PATH_OEUVRES_PUBLIC') . $oeuvre_photo_id . '.jpg';
        }

        return Config::get('URL') . Config::get('PATH_OEUVRES_PUBLIC') . Config::get('PHOTOOEUVRE_DEFAULT_IMAGE');
    }

}
