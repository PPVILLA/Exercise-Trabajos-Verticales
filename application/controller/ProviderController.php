<?php

/**
 * The provider controller: Just an example of simple create, read, update and delete (CRUD) actions.
 */
class ProviderController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        // special authentication check for the entire controller: Note the check-ADMIN-authentication!
        // All methods inside this controller are only accessible for admins (= users that have role type 7)
        Auth::checkAdminAuthentication();
    }

    /**
     * This method controls what happens when you move to /provider/index in your app.
     * Gets all providers (of the user).
     */
    public function index()
    {
        $this->View->render('provider/index', array(
            'providers' => ProviderModel::getAllProviders()
        ));
    }

    /**
     * This method controls what happens when you move to /dashboard/create in your app.
     * Creates a new provider. This is usually the target of form submit actions.
     * POST request.
     */
    public function create()
    {
        ProviderModel::createProvider();
        Redirect::to('provider');
    }

    /**
     * This method controls what happens when you move to /provider/edit(/XX) in your app.
     * Shows the current content of the provider and an editing form.
     * @param $provider_id int id of the provider
     */
    public function edit($provider_id)
    {
        $this->View->render('provider/edit', array(
            'provider' => providerModel::getProvider($provider_id)
        ));
    }

    /**
     * This method controls what happens when you move to /provider/editSave in your app.
     * Edits a provider (performs the editing after form submit).
     * POST request.
     */
    public function editSave()
    {
        providerModel::updateProvider();
        Redirect::to('provider');
    }

    /**
     * This method controls what happens when you move to /provider/delete(/XX) in your app.
     * Deletes a provider. In a real application a deletion via GET/URL is not recommended, but for demo purposes it's
     * totally okay.
     * @param int $provider_id id of the provider
     */
    public function delete($provider_id)
    {
        ProviderModel::deleteProvider($provider_id);
        Redirect::to('provider');
    }
}
