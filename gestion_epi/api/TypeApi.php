<?php
namespace api;
use dao\TypeDao;
use model\Type;

/**
 * API REST proposant l'accès aux types
 * @author R. Lapadu-Hargues M. Ferlet
 * @version 20261125
 */
class TypeApi extends Api {
    
    /**
     * Constructeur classe TypeApi
     * Sert de routeur pour les différentes actions
     * En fonction de la méthode et des options
     */
    public function __construct() {
        
        //Appel constructeur classe mère Api
        parent::__construct();
        
        /**
         * l'option doit être un id. On tente la transformation
         * @warning Code sensible aux attaques
         * @todo Attention prévoir de protéger le code des injections !
         */
        $id = (int) $this->option;
        
        //we decide what to do with the request
        if ($this->method=='GET' && $this->option=='') {
            $this->listAll();
        } elseif ($this->method=='GET' && $id!=0) {
                $this->listOne($id);
        } elseif ($this->method=='POST') {
            $this->addOne();
        } elseif ($this->method=='PUT') {
            $this->updateOne($id);
        } elseif ($this->method=='DELETE') {
            $this->deleteOne($id);
        } else {
            new ErrorApi();
        }
    }
    
    /**
     * Fournit la liste des Types
     */
    public function listAll() {
        $dao = new TypeDao();
        $Types_list = $dao->readAll();
        $json = json_encode($Types_list);
        header("Content-Type: application/json");
        echo $json;
    }
    
    /**
     * Fournit un Types en fonction de son id
     * @param int $id du Type
     */
    public function listOne(int $id) {
        $dao = new TypeDao();
        $Type = $dao->read($id);
        if ($Type != null) {
            $json = json_encode($Type);
            header("Content-Type: application/json");
            echo $json;
        } else {
            //no result found
            new ErrorApi();
        }
    }
    
    
    /**
     * Traite les données reçues pour créer un nouveau Type
     */
    public function addOne() {
        $man = new Type($this->data['name']);
        $dao = new TypeDao();
        $dao->create($man);
    }
    
    /**
     * Supprime un Type en fonction de son id reçu
     * @param int $id du Type
     */
    public function deleteOne(int $id) {
        $dao = new TypeDao();
        $result = $dao->delete($id);
    }
    
    /**
     * Update un Type en fonction de son id reçu
     * @param int $id du Type
     */
    public function updateOne(int $id) {
        $dao = new TypeDao();
        $man = new Type($this->data['name'], $id);
        $man = $dao->update($man);
    }
    
}
