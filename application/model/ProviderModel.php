<?php

class ProviderModel
{
    /**
     * Get all providers
     * @return array an array with several objects (the results)
     */
    public static function getAllProviders()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT provider_id, provider_CIF, provider_name, provider_address, provider_city_id, provider_phone,
                       provider_email, provider_url, provider_contact_name, provider_latitud, provider_longitud
                FROM providers WHERE user_id = :user_id ";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id')));

        $all_providers = array();

        foreach ($query->fetchAll() as $provider) {

            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the provider's values
            array_walk_recursive($provider, 'Filter::XSSFilter');

            $all_providers[$provider->provider_id] = new stdClass();
            $all_providers[$provider->provider_id]->provider_id = $provider->provider_id;
            $all_providers[$provider->provider_id]->provider_CIF = $provider->provider_CIF;
            $all_providers[$provider->provider_id]->provider_name = $provider->provider_name;
            $all_providers[$provider->provider_id]->provider_address = $provider->provider_address;
            $all_providers[$provider->provider_id]->provider_city_id = $provider->provider_city_id;
            $all_providers[$provider->provider_id]->provider_phone = $provider->provider_phone;
            $all_providers[$provider->provider_id]->provider_email = $provider->provider_email;
            $all_providers[$provider->provider_id]->provider_url = $provider->provider_url;
            $all_providers[$provider->provider_id]->provider_contact_name = $provider->provider_contact_name;
            $all_providers[$provider->provider_id]->provider_latitud = $provider->provider_latitud;
            $all_providers[$provider->provider_id]->provider_longitud = $provider->provider_longitud;
        }

