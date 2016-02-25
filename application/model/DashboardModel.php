<?php

class DashboardModel
{
    /**
     * Get all materials
     * @return integer of num rows
     */
    public static function getNumRowAllMaterials()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT material_id, material_name, material_price, material_weight, material_dimension_high, material_dimension_width,
                       material_dimension_profound, material_provider_id, material_has_photoMaterial, material_description
                FROM materials WHERE user_id = :user_id ";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id')));
        $numTotalRegister = $query->rowCount();

        return $numTotalRegister;
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
            $all_materials[$material->material_id]->material_photoMaterial_link = (Config::get('USE_GRAVATAR') ? AvatarModel::getGravatarLinkByEmail($user->user_email) : self::getPublicPhotoMaterialFilePathOfMaterial($material->material_has_photoMaterial, $material->material_id));
            $all_materials[$material->material_id]->material_description = $material->material_description;
            $all_materials[$material->material_id]->quantity = $material->quantity;
        }

        return $all_materials;
    }

    public static function getAllOeuvreMaterialsPaginatedAndOrder($start, $itemsToShow, $orderBy)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT o.oeuvre_id, o.oeuvre_name, m.material_id, material_name, material_price, material_weight, material_dimension_high, material_dimension_width,
                       material_dimension_profound, material_provider_id, material_has_photoMaterial, material_description
                FROM oeuvres_materials AS om, materials AS m, oeuvres AS o WHERE m.material_id = om.material_id AND o.oeuvre_id = om.oeuvre_id ORDER BY $orderBy LIMIT $start, $itemsToShow";
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
            $all_materials[$material->material_id]->material_photoMaterial_link = (Config::get('USE_GRAVATAR') ? AvatarModel::getGravatarLinkByEmail($user->user_email) : self::getPublicPhotoMaterialFilePathOfMaterial($material->material_has_photoMaterial, $material->material_id));
            $all_materials[$material->material_id]->material_description = $material->material_description;
        }

        return $all_materials;
    }

    /**
     * Get all materials
     * @return array an array with several objects (the results)
     */
    public static function getAllMaterials()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT material_id, material_name, material_price, material_weight, material_dimension_high, material_dimension_width,
                       material_dimension_profound, material_provider_id, material_has_photoMaterial, material_description
                FROM materials WHERE user_id = :user_id ";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id')));

        $all_materials = array();

        foreach ($query->fetchAll() as $material) {

            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the material's values
            array_walk_recursive($material, 'Filter::XSSFilter');

            $all_materials[$material->material_id] = new stdClass();
            $all_materials[$material->material_id]->material_id = $material->material_id;
            $all_materials[$material->material_id]->material_name = $material->material_name;
            $all_materials[$material->material_id]->material_price = $material->material_price;
            $all_materials[$material->material_id]->material_weight = $material->material_weight;
            $all_materials[$material->material_id]->material_dimension_high = $material->material_dimension_high;
            $all_materials[$material->material_id]->material_dimension_width = $material->material_dimension_width;
            $all_materials[$material->material_id]->material_dimension_profound = $material->material_dimension_profound;
            $all_materials[$material->material_id]->material_provider_id = $material->material_provider_id;
            $all_materials[$material->material_id]->material_photoMaterial_link = (Config::get('USE_GRAVATAR') ? AvatarModel::getGravatarLinkByEmail($user->user_email) : self::getPublicPhotoMaterialFilePathOfMaterial($material->material_has_photoMaterial, $material->material_id));
            $all_materials[$material->material_id]->material_description = $material->material_description;
        }

        return $all_materials;
    }

    /**
     * Get a single material
     * @param int $material_id id of the specific material
     * @return object a single object (the result)
     */
    public static function getMaterial($material_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT material_id, material_name, material_price, material_weight, material_dimension_high, material_dimension_width, material_dimension_profound, material_provider_id, material_has_photoMaterial, material_description
                   FROM materials WHERE material_id = :material_id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id'), ':material_id' => $material_id));

        foreach ($query->fetchAll() as $material) {
            $material->material_id = $material->material_id;
            $material->material_name = $material->material_name;
            $material->material_price = $material->material_price;
            $material->material_weight = $material->material_weight;
            $material->material_dimension_high = $material->material_dimension_high;
            $material->material_dimension_width = $material->material_dimension_width;
            $material->material_dimension_profound = $material->material_dimension_profound;
            $material->material_provider_id = $material->material_provider_id;
            $material->material_photoMaterial_link = (Config::get('USE_GRAVATAR') ? AvatarModel::getGravatarLinkByEmail($user->user_email) : self::getPublicPhotoMaterialFilePathOfMaterial($material->material_has_photoMaterial, $material->material_id));
            $material->material_description = $material->material_description;
        }
        return $material;
        // fetch() is the PDO method that gets a single result
        //return $query->fetch();
    }
 /**
     * Get a single material
     * @param String $material_name id of the specific material
     * @return object a single object (the result)
     */
    public static function getMaterialByName($material_name)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT material_id, material_name, material_price, material_weight, material_dimension_high, material_dimension_width, material_dimension_profound, material_provider_id, material_has_photoMaterial, material_description
                   FROM materials WHERE material_name = :material_name AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id'), ':material_name' => $material_name));

        // fetch() is the PDO method that gets a single result
        return $query->fetch();
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

    /**
     * Validates registration of other inputs
     *
     * @param $material_name
     * @param $material_price
     * @param $material_weight
     * @param $material_dimension_high
     * @param $material_dimension_width
     * @param $material_dimension_profound
     * @param $material_provider_id
     * @param $material_has_photoMaterial
     * @param $material_description
     *
     * @return bool
     */
    public static function registrationInputValidation($material_name, $material_price, $material_weight, $material_dimension_high, $material_dimension_width, $material_dimension_profound, $material_provider_id, $material_description)
    {
        return true;

        if (empty($material_name)) {
            Session::add('feedback_negative', 'El campo Nombre está vacío');
            return false;
        }
        if (!preg_match('/[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}/', $material_name)) {
            Session::add('feedback_negative', 'El campo Nombre no se ajusta al patrón: Sólo mayusculas y minusculas y espacios, de 2 a 64 caracteres');
            return false;
        }
        if (empty($material_price)) {
            Session::add('feedback_negative', 'El campo precio está vacío');
            return false;
        }
        if (!preg_match('/[0-9]{1,6}\.[0-9]{1,2}/', $material_price)) {
            Session::add('feedback_negative', 'El campo precio no se ajusta al patrón: numero decimal con máx. 6 digitos y 2 decimales (separado por "punto").');
            return false;
        }

        if (empty($material_weight)) {
            Session::add('feedback_negative', 'El campo peso está vacío');
            return false;
        }
        if (!preg_match('/[0-9]{1,10}\.[0-9]{1,2}/', $material_weight)) {
            Session::add('feedback_negative', 'El campo peso no se ajusta al patrón: numero decimal con máx. 10 digitos y 2 decimales (separado por "punto").');
            return false;
        }
        if (empty($material_dimension_high)) {
            Session::add('feedback_negative', 'El campo Altura está vacío');
            return false;
        }
        if (!preg_match('/[0-9]{1,10}\.[0-9]{1,2}/', $material_dimension_high)) {
            Session::add('feedback_negative', 'El campo Altura no se ajusta al patrón: numero decimal con máx. 10 digitos y 2 decimales (separado por "punto").');
            return false;
        }
        if (empty($material_dimension_width)) {
            Session::add('feedback_negative', 'El campo Anchura está vacío');;
            return false;
        }
        if (!preg_match('/[0-9]{1,10}\.[0-9]{1,2}/', $material_dimension_width)) {
            Session::add('feedback_negative', 'El campo Anchura no se ajusta al patrón: numero decimal con máx. 10 digitos y 2 decimales (separado por "punto").');
            return false;
        }
        if (empty($material_dimension_profound)) {
            Session::add('feedback_negative', 'El campo profundidad está vacío');
            return false;
        }
        if (!preg_match('/[0-9]{1,10}\.[0-9]{1,2}/', $material_dimension_profound)) {
            Session::add('feedback_negative', 'El campo profundidad no se ajusta al patrón: numero decimal con máx. 10 digitos y 2 decimales (separado por "punto").');
            return false;
        }
        if (empty($material_provider_id)) {
            Session::add('feedback_negative', 'El campo id proveedor está vacío');
            return false;
        }
        if (!preg_match('/[0-9]{1,5}/', $material_provider_id)) {
            Session::add('feedback_negative', 'El campo id proveedor no se ajusta al patrón: 5 cifras maximo.');
            return false;
        }
        if (empty($material_description)) {
            Session::add('feedback_negative', 'El campo descripcion está vacío');
            return false;
        }
        // if name is too short (2), too long (64) or does not fit the pattern (aZ)
        if (!preg_match('/[0-9A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,100}/', $material_description)) {
            Session::add('feedback_negative', 'El campo descripcion no se ajusta al patrón: Sólo mayusculas y minusculas y espacios, de 2 a 100 caracteres');
            return false;
        }
    }

    public static function createPhotoMaterial($material_id)
    {
        // check photoMaterial folder writing rights, check if upload fits all rules
        if (self::isPhotoMaterialFolderWritable() AND self::validateImageFile()) {
            // create a jpg file in the photoMaterial folder, write marker to database
            $target_file_path = Config::get('PATH_MATERIALS') . $material_id;
            self::resizePhotoMaterialImage($_FILES['photoMaterial_file']['tmp_name'], $target_file_path, Config::get('PHOTOMATERIAL_SIZE'), Config::get('PHOTOMATERIAL_SIZE'));
            self::writePhotoMaterialToDatabase($material_id);
            Session::set('material_has_photoMaterial_file', self::getPublicPhotoMaterialFilePathByMaterialId($material_id));
            Session::add('feedback_positive', Text::get('FEEDBACK_PHOTOMATERIAL_UPLOAD_SUCCESSFUL'));
        }
    }

    /**
     * Checks if the photoMaterial folder exists and is writable
     *
     * @return bool success status
     */
    public static function isPhotoMaterialFolderWritable()
    {
        if (is_dir(Config::get('PATH_MATERIALS')) AND is_writable(Config::get('PATH_MATERIALS'))) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PHOTOMATERIAL_FOLDER_DOES_NOT_EXIST_OR_NOT_WRITABLE'));
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
        if (!isset($_FILES['photoMaterial_file'])) {
            Session::add('feedback_negative', Text::get('FEEDBACK_PHOTOMATERIAL_IMAGE_UPLOAD_FAILED'));
            return false;
        }

        // if input file too big (>5MB)
        if ($_FILES['photoMaterial_file']['size'] > 5000000) {
            Session::add('feedback_negative', Text::get('FEEDBACK_PHOTOMATERIAL_UPLOAD_TOO_BIG'));
            return false;
        }

        // get the image width, height and mime type
        $image_proportions = getimagesize($_FILES['photoMaterial_file']['tmp_name']);

        if(empty($image_proportions)){
          return false;
        }else{
          // if input file too small, [0] is the width, [1] is the height
          if ($image_proportions[0] < Config::get('PHOTOMATERIAL_SIZE') OR $image_proportions[1] < Config::get('PHOTOMATERIAL_SIZE')) {
              Session::add('feedback_negative', Text::get('FEEDBACK_PHOTOMATERIAL_UPLOAD_TOO_SMALL'));
              return false;
          }

          // if file type is not jpg, gif or png
          if (!in_array($image_proportions['mime'], array('image/jpeg', 'image/gif', 'image/png'))) {
              Session::add('feedback_negative', Text::get('FEEDBACK_PHOTOMATERIAL_UPLOAD_WRONG_TYPE'));
              return false;
          }
        }

        return true;
    }

    /**
     * Writes marker to database, saying material has an photoMaterial now
     *
     * @param $material_id
     */
    public static function writePhotoMaterialToDatabase($material_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("UPDATE materials SET material_has_photoMaterial = TRUE WHERE material_id = :material_id LIMIT 1");
        $query->execute(array(':material_id' => $material_id));
    }

    /**
     * Resize photoMaterial image (while keeping aspect ratio and cropping it off in a clean way).
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
    public static function resizePhotoMaterialImage($source_image, $destination, $final_width = 60, $final_height = 60)
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

        // copying the part into thumbnail, maybe edit this for square photoMaterials
        $thumb = imagecreatetruecolor($final_width, $final_height);
        imagecopyresampled($thumb, $myImage, 0, 0, $horizontalCoordinateOfSource, $verticalCoordinateOfSource, $final_width, $final_height, $smallestSide, $smallestSide);

        // add '.jpg' to file path, save it as a .jpg file with our $destination_filename parameter
        imagejpeg($thumb, $destination . '.jpg', Config::get('PHOTOMATERIAL_JPEG_QUALITY'));
        imagedestroy($thumb);

        if (file_exists($destination)) {
            return true;
        }
        return false;
    }


    /**
     * Delete a material's photoMaterial
     *
     * @param int $material_id
     * @return bool success
     */
    public static function deletePhotoMaterial($material_id)
    {
        if (!ctype_digit($material_id)) {
            Session::add("feedback_negative", Text::get("FEEDBACK_PHOTOMATERIAL_IMAGE_DELETE_FAILED"));
            return false;
        }

        // try to delete image, but still go on regardless of file deletion result
        self::deletePhotoMaterialImageFile($material_id);

        $database = DatabaseFactory::getFactory()->getConnection();

        $sth = $database->prepare("UPDATE materials SET material_has_photoMaterial = 0 WHERE material_id = :material_id LIMIT 1");
        $sth->bindValue(":material_id", (int)$material_id, PDO::PARAM_INT);
        $sth->execute();

        if ($sth->rowCount() == 1) {
            Session::set('material_photoMaterial_file', self::getPublicPhotoMaterialFilePathByMaterialId($material_id));
            Session::add("feedback_positive", Text::get("FEEDBACK_PHOTOMATERIAL_IMAGE_DELETE_SUCCESSFUL"));
            return true;
        } else {
            Session::add("feedback_negative", Text::get("FEEDBACK_PHOTOMATERIAL_IMAGE_DELETE_FAILED"));
            return false;
        }
    }

    /**
     * Removes the photoMaterial image file from the filesystem
     *
     * @param integer $material_id
     * @return bool
     */
    public static function deletePhotoMaterialImageFile($material_id)
    {
        // Check if file exists
        if (!file_exists(Config::get('PATH_MATERIALS') . $material_id . ".jpg")) {
            Session::add("feedback_negative", Text::get("FEEDBACK_PHOTOMATERIAL_IMAGE_DELETE_NO_FILE"));
            return false;
        }

        // Delete photoMaterial file
        if (!unlink(Config::get('PATH_MATERIALS') . $material_id . ".jpg")) {
            Session::add("feedback_negative", Text::get("FEEDBACK_PHOTOMATERIAL_IMAGE_DELETE_FAILED"));
            return false;
        }

        return true;
    }

    /**
     * Gets the user's avatar file path
     * @param int $user_has_avatar Marker from database
     * @param int $user_id Material's id
     * @return string PhotoMaterial file path
     */
    public static function getPublicPhotoMaterialFilePathOfMaterial($material_has_photoMaterial, $material_id)
    {
        if ($material_has_photoMaterial) {
            return Config::get('URL') . Config::get('PATH_MATERIALS_PUBLIC') . $material_id . '.jpg';
        }

        return Config::get('URL') . Config::get('PATH_MATERIALS_PUBLIC') . Config::get('PHOTOMATERIAL_DEFAULT_IMAGE');
    }


     /**
     * Gets the material's photoMaterial file path
     * @param $material_id integer The material's id
     * @return string photoMaterial picture path
     */
    public static function getPublicPhotoMaterialFilePathByMaterialId($material_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT material_has_photoMaterial FROM materials WHERE material_id = :material_id LIMIT 1");
        $query->execute(array(':material_id' => $material_id));

        if ($query->fetch()->material_has_photoMaterial) {
            return Config::get('URL') . Config::get('PATH_MATERIALS_PUBLIC') . $material_id . '.jpg';
        }

        return Config::get('URL') . Config::get('PATH_MATERIALS_PUBLIC') . Config::get('PHOTOMATERIAL_DEFAULT_IMAGE');
    }

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


}