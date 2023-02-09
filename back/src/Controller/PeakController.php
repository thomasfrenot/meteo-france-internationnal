<?php
namespace App\Controller;

use App\Database;
use App\Model\Peak;
use App\Request;

class PeakController
{
    private Database $database;
    private Request $request;

    public function __construct(Database $database, Request $request)
    {
        $this->database = $database;
        $this->request = $request;
    }

    /**
     * Get list of peaks
     * @return json|\Exception
     */
    public function listAction()
    {
        $connection = $this->database->getConnection();
        $stmt = $connection->prepare("SELECT * FROM peak");
        $stmt->execute();

        $peaks = [];
        foreach ($stmt->fetchAll(\PDO::FETCH_CLASS, Peak::class) as $peak) {
            $peaks[] = $peak->getData();
        }

        return json_encode($peaks);
    }

    /**
     * Create new peak
     * @return json|\Exception
     */
    public function createAction()
    {
        //Récupération des params POST de la requète
        $params = $this->request->getBody();

        //todo: tester que tous les paramêtres sont ok ou lever une erreur
        //todo: tester que le peak n'existe pas déjà

        $connection = $this->database->getConnection();
        $stmt = $connection->prepare("INSERT INTO peak (lat, lon, altitude, name) VALUES (:lat, :lon, :altitude, :name)");
        $stmt->execute($params);
        $lastId = $connection->lastInsertId();

        return json_encode('create done!');
    }

    /**
     * Get given peak
     * @return Peak
     */
    public function readAction(int $id)
    {
        $connection = $this->database->getConnection();
        $stmt = $connection->prepare("SELECT * FROM peak WHERE id=:id");
        $stmt->execute([
            'id' => $id,
        ]);

        $peak = $stmt->fetchObject(Peak::class);
        if (false === $peak) {
            throw new \Exception('Peak unknown!');
        }

        return json_encode($peak->getData());
    }

    /**
     * Update given peak
     * @return Peak
     */
    public function updateAction(int $id)
    {
        $connection = $this->database->getConnection();
        $stmt = $connection->prepare("SELECT * FROM peak WHERE id=:id");
        $stmt->execute([
            'id' => $id,
        ]);

        $peak = $stmt->fetchObject(Peak::class);
        if (false === $peak) {
            throw new \Exception('Peak unknown!');
        }

        //Récupération des params POST de la requète
        $params = $this->request->getBody();

        //todo: tester que tous les paramêtres sont ok ou lever une erreur

        $connection = $this->database->getConnection();
        $stmt = $connection->prepare("UPDATE peak SET lat = :lat, lon = :lon, altitude = :altitude, name = :name WHERE id = :id");
        $stmt->execute([
            'id' => $id,
            ...$params
        ]);

        return json_encode($peak->getData());
    }

    /**
     * Delete given peak
     * @param int $id
     * @return Peak
     */
    public function deleteAction(int $id)
    {
        $connection = $this->database->getConnection();
        $stmt = $connection->prepare("SELECT * FROM peak WHERE id=:id");
        $stmt->execute([
            'id' => $id,
        ]);

        $peak = $stmt->fetchObject(Peak::class);
        if (false === $peak) {
            throw new \Exception('Peak unknown!');
        }

        $stmt = $connection->prepare("DELETE FROM peak WHERE id = :id");
        $stmt->execute([
            'id' => $id,
        ]);

        return json_encode('delete done!');
    }
}