        return $all_providers;
    }

    /**
     * Get a single note
     * @param int $provider_id id of the specific provider
     * @return object a single object (the result)
     */
    public static function getProvider($provider_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT provider_id, provider_CIF, provider_name, provider_address, provider_city_id, provider_phone,
                       provider_email, provider_url, provider_contact_name, provider_latitud, provider_longitud
                   FROM providers WHERE provider_id = :provider_id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id'), ':provider_id' => $provider_id));

        // fetch() is the PDO method that gets a single result
        return $query->fetch();
    }

    /**
     * Set a provider (create a new one)
     * @return boolean Gives back the success status of the registration of the provider
     */
    public static function createProvider()
    {
        // clean the input
        $provider_CIF = strip_tags(Request::post('provider_CIF', true));
        $provider_name = strip_tags(Request::post('provider_name', true));
        $provider_address = strip_tags(Request::post('provider_address', true));
        $provider_city_id = strip_tags(Request::post('provider_city_id', true));
        $provider_phone = strip_tags(Request::post('provider_phone', true));
        $provider_email = strip_tags(Request::post('provider_email', true));
        $provider_url = strip_tags(Request::post('provider_url', true));
        $provider_contact_name = strip_tags(Request::post('provider_contact_name', true));
        $provider_latitud = strip_tags(Request::post('provider_latitud', true));
        $provider_longitud = strip_tags(Request::post('provider_longitud', true));

        $validation_result = self::registrationInputValidation($provider_CIF, $provider_name, $provider_address, $provider_city_id, $provider_phone, $provider_email, $provider_url, $provider_contact_name, $provider_latitud, $provider_longitud);
        if (!$validation_result) {
          return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO providers (provider_CIF, provider_name, provider_address, provider_city_id, provider_phone, provider_email,
                      provider_url, provider_contact_name, provider_latitud, provider_longitud, user_id)
                    VALUES (:provider_CIF, :provider_name, :provider_address, :provider_city_id, :provider_phone, :provider_email,
                      :provider_url, :provider_contact_name, :provider_latitud, :provider_longitud, :user_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':provider_CIF' => $provider_CIF,
                              ':provider_name' => $provider_name,
                              ':provider_address' => $provider_address,
                              ':provider_city_id' => $provider_city_id,
                              ':provider_phone' => $provider_phone,
                              ':provider_email' => $provider_email,
                              ':provider_url' => $provider_url,
                              ':provider_contact_name' => $provider_contact_name,
                              ':provider_latitud' => $provider_latitud,
                              ':provider_longitud' => $provider_longitud,
                              ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_PROVIDER_CREATION_FAILED'));
        return false;
    }

    /**
     * Update an existing provider
     * @return bool feedback (was the update successful ?)
     */
    public static function updateProvider()
    {
        // clean the input
        $provider_id = Request::post('provider_id');
        $provider_CIF = strip_tags(Request::post('provider_CIF', true));
        $provider_name = strip_tags(Request::post('provider_name', true));
        $provider_address = strip_tags(Request::post('provider_address', true));
        $provider_city_id = strip_tags(Request::post('provider_city_id', true));
        $provider_phone = strip_tags(Request::post('provider_phone', true));
        $provider_email = strip_tags(Request::post('provider_email', true));
        $provider_url = strip_tags(Request::post('provider_url', true));
        $provider_contact_name = strip_tags(Request::post('provider_contact_name', true));
        $provider_latitud = strip_tags(Request::post('provider_latitud', true));
        $provider_longitud = strip_tags(Request::post('provider_longitud', true));

        $validation_result = self::registrationInputValidation($provider_CIF, $provider_name, $provider_address, $provider_city_id, $provider_phone, $provider_email, $provider_url, $provider_contact_name, $provider_latitud, $provider_longitud);
        if (!$validation_result) {
          return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE providers
                SET provider_CIF = :provider_CIF, provider_name = :provider_name, provider_address = :provider_address, provider_city_id = :provider_city_id,
                   provider_phone = :provider_phone, provider_email = :provider_email, provider_url = :provider_url, provider_contact_name = :provider_contact_name,
                    provider_latitud = :provider_latitud, provider_longitud = :provider_longitud
                WHERE provider_id = :provider_id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':provider_CIF' => $provider_CIF,
                              ':provider_name' => $provider_name,
                              ':provider_address' => $provider_address,
                              ':provider_city_id' => $provider_city_id,
                              ':provider_phone' => $provider_phone,
                              ':provider_email' => $provider_email,
                              ':provider_url' => $provider_url,
                              ':provider_contact_name' => $provider_contact_name,
                              ':provider_latitud' => $provider_latitud,
                              ':provider_longitud' => $provider_longitud,
                              ':provider_id' => $provider_id,
                              ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PROVIDER_EDITING_FAILED'));
        return false;
    }

    /**
     * Delete a specific note
     * @param int $provider_id id of the note
     * @return bool feedback (was the note deleted properly ?)
     */
    public static function deleteProvider($provider_id)
    {
        if (!$provider_id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM providers WHERE provider_id = :provider_id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':provider_id' => $provider_id, ':user_id' => Session::get('user_id')));

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
   * @param $provider_CIF
   * @param $provider_name
   * @param $provider_address
   * @param $provider_city_id
   * @param $provider_phone
   * @param $provider_email
   * @param $provider_url
   * @param $provider_contact_name
   * @param $provider_latitud
   * @param $provider_longitud
   *
   * @return bool
   */
  public static function registrationInputValidation($provider_CIF, $provider_name, $provider_address, $provider_city_id, $provider_phone, $provider_email, $provider_url, $provider_contact_name, $provider_latitud, $provider_longitud)
  {
        return true;

        if (empty($provider_CIF)) {
            Session::add('feedback_negative', 'El campo Nombre está vacío');
            return false;
        }
        // if name is too short (2), too long (64) or does not fit the pattern (aZ)
        if (!preg_match('/^[A-Z][0-9]{8,8}$/', $provider_CIF)) {
            Session::add('feedback_negative', 'El campo CIF no se ajusta al patrón: una letra mayuscula y 8 digitos');
            return false;
        }
        if (empty($provider_name)) {
            Session::add('feedback_negative', 'El campo Nombre está vacío');
            return false;
        }
        // if name is too short (2), too long (64) or does not fit the pattern (aZ)
        if (!preg_match('/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}$/', $provider_name)) {
            Session::add('feedback_negative', 'El campo Nombre no se ajusta al patrón: Sólo mayusculas y minusculas y espacios, de 2 a 64 caracteres');
            return false;
        }
        if (empty($provider_address)) {
            Session::add('feedback_negative', 'El campo Direccion está vacío');
            return false;
        }
        // if name is too short (2), too long (64) or does not fit the pattern (aZ)
        if (!preg_match('/^[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s,]{2,64}$/', $provider_address)) {
            Session::add('feedback_negative', 'El campo Direccion no se ajusta al patrón: Sólo mayusculas, minusculas, numeros, espacios comas y guiones, de 2 a 64 caracteres');
            return false;
        }

        if (empty($provider_city_id)) {
            Session::add('feedback_negative', 'El campo Poblacion está vacío');
            return false;
        }
        // if name is too short (2), too long (64) or does not fit the pattern (aZ)
        if (!preg_match('/^[0-9A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}$/', $provider_city_id)) {
            Session::add('feedback_negative', 'El campo Poblacion no se ajusta al patrón: Sólo mayusculas y minusculas y espacios, de 2 a 64 caracteres');
            return false;
        }
        if (empty($provider_phone)) {
            Session::add('feedback_negative', 'El campo Telefono está vacío');
            return false;
        }
        // if phone does not fit the pattern (+34923456789 +34 923456789 923456789 +34623456789+34 623456789 623456789)
        if (!preg_match('/^(\+34\s?)([9|6][0-9]{8})$|^([9|6][0-9]{8})$/', $provider_phone)) {
            Session::add('feedback_negative', 'El campo Telefono no se ajusta al patrón: opcional empezar por +34 seguido de un espacio o sin él. Luego el nº telefono debe de empezar por 9 o por 6 hasta alcanzar 9 digitos.');
            return false;
        }
        if (empty($provider_email)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_FIELD_EMPTY'));;
            return false;
        }
        if (!filter_var($provider_email, FILTER_VALIDATE_EMAIL)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_DOES_NOT_FIT_PATTERN'));
            return false;
        }
        if (empty($provider_url)) {
            Session::add('feedback_negative', 'El campo direccion web está vacío');
            return false;
        }
        // if name is too short (2), too long (64) or does not fit the pattern (aZ)
        if (!preg_match('/^[\w\s]{2,64}$/', $provider_url)) {
            Session::add('feedback_negative', 'El campo direccion web no se ajusta al patrón, de 2 a 64 caracteres');
            return false;
        }if (empty($provider_contact_name)) {
            Session::add('feedback_negative', 'El campo persona de contacto está vacío');
            return false;
        }
        // if name is too short (2), too long (64) or does not fit the pattern (aZ)
        if (!preg_match('/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}$/', $provider_contact_name)) {
            Session::add('feedback_negative', 'El campo persona de contacto no se ajusta al patrón: Sólo mayusculas y minusculas y espacios, de 2 a 64 caracteres');
            return false;
        }
        if (empty($provider_latitud)) {
            Session::add('feedback_negative', 'El campo Latitud está vacío');
            return false;
        }
        // if phone does not fit the pattern (number decimal(float): max 13 digits, max 10 decimals )
        if (!preg_match('/[0-9]{1,13}\.[0-9]{1,10}/', $provider_latitud)) {
            Session::add('feedback_negative', 'El campo Latitud no se ajusta al patrón: numero decimal con máx. 13 digitos y 10 decimales (separado por "punto").');
            return false;
        }
        if (empty($provider_longitud)) {
            Session::add('feedback_negative', 'El campo Latitud está vacío');
            return false;
        }
        // if phone does not fit the pattern (number decimal(float): max 13 digits, max 10 decimals )
        if (!preg_match('/[0-9]{1,13}\.[0-9]{1,10}/', $provider_longitud)) {
            Session::add('feedback_negative', 'El campo Latitud no se ajusta al patrón: numero decimal con máx. 13 digitos y 10 decimales (separado por "punto").');
            return false;
        }
  }
}
