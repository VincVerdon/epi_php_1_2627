<?php
namespace dao;
use \PDO;
use model\Type;


/**
 * Classe DAO pour persistance des objets Type
 * @author R. Lapadu-Hargues M. Ferlet
 * @version 20261125
 */
class TypeDao extends Dao {
	
    
    /**
     * Retourne la liste de tous les Types
     * @return \model\Type[]
     */
    public function readAll() {
        $liste = array();
        $req='SELECT id, name FROM type';
        $res = $this->connect->query($req);
        while($ligne=$res->fetch(PDO::FETCH_ASSOC)) {
            $liste[]=new Type($ligne['name'], $ligne['id']);
        }
        return $liste;
    }
    
    
    /**
     * Récupère un Type en fonction de son id
     * @param int $id du Type
     * @return NULL|\model\Type
     */
    public function read(int $id) {
		$type = null;
		$req ='SELECT id, name';
		$req .= ' FROM Type';
		$req .= ' WHERE id = :id';
		
		$statement = $this->connect->prepare($req);
		$statement->execute(array(':id' => $id));
		if ($ligne = $statement->fetch(PDO::FETCH_ASSOC)) {
		    $type = new Type($ligne['name'], $ligne['id']);
		}
		return $type;
	}
	
	
	/**
	 * Persistance d'un nouveau Type
	 * @param Type $m à enregistrer
	 */
	public function create(Type $m) {
		$req = 'INSERT INTO Type (name)';
		$req .= 'VALUES (:name)';
		$statement = $this->connect->prepare($req);
		$statement->bindValue(':name', $m->getName());
		$statement->execute();
	}
	
	
	/**
	 * Update Type
	 * @param Type $m à enregistrer
	 */
	public function update(Type $m) {
	    $req = 'UPDATE Type SET name=:name';
	    $req .= 'WHERE id = :id';
	    $statement = $this->connect->prepare($req);
	    $statement->bindValue(':name', $m->getName());
	    $statement->bindValue(':id', $m->getId());
	    $statement->execute();
	}
	
	
	/**
	 * Suppression d'un Type en fonction de son id
	 * @param int $id du Type
	 */
	public function delete(int $id) {
		$req='DELETE FROM Type WHERE id = :id';
		$statement = $this->connect->prepare($req);
		$statement->bindValue(':id', $id);
		$statement->execute();
	}
	
}
?>