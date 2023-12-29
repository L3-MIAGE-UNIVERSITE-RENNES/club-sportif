<?php
class LicencieDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    public function create(Licencie $licencie) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO licencie (nom, prenom, id_contact, id_categorie) VALUES (?, ?, ?, ?)");
            $stmt->execute([$licencie->getNom(), $licencie->getPrenom(), $licencie->getIdContact(), $licencie->getIdCategorie()]);
            return true;
        } catch (PDOException $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM licencie WHERE numero_licence = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new Licencie($row['numero_licence'], $row['nom'], $row['prenom'], $row['id_contact'], $row['id_categorie']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getAll() {
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM licencie");
            $licencies = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $licencies[] = new Licencie($row['numero_licence'], $row['nom'], $row['prenom'], $row['id_contact'], $row['id_categorie']);
            }

            return $licencies;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function update(Licencie $licencie) {
        try {
            $stmt = $this->connexion->pdo->prepare("UPDATE licencie SET nom = ?, prenom = ?, id_contact = ?, id_categorie = ? WHERE numero_licence = ?");
            $stmt->execute([$licencie->getNom(), $licencie->getPrenom(), $licencie->getIdContact(), $licencie->getIdCategorie(), $licencie->getNumeroLicence()]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteById($id) {
        try {
            $stmt = $this->connexion->pdo->prepare("DELETE FROM licencie WHERE numero_licence = ?");
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}



