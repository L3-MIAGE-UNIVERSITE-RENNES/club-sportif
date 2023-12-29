<?php
    class EducateurDAO {
        private $connexion;

        public function __construct(Connexion $connexion) {
            $this->connexion = $connexion;
        }

        public function create(Educateur $educateur) {
            try {
                $stmt = $this->connexion->pdo->prepare("INSERT INTO educateur (numero_licence, email, mot_de_passe, est_administrateur) VALUES (?, ?, ?, ?)");
                $stmt->execute([$educateur->getNumeroLicence(), $educateur->getEmail(), $educateur->getMotDePasse(), $educateur->getEstAdministrateur()]);
                return true;
            } catch (PDOException $e) {
                print_r($e->getMessage());
                return false;
            }
        }

        public function getById($id) {
            try {
                $stmt = $this->connexion->pdo->prepare("SELECT * FROM educateur WHERE id_educateur = ?");
                $stmt->execute([$id]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    return new Educateur($row['id_educateur'], $row['numero_licence'], $row['email'], $row['mot_de_passe'], $row['est_administrateur']);
                } else {
                    return null;
                }
            } catch (PDOException $e) {
                return null;
            }
        }

        public function getAll() {
            try {
                $stmt = $this->connexion->pdo->query("SELECT * FROM educateur");
                $educateurs = [];

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $educateurs[] = new Educateur($row['id_educateur'], $row['numero_licence'], $row['email'], $row['mot_de_passe'], $row['est_administrateur']);
                }

                return $educateurs;
            } catch (PDOException $e) {
                return [];
            }
        }

        public function update(Educateur $educateur) {
            try {
                $stmt = $this->connexion->pdo->prepare("UPDATE educateurs SET id_educateur = ?, numero_licence = ?, email = ?, mot_de_passe = ?, est_administrateur = ? WHERE id_educateur = ?");
                $stmt->execute([$educateur->getIdEducateur(), $educateur->getNumeroLicence(), $educateur->getEmail(), $educateur->getMotDePasse(), $educateur->getEstAdministrateur(), $educateur->getIdEducateur()]);
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }

        public function deleteById($id) {
            try {
                $stmt = $this->connexion->pdo->prepare("DELETE FROM educateur WHERE id_educateur = ?");
                $stmt->execute([$id]);
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }
    }


