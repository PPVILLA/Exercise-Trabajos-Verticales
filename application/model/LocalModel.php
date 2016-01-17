<?php

class LocalModel
{
    /**
     * Get all locals
     * @return array an array with several objects (the results)
     */
    public static function getAllLocals()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT local_id, local_name, local_address, local_city_id, local_phone,
                       local_email, local_contact_name, local_latitud, local_longitud
                FROM locals WHERE user_id = :user_id ";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id')));

        $all_locals = array();

        foreach ($query->fetchAll() as $local) {

            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the local's values
            array_walk_recursive($local, 'Filter::XSSFilter');

            $all_locals[$local->local_id] = new stdClass();
            $all_locals[$local->local_id]->local_id = $local->local_id;
            $all_locals[$local->local_id]->local_name = $local->local_name;
            $all_locals[$local->local_id]->local_address = $local->local_address;
            $all_locals[$local->local_id]->local_city_id = $local->local_city_id;
            $all_locals[$local->local_id]->local_phone = $local->local_phone;
            $all_locals[$local->local_id]->local_email = $local->local_email;
            $all_locals[$local->local_id]->local_contact_name = $local->local_contact_name;
            $all_locals[$local->local_id]->local_latitud = $local->local_latitud;
            $all_locals[$local->local_id]->local_longitud = $local->local_longitud;
        }

