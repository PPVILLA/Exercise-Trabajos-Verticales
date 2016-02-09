<?php

/**
 * The oeuvre controller: Just an example of simple create, read, update and delete (CRUD) actions.
 */
class OeuvreController extends Controller
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
     * This method controls what happens when you move to /oeuvre/index in your app.
     * Gets all oeuvres (of the user).
     */
    public function index()
    {
        $this->View->render('oeuvre/index', array(
            'oeuvres' => OeuvreModel::getAllOeuvres()
        ));
    }

    /**
     * This method controls what happens when you move to /dashboard/create in your app.
     * Creates a new oeuvre. This is usually the target of form submit actions.
     * POST request.
     */
    public function create()
    {
        OeuvreModel::createOeuvre();
        Redirect::to('oeuvre');
    }

    /**
     * This method controls what happens when you move to /oeuvre/edit(/XX) in your app.
     * Shows the current content of the oeuvre and an editing form.
     * @param $oeuvre_id int id of the oeuvre
     */
    public function edit($oeuvre_id)
    {
        $this->View->render('oeuvre/edit', array(
            'oeuvre' => oeuvreModel::getOeuvre($oeuvre_id)
        ));
    }

    /**
     * This method controls what happens when you move to /oeuvre/editSave in your app.
     * Edits a oeuvre (performs the editing after form submit).
     * POST request.
     */
    public function editSave()
    {
        oeuvreModel::updateOeuvre();
        Redirect::to('oeuvre');
    }

    /**
     * This method controls what happens when you move to /oeuvre/delete(/XX) in your app.
     * Deletes a oeuvre. In a real application a deletion via GET/URL is not recommended, but for demo purposes it's
     * totally okay.
     * @param int $oeuvre_id id of the oeuvre
     */
    public function delete($oeuvre_id)
    {
        OeuvreModel::deleteOeuvre($oeuvre_id);
        Redirect::to('oeuvre');
    }
}
