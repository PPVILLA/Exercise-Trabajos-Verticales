<?php

/**
 * The local controller: Just an example of simple create, read, update and delete (CRUD) actions.
 */
class LocalController extends Controller
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
     * This method controls what happens when you move to /local/index in your app.
     * Gets all locals (of the user).
     */
    public function index()
    {
        $this->View->render('local/index', array(
            'locals' => LocalModel::getAllLocals()
        ));
    }

    /**
     * This method controls what happens when you move to /dashboard/create in your app.
     * Creates a new local. This is usually the target of form submit actions.
     * POST request.
     */
    public function create()
    {
        LocalModel::createLocal();
        Redirect::to('local');
    }

    /**
     * This method controls what happens when you move to /local/edit(/XX) in your app.
     * Shows the current content of the local and an editing form.
     * @param $local_id int id of the local
     */
    public function edit($local_id)
    {
        $this->View->render('local/edit', array(
            'local' => localModel::getLocal($local_id)
        ));
    }

    /**
     * This method controls what happens when you move to /local/editSave in your app.
     * Edits a local (performs the editing after form submit).
     * POST request.
     */
    public function editSave()
    {
        localModel::updateLocal();
        Redirect::to('local');
    }

    /**
     * This method controls what happens when you move to /local/delete(/XX) in your app.
     * Deletes a local. In a real application a deletion via GET/URL is not recommended, but for demo purposes it's
     * totally okay.
     * @param int $local_id id of the local
     */
    public function delete($local_id)
    {
        LocalModel::deleteLocal($local_id);
        Redirect::to('local');
    }
}
