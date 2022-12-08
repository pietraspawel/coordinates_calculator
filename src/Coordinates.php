<?php

namespace pietras;

class Coordinates
{
    public const LATITUDE = 0;
    public const LONGITUDE = 1;
    public const DMS = 1;
    public const DD = 2;
    public const DM = 3;
    private $dms;
    private $dd;
    private $dm;

    /**
     * $string może być w różnych formatach, ex:
     * DMS: 50 45 57.259 N 16 16 57.153 E
     * DD: 50.7659053 16.2825425
     * DM: 50 45.9543167 N 16 16.95255 E
     */
    public function __construct(string $string)
    {
        switch (Coordinates::whatFormat($string)) {
            case Coordinates::DMS:
                $dms = Coordinates::cleanString($string);
                $dd = Coordinates::DMStoDD($dms);
                $dm = Coordinates::DMStoDM($dms);
                $dd = Coordinates::cleanString($dd);
                $dm = Coordinates::cleanString($dm);
                break;
            case Coordinates::DD:
                $dd = Coordinates::cleanString($string);
                $dms = Coordinates::DDtoDMS($dd);
                $dm = Coordinates::DMStoDM($dms);
                $dms = Coordinates::cleanString($dms);
                $dm = Coordinates::cleanString($dm);
                break;
            case Coordinates::DM:
                $dm = Coordinates::cleanString($string);
                $dms = Coordinates::DMtoDMS($dm);
                $dd = Coordinates::DMStoDD($dms);
                $dms = Coordinates::cleanString($dms);
                $dd = Coordinates::cleanString($dd);
                break;
        }
        $this->setDms(explode(" ", $dms));
        $this->setDd(explode(" ", $dd));
        $this->setDm(explode(" ", $dm));
    }

    /**
     * Zwraca rodzaj rozpoznanego formatu $stringa
     * lub false, gdy nie rozpoznano.
     */
    public static function whatFormat(string $string)
    {
        $string = Coordinates::cleanString($string);
        if (preg_match("/^([0-9]{1,3} [0-9]{1,3} [0-9]{1,3}(\.[0-9]{0,})? [NSEW]) (?1)$/", $string)) {
            return Coordinates::DMS;
        }
        if (preg_match("/^(-?[0-9]{1,3}(\.[0-9]*)?) (?1)$/", $string)) {
            return Coordinates::DD;
        }
        if (preg_match("/^([0-9]{1,3} [0-9]{1,3}(\.[0-9]{1,})? [NSEW]{1}) (?1)$/", $string)) {
            return Coordinates::DM;
        }
        return false;
    }

    public static function DDtoDMS(string $dd): string
    {
        $dd = Coordinates::cleanString($dd);
        $latitude = floatval(substr($dd, 0, strpos($dd, " ")));      // wytnij szerokość
        $longitude = floatval(substr($dd, strpos($dd, " ") + 1));    // wytnij długość
        $deg = intval($latitude);                                     // wytnij stopnie
        $rest = abs($latitude - $deg);                                    // wytnij resztę
        $min = floor($rest * 60);                                    // oblicz minuty
        $rest = $rest * 60 - $min;                                   // oblicz resztę
        $sec = round($rest * 60, 3);                                 // oblicz sekundy
        $dir = Coordinates::calculateDirection($latitude, Coordinates::LATITUDE);
        $deg = abs($deg);
        $dms = "{$deg}° {$min}′ {$sec}″ {$dir}";                     // skleć łańcuch
        $deg = intval($longitude);                                    // wytnij stopnie
        $rest = abs($longitude - $deg);                                   // wytnij resztę
        $min = floor($rest * 60);                                    // oblicz minuty
        $rest = $rest * 60 - $min;                                   // oblicz resztę
        $sec = round($rest * 60, 3);                                 // oblicz sekundy
        $dir = Coordinates::calculateDirection($longitude, Coordinates::LONGITUDE);
        $deg = abs($deg);
        $dms .= ", {$deg}° {$min}′ {$sec}″ {$dir}";
        return $dms;
    }

    public static function DDtoDM(string $dd): string
    {
        $string = Coordinates::DDtoDMS($dd);
        return Coordinates::DMStoDM($string);
    }

    public static function DMStoDD(string $string): string
    {
        $string = Coordinates::cleanString($string);
        $data = explode(" ", $string);
        $input = [
            "latitude" => [
                "degrees" => intval($data[0]),
                "minutes" => intval($data[1]),
                "seconds" => floatval($data[2]),
                "direction" => $data[3],
            ],
            "longitude" => [
                "degrees" => intval($data[4]),
                "minutes" => floatval($data[5]),
                "seconds" => floatval($data[6]),
                "direction" => $data[7],
            ],
        ];
        $decimal["latitude"] = round($input["latitude"]["minutes"] / 60 + $input["latitude"]["seconds"] / 3600, 7);
        $decimal["longitude"] = round($input["longitude"]["minutes"] / 60 + $input["longitude"]["seconds"] / 3600, 7);
        $output = [
            "latitude" => [
                "degrees" => $input["latitude"]["degrees"] + $decimal["latitude"],
            ],
            "longitude" => [
                "degrees" => $input["longitude"]["degrees"] + $decimal["longitude"],
            ],
        ];
        if ($input["latitude"]["direction"] == "S") {
            $output["latitude"]["degrees"] *= -1;
        }
        if ($input["longitude"]["direction"] == "W") {
            $output["longitude"]["degrees"] *= -1;
        }
        $string = "{$output["latitude"]["degrees"]}°, ";
        $string .= "{$output["longitude"]["degrees"]}°";
        return $string;
    }

