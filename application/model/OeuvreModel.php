<?php

class OeuvreModel
{
    /**
     * Get all oeuvres
     * @return array an array with several objects (the results)
     */
    public static function getAllOeuvres()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT oeuvre_id, oeuvre_budget, oeuvre_name, oeuvre_address, oeuvre_province, oeuvre_city_id, oeuvre_phone,
                       oeuvre_email, oeuvre_contact_name, oeuvre_latitud, oeuvre_longitud, user_id, oeuvre_startDate, oeuvre_completionDate
                FROM oeuvres ";
        $query = $database->prepare($sql);
        $query->execute();

        $all_oeuvres = array();

        foreach ($query->fetchAll() as $oeuvre) {

            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the oeuvre's values
            array_walk_recursive($oeuvre, 'Filter::XSSFilter');

            $all_oeuvres[$oeuvre->oeuvre_id] = new stdClass();
            $all_oeuvres[$oeuvre->oeuvre_id]->oeuvre_id = $oeuvre->oeuvre_id;
            $all_oeuvres[$oeuvre->oeuvre_id]->oeuvre_budget = $oeuvre->oeuvre_budget;
            $all_oeuvres[$oeuvre->oeuvre_id]->oeuvre_name = $oeuvre->oeuvre_name;
            $all_oeuvres[$oeuvre->oeuvre_id]->oeuvre_address = $oeuvre->oeuvre_address;
            $all_oeuvres[$oeuvre->oeuvre_id]->oeuvre_province = $oeuvre->oeuvre_province;
            $all_oeuvres[$oeuvre->oeuvre_id]->oeuvre_city_id = $oeuvre->oeuvre_city_id;
            $all_oeuvres[$oeuvre->oeuvre_id]->oeuvre_phone = $oeuvre->oeuvre_phone;
            $all_oeuvres[$oeuvre->oeuvre_id]->oeuvre_email = $oeuvre->oeuvre_email;
            $all_oeuvres[$oeuvre->oeuvre_id]->oeuvre_contact_name = $oeuvre->oeuvre_contact_name;
            $all_oeuvres[$oeuvre->oeuvre_id]->oeuvre_latitud = $oeuvre->oeuvre_latitud;
            $all_oeuvres[$oeuvre->oeuvre_id]->oeuvre_longitud = $oeuvre->oeuvre_longitud;
            $all_oeuvres[$oeuvre->oeuvre_id]->user_id = $oeuvre->user_id;
            $all_oeuvres[$oeuvre->oeuvre_id]->oeuvre_startDate = $oeuvre->oeuvre_startDate;
            $all_oeuvres[$oeuvre->oeuvre_id]->oeuvre_completionDate = $oeuvre->oeuvre_completionDate;
        }

