<?php
class Formulaire{
	private $method;
	private $action;
	private $nom;
	private $style;
	private $formulaireToPrint;
	
	private $ligneComposants = array();
	private $tabComposants = array();
	
	public function __construct($uneMethode, $uneAction , $unNom,$unStyle ){
		$this->method = $uneMethode;
		$this->action =$uneAction;
		$this->nom = $unNom;
		$this->style = $unStyle;
	}
	
	
	public function concactComposants($unComposant , $autreComposant ){
		$unComposant .=  $autreComposant;
		return $unComposant ;
	}
	
	public function ajouterComposantLigne($unComposant){
		$this->ligneComposants[] = $unComposant;
	}

	
	public function ajouterComposantTab(){
		$this->tabComposants[] = $this->ligneComposants;
		$this->ligneComposants = array();
	}
	
	public function creerTitre($unLabel){
	    $composant = "<h1 id='formTitle'>" . $unLabel . "</h1>";
	    return $composant;
	}
	
	public function creerLabel($unLabel){
		$composant = "<label>" . $unLabel . "</label>";
		return $composant;
	}
	
	public function creerMessage($unMessage){
		$composant = "<label class='message'>" . $unMessage . "</label>";
		return $composant;
	}
	
	public function creerRadio($unRadio, $nom, $id, $uneValue){
		$composant = "<input  type ='radio' value='". $uneValue . "' id = '" . $id . "' name = '" .$unRadio. "'/>$nom";
		return $composant;
	}

	public function creerInputDate($unNom, $unId, $required = NULL, $value = NULL) {
		$composant = "<input type='date' id='".$unId."' name='".$unNom."'value='".$value."'  ".$required." >";
		return $composant;
	}

	public function creerInputHidden($unNom, $unId, $uneValue) {
		$composant = "<input type = 'hidden' name = '" . $unNom . "' id = '" . $unId . "'  value = '" . $uneValue . '"';
		return $composant;
	}


	public function creerInputTexte($unNom, $unId, $uneValue , $required , $placeholder , $pattern){
		$composant = "<input type = 'text' name = '" . $unNom . "' id = '" . $unId . "' ";
		if (!empty($uneValue)){
			$composant .= "value = '" . $uneValue . "' ";
		}
		if (!empty($placeholder)){
			$composant .= "placeholder = '" . $placeholder . "' ";
		}
		if ( $required == 1){
			$composant .= "required ";
		}
		if (!empty($pattern)){
			$composant .= $pattern ;
		}
		$composant .= "/>";
		return $composant;
	}
	
	
	public function creerInputMdp($unNom, $unId,  $required = NULL, $placeholder , $pattern){
		$composant = "<input type = 'password' name = '" . $unNom . "' id = '" . $unId . "' ";
		if (!empty($placeholder)){
			$composant .= "placeholder = '" . $placeholder . "' ";
		}
		if ( $required === 1){
			$composant .= "required ";
		}
		if (!empty($pattern)){
			$composant .= "pattern = '" . $pattern . "' ";
		}
		$composant .= "/>";
		return $composant;
	}
	
	public function creerLabelFor($unFor,  $unLabel){
		$composant = "<label for='" . $unFor . "'>" . $unLabel . "</label>";
		return $composant;
	}

    public function creerSelect($unNom, $unId, $unLabel, $options){
        $composant = "<select  name = '" . $unNom . "' id = '" . $unId . "' >";
        foreach ($options as $option){
            $composant .= "<option value = " . $option . ">" . $option . "</option>";
        }
        $composant .= "</select></td></tr>";
        return $composant;
    }
	
	public function creerInputSubmit($unNom, $unId, $uneValue){
		$composant = "<input type = 'submit' name = '" . $unNom . "' id = '" . $unId . "' ";
		$composant .= "value = '" . $uneValue . "'/> ";
		return $composant;
	}

	public function creerInputBoutonRetour($uneValue){
		return "<a href='vues/visiteurs/vueConnexion.php' target='_blank'> <input type='button' value='Retour'> </a>";
	}

	public function creerInputImage($unNom, $unId, $uneSource){
		$composant = "<input type = 'image' name = '" . $unNom . "' id = '" . $unId . "' ";
		$composant .= "src = '" . $uneSource . "'/> ";
		return $composant;
	}
	
	
	public function creerFormulaire(){
		$this->formulaireToPrint = "<form method = '" .  $this->method . "' ";
		$this->formulaireToPrint .= "action = '" .  $this->action . "' ";
		$this->formulaireToPrint .= "name = '" .  $this->nom . "' ";
		$this->formulaireToPrint .= "class = '" .  $this->style . "' >";
		
	
		foreach ($this->tabComposants as $uneLigneComposants){
			$this->formulaireToPrint .= "<div class = 'ligne'>";
			foreach ($uneLigneComposants as $unComposant){
				$this->formulaireToPrint .= $unComposant ;
			}
			$this->formulaireToPrint .= "</div>";
		}
		$this->formulaireToPrint .= "</form>";
		return $this->formulaireToPrint ;
	}
	
	public function afficherFormulaire(){
		echo $this->formulaireToPrint ;
	}
	
}