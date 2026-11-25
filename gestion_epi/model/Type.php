<?php
namespace model;
/**
 * Classe métier représentant les fabricants (manufacturers)
 * @author R. Lapadu-Hargues M. Ferlet
 * @version 20261125
 */ 
class Type implements \JsonSerializable {
    
    private ?int $id;
    private string $name;
    

    public function __construct(string $name=null, int $id=null) {
        $this->id = $id;
        $this->name = $name;
    }


    /**
     * ToString d'un manufacturer
     * @return string
     */
    public function __toString() {
        return 'name = ' . $this->name;
    }

        
    /**
     * Fournit la représentation JSON d'un manufacturer
     * @see 'JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize() {
        $res = array(
            'id' => $this->id,
            'name' => $this->name,
        );
        return $res;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}

