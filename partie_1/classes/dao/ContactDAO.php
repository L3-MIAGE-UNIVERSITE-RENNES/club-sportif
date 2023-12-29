<?php
class ContactDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    public function create(Contact $contact) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO contact (nom, prenom, email, numero_tel) VALUES (?, ?, ?, ?)");
            $stmt->execute([$contact->getNom(), $contact->getPrenom(), $contact->getEmail(), $contact->getNumeroTel()]);
            return true;
        } catch (PDOException $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM contact WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new Contact($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['numero_tel']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getByEmail($email) {
        try {
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM contact WHERE email = ?");
            $stmt->execute([$email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new Contact($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['numero_tel']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }


    public function getAll() {
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM contact");
            $contacts = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $contacts[] = new Contact($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['numero_tel']);
            }

            return $contacts;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function update(Contact $contact) {
        try {
            $stmt = $this->connexion->pdo->prepare("UPDATE contact SET nom = ?, prenom = ?, email = ?, numero_tel = ? WHERE id = ?");
            $stmt->execute([$contact->getNom(), $contact->getPrenom(), $contact->getEmail(), $contact->getNumeroTel(), $contact->getId()]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteById($id) {
        try {
            $stmt = $this->connexion->pdo->prepare("DELETE FROM contact WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}