        return $all_oeuvres;
    }

    /**
     * Get a single note
     * @param int $oeuvre_id id of the specific oeuvre
     * @return object a single object (the result)
     */
    public static function getOeuvre($oeuvre_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT oeuvre_id, oeuvre_budget, oeuvre_name, oeuvre_address, oeuvre_province, oeuvre_city_id, oeuvre_phone,
                       oeuvre_email, oeuvre_contact_name, oeuvre_latitud, oeuvre_longitud, user_id, oeuvre_startDate, oeuvre_completionDate
                   FROM oeuvres WHERE oeuvre_id = :oeuvre_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':oeuvre_id' => $oeuvre_id));

        // fetch() is the PDO method that gets a single result
        return $query->fetch();
    }

    /**
     * Set a oeuvre (create a new one)
     * @return boolean Gives back the success status of the registration of the oeuvre
     */
    public static function createOeuvre()
    {
        // clean the input
        $user_id = Request::post('user_id');
        $oeuvre_budget = strip_tags(Request::post('oeuvre_budget', true));
        $oeuvre_name = strip_tags(Request::post('oeuvre_name', true));
        $oeuvre_address = strip_tags(Request::post('oeuvre_address', true));
        $oeuvre_province = strip_tags(Request::post('oeuvre_province', true));
        $oeuvre_city_id = strip_tags(Request::post('oeuvre_city_id', true));
        $oeuvre_phone = strip_tags(Request::post('oeuvre_phone', true));
        $oeuvre_email = strip_tags(Request::post('oeuvre_email', true));
        $oeuvre_contact_name = strip_tags(Request::post('oeuvre_contact_name', true));
        $oeuvre_latitud = strip_tags(Request::post('oeuvre_latitud', true));
        $oeuvre_longitud = strip_tags(Request::post('oeuvre_longitud', true));
        $oeuvre_startDate = strip_tags(Request::post('oeuvre_startDate', true));
        $oeuvre_completionDate = strip_tags(Request::post('oeuvre_completionDate', true));

        $validation_result = self::registrationInputValidation($oeuvre_budget, $oeuvre_name, $oeuvre_address, $oeuvre_province, $oeuvre_city_id, $oeuvre_phone, $oeuvre_email, $oeuvre_contact_name, $oeuvre_latitud, $oeuvre_longitud, $oeuvre_startDate, $oeuvre_completionDate);
        if (!$validation_result) {
          return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO oeuvres (oeuvre_budget, oeuvre_name, oeuvre_address, oeuvre_province, oeuvre_city_id, oeuvre_phone, oeuvre_email,
                       oeuvre_contact_name, oeuvre_latitud, oeuvre_longitud, oeuvre_startDate, oeuvre_completionDate, user_id)
                    VALUES (:oeuvre_budget, :oeuvre_name, :oeuvre_address, :oeuvre_province, :oeuvre_city_id, :oeuvre_phone, :oeuvre_email,
                       :oeuvre_contact_name, :oeuvre_latitud, :oeuvre_longitud, :oeuvre_startDate, :oeuvre_completionDate, :user_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':oeuvre_budget' => $oeuvre_budget,
                              ':oeuvre_name' => $oeuvre_name,
                              ':oeuvre_address' => $oeuvre_address,
                              ':oeuvre_province' => $oeuvre_province,
                              ':oeuvre_city_id' => $oeuvre_city_id,
                              ':oeuvre_phone' => $oeuvre_phone,
                              ':oeuvre_email' => $oeuvre_email,
                              ':oeuvre_contact_name' => $oeuvre_contact_name,
                              ':oeuvre_latitud' => $oeuvre_latitud,
                              ':oeuvre_longitud' => $oeuvre_longitud,
                              ':oeuvre_startDate' => $oeuvre_startDate,
                              ':oeuvre_completionDate' => $oeuvre_completionDate,
                              ':user_id' => $user_id));

        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_PROVIDER_CREATION_FAILED'));
        return false;
    }

    /**
     * Update an existing oeuvre
     * @return bool feedback (was the update successful ?)
     */
    public static function updateOeuvre()
    {
        // clean the input
        $user_id = Request::post('user_id');
        $oeuvre_id = Request::post('oeuvre_id');
        $oeuvre_budget = strip_tags(Request::post('oeuvre_budget', true));
        $oeuvre_name = strip_tags(Request::post('oeuvre_name', true));
        $oeuvre_address = strip_tags(Request::post('oeuvre_address', true));
        $oeuvre_province = strip_tags(Request::post('oeuvre_province', true));
        $oeuvre_city_id = strip_tags(Request::post('oeuvre_city_id', true));
        $oeuvre_phone = strip_tags(Request::post('oeuvre_phone', true));
        $oeuvre_email = strip_tags(Request::post('oeuvre_email', true));
        $oeuvre_contact_name = strip_tags(Request::post('oeuvre_contact_name', true));
        $oeuvre_latitud = strip_tags(Request::post('oeuvre_latitud', true));
        $oeuvre_longitud = strip_tags(Request::post('oeuvre_longitud', true));
        $oeuvre_startDate = strip_tags(Request::post('oeuvre_startDate', true));
        $oeuvre_completionDate = strip_tags(Request::post('oeuvre_completionDate', true));

        $validation_result = self::registrationInputValidation($oeuvre_budget, $oeuvre_name, $oeuvre_address, $oeuvre_province, $oeuvre_city_id, $oeuvre_phone, $oeuvre_email, $oeuvre_contact_name, $oeuvre_latitud, $oeuvre_longitud, $oeuvre_startDate, $oeuvre_completionDate);
        if (!$validation_result) {
          return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE oeuvres
                SET oeuvre_budget = :oeuvre_budget, oeuvre_name = :oeuvre_name, oeuvre_address = :oeuvre_address, oeuvre_province = :oeuvre_province, oeuvre_city_id = :oeuvre_city_id,
                   oeuvre_phone = :oeuvre_phone, oeuvre_email = :oeuvre_email, oeuvre_contact_name = :oeuvre_contact_name,
                    oeuvre_latitud = :oeuvre_latitud, oeuvre_longitud = :oeuvre_longitud, oeuvre_startDate = :oeuvre_startDate, oeuvre_completionDate = :oeuvre_completionDate, user_id = :user_id
                WHERE oeuvre_id = :oeuvre_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':oeuvre_budget' => $oeuvre_budget,
                              ':oeuvre_name' => $oeuvre_name,
                              ':oeuvre_address' => $oeuvre_address,
                              ':oeuvre_province' => $oeuvre_province,
                              ':oeuvre_city_id' => $oeuvre_city_id,
                              ':oeuvre_phone' => $oeuvre_phone,
                              ':oeuvre_email' => $oeuvre_email,
                              ':oeuvre_contact_name' => $oeuvre_contact_name,
                              ':oeuvre_latitud' => $oeuvre_latitud,
                              ':oeuvre_longitud' => $oeuvre_longitud,
                              ':oeuvre_startDate' => $oeuvre_startDate,
                              ':oeuvre_completionDate' => $oeuvre_completionDate,
                              ':oeuvre_id' => $oeuvre_id,
                              ':user_id' => $user_id));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PROVIDER_EDITING_FAILED'));
        return false;
    }

    /**
     * Delete a specific note
     * @param int $oeuvre_id id of the note
     * @return bool feedback (was the note deleted properly ?)
     */
    public static function deleteOeuvre($oeuvre_id)
    {
        if (!$oeuvre_id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM oeuvres WHERE oeuvre_id = :oeuvre_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':oeuvre_id' => $oeuvre_id));

        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_PROVIDER_DELETION_FAILED'));
        return false;
    }

    /**
   * Validates registration of other inputs
   *
   * @param $oeuvre_budget
   * @param $oeuvre_name
   * @param $oeuvre_address
   * @param $oeuvre_city_id
   * @param $oeuvre_phone
   * @param $oeuvre_email
   * @param $oeuvre_contact_name
   * @param $oeuvre_latitud
   * @param $oeuvre_longitud
   *
   * @return bool
   */
  public static function registrationInputValidation($oeuvre_budget, $oeuvre_name, $oeuvre_address, $oeuvre_province, $oeuvre_city_id, $oeuvre_phone, $oeuvre_email, $oeuvre_contact_name, $oeuvre_latitud, $oeuvre_longitud, $oeuvre_startDate, $oeuvre_completionDate)
  {
        return true;

        if (empty($oeuvre_budget)) {
            Session::add('feedback_negative', 'El campo presupuesto está vacío');
            return false;
        }

        if (!preg_match('/[0-9]{1,6}\.[0-9]{1,2}/', $oeuvre_budget)) {
            Session::add('feedback_negative', 'El campo presupuesto no se ajusta al patrón: numero decimal con máx. 6 digitos y 2 decimales (separado por "punto").');
            return false;
        }
        if (empty($oeuvre_name)) {
            Session::add('feedback_negative', 'El campo Nombre está vacío');
            return false;
        }

        if (!preg_match('/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}$/', $oeuvre_name)) {
            Session::add('feedback_negative', 'El campo Nombre no se ajusta al patrón: Sólo mayusculas y minusculas y espacios, de 2 a 64 caracteres');
            return false;
        }
        if (empty($oeuvre_address)) {
            Session::add('feedback_negative', 'El campo Direccion está vacío');
            return false;
        }

        if (!preg_match('/^[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s,]{2,64}$/', $oeuvre_address)) {
            Session::add('feedback_negative', 'El campo Direccion no se ajusta al patrón: Sólo mayusculas, minusculas, numeros, espacios comas y guiones, de 2 a 64 caracteres');
            return false;
        }

        if (empty($oeuvre_province)) {
            Session::add('feedback_negative', 'El campo Provincia está vacío');
            return false;
        }

        if (!preg_match('/[A-Za-záéíóúÁÉÍÓÚñÑ\.\/\s,-]{2,64}/', $oeuvre_province)) {
            Session::add('feedback_negative', 'El campo Provincia no se ajusta al patrón: Sólo mayusculas y minusculas y espacios, de 2 a 64 caracteres');
            return false;
        }

        if (empty($oeuvre_city_id)) {
            Session::add('feedback_negative', 'El campo Poblacion está vacío');
            return false;
        }

        if (!preg_match('/^[0-9A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}$/', $oeuvre_city_id)) {
            Session::add('feedback_negative', 'El campo Poblacion no se ajusta al patrón: Sólo mayusculas y minusculas y espacios, de 2 a 64 caracteres');
            return false;
        }
        if (empty($oeuvre_phone)) {
            Session::add('feedback_negative', 'El campo Telefono está vacío');
            return false;
        }
        // if phone does not fit the pattern (+34923456789 +34 923456789 923456789 +34623456789+34 623456789 623456789)
        if (!preg_match('/^([9|6][0-9]{8})$/', $oeuvre_phone)) {
            Session::add('feedback_negative', 'el nº telefono debe de empezar por 9 o por 6 hasta alcanzar 9 digitos.');
            return false;
        }
        if (empty($oeuvre_email)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_FIELD_EMPTY'));;
            return false;
        }
        if (!filter_var($oeuvre_email, FILTER_VALIDATE_EMAIL)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_DOES_NOT_FIT_PATTERN'));
            return false;
        }

        if (empty($oeuvre_contact_name)) {
            Session::add('feedback_negative', 'El campo persona de contacto está vacío');
            return false;
        }

        if (!preg_match('/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}$/', $oeuvre_contact_name)) {
            Session::add('feedback_negative', 'El campo persona de contacto no se ajusta al patrón: Sólo mayusculas y minusculas y espacios, de 2 a 64 caracteres');
            return false;
        }
        if (empty($oeuvre_latitud)) {
            Session::add('feedback_negative', 'El campo Latitud está vacío');
            return false;
        }
        // if phone does not fit the pattern (number decimal(float): max 13 digits, max 10 decimals )
        if (!preg_match('/[0-9]{1,13}\.[0-9]{1,10}/', $oeuvre_latitud)) {
            Session::add('feedback_negative', 'El campo Latitud no se ajusta al patrón: numero decimal con máx. 13 digitos y 10 decimales (separado por "punto").');
            return false;
        }
        if (empty($oeuvre_longitud)) {
            Session::add('feedback_negative', 'El campo Latitud está vacío');
            return false;
        }
        // if phone does not fit the pattern (number decimal(float): max 13 digits, max 10 decimals )
        if (!preg_match('/[0-9]{1,13}\.[0-9]{1,10}/', $oeuvre_longitud)) {
            Session::add('feedback_negative', 'El campo Latitud no se ajusta al patrón: numero decimal con máx. 13 digitos y 10 decimales (separado por "punto").');
            return false;
        }

        if (empty($oeuvre_startDate)){
            Session::add('feedback_negative', 'El campo Fecha Inicio Obra está vacío');
            return false;
        }

        if (!preg_match('/(\d{4})(-)([0][1-9]|[1][0-2])\2([0][1-9]|[12][0-9]|3[01])/', $oeuvre_startDate)) {
            Session::add('feedback_negative', 'El campo Fecha Inicio Obra no se ajusta al patrón de fecha AAAA/MM/DD');
            return false;
        }

        if (empty($oeuvre_completionDate)){
            Session::add('feedback_negative', 'El campo Fecha Finalización Obra está vacío');
            return false;
        }

        if (!preg_match('/(\d{4})(-)([0][1-9]|[1][0-2])\2([0][1-9]|[12][0-9]|3[01])/', $oeuvre_completionDate)) {
            Session::add('feedback_negative', 'El campo Fecha Finalización Obra no se ajusta al patrón de fecha AAAA/MM/DD');
            return false;
        }
  }
}