        return $all_locals;
    }

    /**
     * Get a single note
     * @param int $local_id id of the specific local
     * @return object a single object (the result)
     */
    public static function getLocal($local_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT local_id, local_name, local_address, local_city_id, local_phone, local_email, local_contact_name, local_latitud, local_longitud
                   FROM locals WHERE local_id = :local_id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id'), ':local_id' => $local_id));

        // fetch() is the PDO method that gets a single result
        return $query->fetch();
    }

    /**
     * Set a local (create a new one)
     * @return boolean Gives back the success status of the registration of the local
     */
    public static function createLocal()
    {
        // clean the input
        $local_name = strip_tags(Request::post('local_name', true));
        $local_address = strip_tags(Request::post('local_address', true));
        $local_city_id = strip_tags(Request::post('local_city_id', true));
        $local_phone = strip_tags(Request::post('local_phone', true));
        $local_email = strip_tags(Request::post('local_email', true));
        $local_contact_name = strip_tags(Request::post('local_contact_name', true));
        $local_latitud = strip_tags(Request::post('local_latitud', true));
        $local_longitud = strip_tags(Request::post('local_longitud', true));

        $validation_result = self::registrationInputValidation($local_name, $local_address, $local_city_id, $local_phone, $local_email, $local_contact_name, $local_latitud, $local_longitud);
        if (!$validation_result) {
          return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO locals (local_name, local_address, local_city_id, local_phone, local_email,
                                   local_contact_name, local_latitud, local_longitud, user_id)
                    VALUES (:local_name, :local_address, :local_city_id, :local_phone, :local_email,
                           :local_contact_name, :local_latitud, :local_longitud, :user_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':local_name' => $local_name,
                              ':local_address' => $local_address,
                              ':local_city_id' => $local_city_id,
                              ':local_phone' => $local_phone,
                              ':local_email' => $local_email,
                              ':local_contact_name' => $local_contact_name,
                              ':local_latitud' => $local_latitud,
                              ':local_longitud' => $local_longitud,
                              ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_LOCAL_CREATION_FAILED'));
        return false;
    }

    /**
     * Update an existing local
     * @return bool feedback (was the update successful ?)
     */
    public static function updateLocal()
    {
        // clean the input
        $local_id = Request::post('local_id');
        $local_name = strip_tags(Request::post('local_name', true));
        $local_address = strip_tags(Request::post('local_address', true));
        $local_city_id = strip_tags(Request::post('local_city_id', true));
        $local_phone = strip_tags(Request::post('local_phone', true));
        $local_email = strip_tags(Request::post('local_email', true));
        $local_contact_name = strip_tags(Request::post('local_contact_name', true));
        $local_latitud = strip_tags(Request::post('local_latitud', true));
        $local_longitud = strip_tags(Request::post('local_longitud', true));

        $validation_result = self::registrationInputValidation($local_name, $local_address, $local_city_id, $local_phone, $local_email, $local_contact_name, $local_latitud, $local_longitud);
        if (!$validation_result) {
          return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE locals
                SET local_name = :local_name, local_address = :local_address, local_city_id = :local_city_id,
                   local_phone = :local_phone, local_email = :local_email, local_contact_name = :local_contact_name,
                    local_latitud = :local_latitud, local_longitud = :local_longitud
                WHERE local_id = :local_id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':local_name' => $local_name,
                              ':local_address' => $local_address,
                              ':local_city_id' => $local_city_id,
                              ':local_phone' => $local_phone,
                              ':local_email' => $local_email,
                              ':local_contact_name' => $local_contact_name,
                              ':local_latitud' => $local_latitud,
                              ':local_longitud' => $local_longitud,
                              ':local_id' => $local_id,
                              ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_LOCAL_EDITING_FAILED'));
        return false;
    }

    /**
     * Delete a specific note
     * @param int $local_id id of the note
     * @return bool feedback (was the note deleted properly ?)
     */
    public static function deleteLocal($local_id)
    {
        if (!$local_id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM locals WHERE local_id = :local_id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':local_id' => $local_id, ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_LOCAL_DELETION_FAILED'));
        return false;
    }

    /**
   * Validates registration of other inputs
   *
   * @param $local_name
   * @param $local_address
   * @param $local_city_id
   * @param $local_phone
   * @param $local_email
   * @param $local_contact_name
   * @param $local_latitud
   * @param $local_longitud
   *
   * @return bool
   */
  public static function registrationInputValidation($local_name, $local_address, $local_city_id, $local_phone, $local_email, $local_contact_name, $local_latitud, $local_longitud)
  {
        return true;

        if (empty($local_name)) {
            Session::add('feedback_negative', 'El campo Nombre está vacío');
            return false;
        }
        // if name is too short (2), too long (64) or does not fit the pattern (aZ)
        if (!preg_match('/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}$/', $local_name)) {
            Session::add('feedback_negative', 'El campo Nombre no se ajusta al patrón: Sólo mayusculas y minusculas y espacios, de 2 a 64 caracteres');
            return false;
        }
        if (empty($local_address)) {
            Session::add('feedback_negative', 'El campo Direccion está vacío');
            return false;
        }
        // if name is too short (2), too long (64) or does not fit the pattern (aZ)
        if (!preg_match('/^[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s,]{2,64}$/', $local_address)) {
            Session::add('feedback_negative', 'El campo Direccion no se ajusta al patrón: Sólo mayusculas, minusculas, numeros, espacios comas y guiones, de 2 a 64 caracteres');
            return false;
        }

        if (empty($local_city_id)) {
            Session::add('feedback_negative', 'El campo Poblacion está vacío');
            return false;
        }
        // if name is too short (2), too long (64) or does not fit the pattern (aZ)
        if (!preg_match('/^[0-9A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}$/', $local_city_id)) {
            Session::add('feedback_negative', 'El campo Poblacion no se ajusta al patrón: Sólo mayusculas y minusculas y espacios, de 2 a 64 caracteres');
            return false;
        }
        if (empty($local_phone)) {
            Session::add('feedback_negative', 'El campo Telefono está vacío');
            return false;
        }
        // if phone does not fit the pattern (+34923456789 +34 923456789 923456789 +34623456789+34 623456789 623456789)
        if (!preg_match('/^(\+34\s?)([9|6][0-9]{8})$|^([9|6][0-9]{8})$/', $local_phone)) {
            Session::add('feedback_negative', 'El campo Telefono no se ajusta al patrón: opcional empezar por +34 seguido de un espacio o sin él. Luego el nº telefono debe de empezar por 9 o por 6 hasta alcanzar 9 digitos.');
            return false;
        }
        if (empty($local_email)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_FIELD_EMPTY'));;
            return false;
        }
        if (!filter_var($local_email, FILTER_VALIDATE_EMAIL)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_DOES_NOT_FIT_PATTERN'));
            return false;
        }
        if (empty($local_contact_name)) {
            Session::add('feedback_negative', 'El campo persona de contacto está vacío');
            return false;
        }
        // if name is too short (2), too long (64) or does not fit the pattern (aZ)
        if (!preg_match('/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}$/', $local_contact_name)) {
            Session::add('feedback_negative', 'El campo persona de contacto no se ajusta al patrón: Sólo mayusculas y minusculas y espacios, de 2 a 64 caracteres');
            return false;
        }
        if (empty($local_latitud)) {
            Session::add('feedback_negative', 'El campo Latitud está vacío');
            return false;
        }
        // if phone does not fit the pattern (number decimal(float): max 13 digits, max 10 decimals )
        if (!preg_match('/[0-9]{1,13}\.[0-9]{1,10}/', $local_latitud)) {
            Session::add('feedback_negative', 'El campo Latitud no se ajusta al patrón: numero decimal con máx. 13 digitos y 10 decimales (separado por "punto").');
            return false;
        }
        if (empty($local_longitud)) {
            Session::add('feedback_negative', 'El campo Latitud está vacío');
            return false;
        }
        // if phone does not fit the pattern (number decimal(float): max 13 digits, max 10 decimals )
        if (!preg_match('/[0-9]{1,13}\.[0-9]{1,10}/', $local_longitud)) {
            Session::add('feedback_negative', 'El campo Latitud no se ajusta al patrón: numero decimal con máx. 13 digitos y 10 decimales (separado por "punto").');
            return false;
        }
  }
}
