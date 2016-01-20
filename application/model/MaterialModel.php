<?php

class MaterialModel
{
    /**
     * Get all materials
     * @return array an array with several objects (the results)
     */
    public static function getAllMaterials()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT material_id, material_name, material_price, material_weight, material_dimension_high, material_dimension_width,
                       material_dimension_profound, material_provider_id, material_has_photoMaterial,material_description
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
            $all_materials[$material->material_id]->material_has_photoMaterial = $material->material_has_photoMaterial;
            $all_materials[$material->material_id]->material_description = $material->material_description;
        }

        return $all_materials;
    }

    /**
     * Get a single note
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

        // fetch() is the PDO method that gets a single result
        return $query->fetch();
    }

    /**
     * Set a material (create a new one)
     * @return boolean Gives back the success status of the registration of the material
     */
    public static function createMaterial()
    {
        // clean the input
        $material_name = strip_tags(Request::post('material_name', true));
        $material_price = strip_tags(Request::post('material_price', true));
        $material_weight = strip_tags(Request::post('material_weight', true));
        $material_dimension_high = strip_tags(Request::post('material_dimension_high', true));
        $material_dimension_width = strip_tags(Request::post('material_dimension_width', true));
        $material_dimension_profound = strip_tags(Request::post('material_dimension_profound', true));
        $material_provider_id = strip_tags(Request::post('material_provider_id', true));
        $material_has_photoMaterial = strip_tags(Request::post('material_has_photoMaterial', true));
        $material_description = strip_tags(Request::post('material_description', true));

        $validation_result = self::registrationInputValidation($material_name, $material_price, $material_weight, $material_dimension_high, $material_dimension_width, $material_dimension_profound, $material_provider_id, $material_has_photoMaterial, $material_description);
        if (!$validation_result) {
          return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO materials (material_name, material_price, material_weight, material_dimension_high, material_dimension_width,
                                   material_dimension_profound, material_provider_id, material_has_photoMaterial, material_description, user_id)
                    VALUES (:material_name, :material_price, :material_weight, :material_dimension_high, :material_dimension_width,
                           :material_dimension_profound, :material_provider_id, :material_has_photoMaterial, :material_description, :user_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':material_name' => $material_name,
                              ':material_price' => $material_price,
                              ':material_weight' => $material_weight,
                              ':material_dimension_high' => $material_dimension_high,
                              ':material_dimension_width' => $material_dimension_width,
                              ':material_dimension_profound' => $material_dimension_profound,
                              ':material_provider_id' => $material_provider_id,
                              ':material_has_photoMaterial' => $material_has_photoMaterial,
                              ':material_description' => $material_description,
                              ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }
        self::createPhotoMaterial();

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_MATERIAL_CREATION_FAILED'));
        return false;
    }

    /**
     * Update an existing material
     * @return bool feedback (was the update successful ?)
     */
    public static function updateMaterial()
    {
        // clean the input
        $material_id = Request::post('material_id');
        $material_name = strip_tags(Request::post('material_name', true));
        $material_price = strip_tags(Request::post('material_price', true));
        $material_weight = strip_tags(Request::post('material_weight', true));
        $material_dimension_high = strip_tags(Request::post('material_dimension_high', true));
        $material_dimension_width = strip_tags(Request::post('material_dimension_width', true));
        $material_dimension_profound = strip_tags(Request::post('material_dimension_profound', true));
        $material_provider_id = strip_tags(Request::post('material_provider_id', true));
        $material_has_photoMaterial = strip_tags(Request::post('material_has_photoMaterial', true));
        $material_description = strip_tags(Request::post('material_description', true));

        $validation_result = self::registrationInputValidation($material_name, $material_price, $material_weight, $material_dimension_high, $material_dimension_width, $material_dimension_profound, $material_provider_id, $material_has_photoMaterial, $material_description);
        if (!$validation_result) {
          return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE materials
                SET material_name = :material_name, material_price = :material_price, material_weight = :material_weight,
                   material_dimension_high = :material_dimension_high, material_dimension_width = :material_dimension_width, material_dimension_profound = :material_dimension_profound,
                    material_provider_id = :material_provider_id, material_has_photoMaterial = :material_has_photoMaterial, material_description = :material_description
                WHERE material_id = :material_id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':material_name' => $material_name,
                              ':material_price' => $material_price,
                              ':material_weight' => $material_weight,
                              ':material_dimension_high' => $material_dimension_high,
                              ':material_dimension_width' => $material_dimension_width,
                              ':material_dimension_profound' => $material_dimension_profound,
                              ':material_provider_id' => $material_provider_id,
                              ':material_has_photoMaterial' => $material_has_photoMaterial,
                              ':material_description' => $material_description,
                              ':material_id' => $material_id,
                              ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_MATERIAL_EDITING_FAILED'));
        return false;
    }

    /**
     * Delete a specific note
     * @param int $material_id id of the note
     * @return bool feedback (was the note deleted properly ?)
     */
    public static function deleteMaterial($material_id)
    {
        if (!$material_id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM materials WHERE material_id = :material_id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':material_id' => $material_id, ':user_id' => Session::get('user_id')));

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
    public static function registrationInputValidation($material_name, $material_price, $material_weight, $material_dimension_high, $material_dimension_width, $material_dimension_profound, $material_provider_id, $material_has_photoMaterial, $material_description)
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

    public static function createPhotoMaterial()
    {
        // check photoMaterial folder writing rights, check if upload fits all rules
        if (self::isPhotoMaterialFolderWritable() AND self::validateImageFile()) {
            // create a jpg file in the photoMaterial folder, write marker to database
            $target_file_path = Config::get('PATH_MATERIALS') . Session::get('material_id');
            self::resizePhotoMaterialImage($_FILES['photoMaterial_file']['tmp_name'], $target_file_path, Config::get('PHOTOMATERIAL_SIZE'), Config::get('PHOTOMATERIAL_SIZE'));
            self::writePhotoMaterialToDatabase(Session::get('material_id'));
            Session::set('material_has_photoMaterial_file', self::getPublicUserPhotoMaterialFilePathByUserId(Session::get('material_id')));
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
     * @param int $materialId
     * @return bool success
     */
    public static function deletePhotoMaterial($materialId)
    {
        if (!ctype_digit($materialId)) {
            Session::add("feedback_negative", Text::get("FEEDBACK_PHOTOMATERIAL_IMAGE_DELETE_FAILED"));
            return false;
        }

        // try to delete image, but still go on regardless of file deletion result
        self::deletePhotoMaterialImageFile($materialId);

        $database = DatabaseFactory::getFactory()->getConnection();

        $sth = $database->prepare("UPDATE materials SET material_has_photoMaterial = 0 WHERE material_id = :material_id LIMIT 1");
        $sth->bindValue(":material_id", (int)$materialId, PDO::PARAM_INT);
        $sth->execute();

        if ($sth->rowCount() == 1) {
            Session::set('material_photoMaterial_file', self::getPublicUserPhotoMaterialFilePathByUserId($materialId));
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
     * @param integer $materialId
     * @return bool
     */
    public static function deletePhotoMaterialImageFile($materialId)
    {
        // Check if file exists
        if (!file_exists(Config::get('PATH_MATERIALS') . $materialId . ".jpg")) {
            Session::add("feedback_negative", Text::get("FEEDBACK_PHOTOMATERIAL_IMAGE_DELETE_NO_FILE"));
            return false;
        }

        // Delete photoMaterial file
        if (!unlink(Config::get('PATH_MATERIALS') . $materialId . ".jpg")) {
            Session::add("feedback_negative", Text::get("FEEDBACK_PHOTOMATERIAL_IMAGE_DELETE_FAILED"));
            return false;
        }

        return true;
    }

     /**
     * Gets the material's photoMaterial file path
     * @param $material_id integer The material's id
     * @return string photoMaterial picture path
     */
    public static function getPublicUserPhotoMaterialFilePathByUserId($material_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT material_has_photoMaterial FROM materials WHERE material_id = :material_id LIMIT 1");
        $query->execute(array(':material_id' => $material_id));

        if ($query->fetch()->material_has_photoMaterial) {
            return Config::get('URL') . Config::get('PATH_MATERIALS_PUBLIC') . $material_id . '.jpg';
        }

        return Config::get('URL') . Config::get('PATH_MATERIALS_PUBLIC') . Config::get('PHOTOMATERIAL_DEFAULT_IMAGE');
    }

}
