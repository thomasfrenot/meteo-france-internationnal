<?php
namespace App\Model;

class Peak
{
    private int $id;
    private float $lat;
    private float $lon;
    private int $altitude;
    private string $name;

    public function __construct() {}

    public function getId()
    {
        return $this->id;
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function setLat(float $lat): void
    {
        $this->lat = $lat;
    }

    public function getLon(): float
    {
        return $this->lon;
    }

    public function setLon(float $lon): void
    {
        $this->lon = $lon;
    }

    public function getAltitude(): int
    {
        return $this->altitude;
    }

    public function setAltitude(int $altitude): void
    {
        $this->altitude = $altitude;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = ucfirst(strtolower($name));
    }

    /**
     * Get object data in array mode
     * @return array
     */
    public function getData()
    {
        return [
            'id' => $this->getId(),
            'lat' => $this->getLat(),
            'lon' => $this->getLon(),
            'altitude' => $this->getAltitude(),
            'name' => $this->getName(),
        ];
    }
}
