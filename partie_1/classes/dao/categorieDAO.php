<?php
class CategorieDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    public function create(Categorie $categorie) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO categorie (id, nom, code_raccourci) VALUES (?, ?, ?)");
            $stmt->execute([$categorie->getId(), $categorie->getNom(), $categorie->getCodeRaccourci()]);
            return true;
        } catch (PDOException $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM categorie WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new Categorie($row['id'], $row['nom'], $row['code_raccourci']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getByCode($code_raccourci) {
        try {
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM categorie WHERE code_raccourci = ?");
            $stmt->execute([$code_raccourci]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new Categorie($row['id'], $row['nom'], $row['code_raccourci']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getAll() {
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM categorie");
            $categories = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = new Categorie($row['id'], $row['nom'], $row['code_raccourci']);
            }

            return $categories;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function update(Categorie $categorie) {
        try {
            $stmt = $this->connexion->pdo->prepare("UPDATE categorie SET nom = ?, code_raccourci = ? WHERE id = ?");
            $stmt->execute([$categorie->getNom(), $categorie->getCodeRaccourci(), $categorie->getId()]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteById($id) {
        try {
            $stmt = $this->connexion->pdo->prepare("DELETE FROM categorie WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            print_r($e->getMessage());
            return false;
        }
    }
}
