<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checkAuthentication(); in line 16)
 */
class DashboardController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        // this entire controller should only be visible/usable by logged in users, so we put authentication-check here
        Auth::checkAuthentication();
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    public function index($pageToShow = 0)
    {
      $page = false;
      if(isset($_POST['suggestion'])){
        $suggestion = $_POST['suggestion'];
      }else{
        $suggestion='';
      }
      if(isset($pageToShow)){
        $page = $pageToShow;
      }
      if(isset($_POST['itemsToShow'])){
        $itemsToShow = $_POST['itemsToShow'];
      }else{
        $itemsToShow = 3;
      }
      if(isset($_POST['orderBy'])){
        $orderBy = $_POST['orderBy'];
      }else{
        $orderBy = 'material_id';
      }
      if(!$page){
        $start = 0;
        $page = 1;
      }else{
        $start = ($page - 1) * $itemsToShow;
      }
      $numTotalRegister = MaterialModel::getNumRowAllMaterialsSuggested($suggestion);
      $totalPages = ceil($numTotalRegister / $itemsToShow);
      $this->View->render('dashboard/index', array(
          'totalPages' => $totalPages,
          'page' => $page,
          'suggestion' => $suggestion,
          'itemsToShow' => $itemsToShow,
          'orderBy' => $orderBy,
          'oeuvres' => OeuvreModel::getAllOeuvreByEmployee(Session::get('user_id')),
          'oeuvres_materials' => DashboardModel::getAllOeuvreMaterials(),
          'materials' => MaterialModel::getMaterialsSuggestedPaginatedOrderBy($suggestion, $start, $itemsToShow, $orderBy)
      ));
    }

    public function addSelect()
    {
        if(empty($_POST['check_list_Material']) || empty($_POST['oeuvre_id'])){
          Session::add('feedback_negative', 'Tiene que escoger una de tus obras y seleccionar algún material');
          Redirect::to('dashboard/index/ /0/3/material_id');
        }else{
          $arrayIdMaterial = $_POST['check_list_Material'];
          $oeuvre_id = $_POST['oeuvre_id'];
          foreach($arrayIdMaterial as $value){
            DashboardModel::addMaterialToOeuvre($oeuvre_id, $value);
          }
          Session::add('feedback_positive', 'Se ha añadido correctamente en tu obra señalada los materiales señalados');
          Redirect::to('dashboard/index/ /0/3/material_id');
        }
    }

    public function delete($oeuvreMaterial_id, $material_id)
    {
        DashboardModel::deleteMaterialOeuvre($material_id, $oeuvreMaterial_id);
        Redirect::to('dashboard/index/ /0/3/material_id');
    }


    public function deleteSelect()
    {
        $idArray = $_POST['check_list_MaterialOeuvres'];
        $oeuvreMaterial_id = $_POST['oeuvreMaterial_id'];
        foreach($idArray as $material_id){
          DashboardModel::deleteMaterialOeuvre($material_id, $oeuvreMaterial_id);
        }
        Redirect::to('dashboard/index/ /0/3/material_id');
    }

    public function addQuantity($oeuvre_id, $material_id)
    {
          $quantity = $_POST['quantity'];
          DashboardModel::updateQuantityMaterialOeuvre($oeuvre_id, $material_id, $quantity);
          Redirect::to('dashboard/index/ /0/3/material_id');
    }

}
