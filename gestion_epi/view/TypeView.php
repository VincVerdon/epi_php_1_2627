<?php
namespace view;
use model\Type;

/**
 * Classe fournissant les vues pour la gestion des types
 * @author M.Ferlet / R.Lapadu-Hargues
 * @version 20261125
 */
class TypeView extends View {
    
    /**
     * Affichage vue principale de gestion des types
     * Affiche la liste
     * @param array $list
     */
    public function listAll(array $list) {
        $this->getHeader();
        echo '
            <h2>Liste des types</h2>
            <p><a href="?route=types&action=add">Ajouter un type</a></p>
            <table><tr><th>Numero</th><th>Nom</th></tr>
        ';
        foreach ($list as $type)
        {
            echo '<tr>';
            echo '<td>' . $type->getId() . '</td>';
            echo '<td>' . $type->getName() . '</td>';
            echo '<td><a href = "?route=types&action=update&id=' . $type->getId() . '">Modifier</a></td>';
            echo "</tr>\n";
        }
        echo '</table>';
        echo '<p><a href="?route=types&action=add">Ajouter un type</a></p>';
        
        $this->getFooter();
    }
    
    
    /**
     * Affichage formulaire d'ajout d'un type
     */
    public function addForm() {
        $this->getHeader();
        
        echo '<form method="post" action="?route=types&action=add">';
        echo '<p><label id="name">Nom : </label><input type="text" placeholder="Nom du type" name="name" id="name" /></p>';
        echo '<p><input type="submit" value="Envoyer" /><input type="reset" value="Annuler" /></p>';
        echo "</form>\n";
        
        $this->getFooter();
    }
    
    
    /**
     * Affichage formulaire d'update d'un type
     * @param Type $t
     */
    public function updateForm(Type $t) {
        $this->getHeader();
        
        echo '<form method="post" action="?route=types&action=update">';
        echo '<p><label id="id">Id : </label><input type="text" value="' . $t->getId() . '" name="id" id="id" readonly="readonly"/></p>';
        echo '<p><label id="name">Nom : </label><input type="text" value="' . $t->getName() . '" name="name" id="name" /></p>';
        echo '<p><input type="submit" value="Envoyer" /><input type="reset" value="Annuler" /></p>';
        echo "</form>\n";
        
        $this->getFooter();
    }
}