    public static function DMtoDMS(string $string): string
    {
        $string = Coordinates::cleanString($string);
        $data = explode(" ", $string);
        $input = [
            "latitude" => [
                "degrees" => intval($data[0]),
                "minutes" => floatval($data[1]),
                "direction" => $data[2],
            ],
            "longitude" => [
                "degrees" => intval($data[3]),
                "minutes" => floatval($data[4]),
                "direction" => $data[5],
            ],
        ];
        $output = [
            "latitude" => [
                "degrees" => $input["latitude"]["degrees"],
                "minutes" => floor($input["latitude"]["minutes"]),
            ],
            "longitude" => [
                "degrees" => $input["longitude"]["degrees"],
                "minutes" => floor($input["longitude"]["minutes"]),
            ],
        ];
        // calculate seconds
        $seconds = round(($input["latitude"]["minutes"] - $output["latitude"]["minutes"]) * 60, 3);
        $output["latitude"]["seconds"] = $seconds;
        $seconds = round(($input["longitude"]["minutes"] - $output["longitude"]["minutes"]) * 60, 3);
        $output["longitude"]["seconds"] = $seconds;
        // calculate directions
        $output["latitude"]["direction"] = $input["latitude"]["direction"];
        $output["longitude"]["direction"] = $input["longitude"]["direction"];
        $string = "{$output["latitude"]["degrees"]}° ";
        $string .= "{$output["latitude"]["minutes"]}′ ";
        $string .= "{$output["latitude"]["seconds"]}″ ";
        $string .= "{$output["latitude"]["direction"]}, ";
        $string .= "{$output["longitude"]["degrees"]}° ";
        $string .= "{$output["longitude"]["minutes"]}′ ";
        $string .= "{$output["longitude"]["seconds"]}″ ";
        $string .= "{$output["longitude"]["direction"]}";
        return $string;
    }

    public static function DMtoDD(string $string): string
    {
        $string = Coordinates::DMtoDMS($string);
        return Coordinates::DMStoDD($string);
    }

    public static function DMStoDM(string $string): string
    {
        $string = Coordinates::cleanString($string);
        $data = explode(" ", $string);
        $input = [
            "latitude" => [
                "degrees" => intval($data[0]),
                "minutes" => intval($data[1]),
                "seconds" => floatval($data[2]),
                "direction" => $data[3],
            ],
            "longitude" => [
                "degrees" => intval($data[4]),
                "minutes" => floatval($data[5]),
                "seconds" => floatval($data[6]),
                "direction" => $data[7],
            ],
        ];
        $output = [
            "latitude" => [
                "degrees" => $input["latitude"]["degrees"],
                "minutes" => round($input["latitude"]["minutes"] + $input["latitude"]["seconds"] / 60, 7),
            ],
            "longitude" => [
                "degrees" => $input["longitude"]["degrees"],
                "minutes" => round($input["longitude"]["minutes"] + $input["longitude"]["seconds"] / 60, 7),
            ],
        ];
        $output["latitude"]["direction"] = $input["latitude"]["direction"];
        $output["longitude"]["direction"] = $input["longitude"]["direction"];
        $string = "{$output["latitude"]["degrees"]}° ";
        $string .= "{$output["latitude"]["minutes"]}′ ";
        $string .= "{$output["latitude"]["direction"]}, ";
        $string .= "{$output["longitude"]["degrees"]}° ";
        $string .= "{$output["longitude"]["minutes"]}′ ";
        $string .= "{$output["longitude"]["direction"]}";
        return $string;
    }

    private static function cleanString(string $string): string
    {
        $string = trim($string);
        $string = preg_replace("/[^0-9. -NSEW]/", " ", $string);          // zostaw tylko podane znaki
        $string = preg_replace("/[\,\"\']/", " ", $string);      // usuń przecinki, pojedyncze i podwójne cudzysłowia
        $string = preg_replace("/ +/", " ", $string);               // usuń podwójne spacje
        $string = trim($string);
        return $string;
    }

    /**
     * Oblicza półkulę (N|S lub W|E)
     * w zależności od podanego stopnia ($degrees)
     * i wartości (LATITUDE|LONGITUDE).
     */
    private static function calculateDirection($degrees, $value): ?string
    {
        switch ($value) {
            case Coordinates::LATITUDE:
                $plus = "N";
                $minus = "S";
                break;

            case Coordinates::LONGITUDE:
                $plus = "E";
                $minus = "W";
        }
        $dir = $degrees > 0 ? $plus : $minus;
        if ($degrees == 0) {
            $dir = "";
        }
        return $dir;
    }

    public function getDms(): array
    {
        return $this->dms;
    }

    public function getDd(): array
    {
        return $this->dd;
    }

    public function getDm(): array
    {
        return $this->dm;
    }

    private function setDms(array $array)
    {
        $this->dms = $array;
    }

    private function setDd(array $array)
    {
        $this->dd = $array;
    }

    private function setDm(array $array)
    {
        $this->dm = $array;
    }
}
