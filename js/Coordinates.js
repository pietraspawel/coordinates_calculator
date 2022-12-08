class Coordinates
{
    static LATITUDE = 0;
    static LONGITUDE = 1;
    static DMS = 1;
    static DD = 2;
    static DM = 3;

    /**
     * Zwraca rodzaj rozpoznanego formatu $stringa
     * lub false, gdy nie rozpoznano.
     */
    static whatFormat(string)
    {
        string = Coordinates.cleanString(string);
        if (/^[0-9]{1,3} [0-9]{1,3} [0-9]{1,3}(\.[0-9]{0,})? [NSEW] [0-9]{1,3} [0-9]{1,3} [0-9]{1,3}(\.[0-9]{0,})? [NSEW]$/g.test(string)) {
            return Coordinates.DMS;
        }
        if (/^-?[0-9]{1,3}(\.[0-9]*)? -?[0-9]{1,3}(\.[0-9]*)?$/g.test(string)) {
            return Coordinates.DD;
        }
        if (/^[0-9]{1,3} [0-9]{1,3}(\.[0-9]{1,})? [NSEW]{1} [0-9]{1,3} [0-9]{1,3}(\.[0-9]{1,})? [NSEW]{1}$/g.test(string)) {
            return Coordinates.DM;
        }
        return false;
    }

    static DDtoDMS(string)
    {
        string = Coordinates.cleanString(string);
        const data = string.split(" ");
        const input = {
            latitude: {
                degrees: data[0]
            },
            longitude: {
                degrees: data[1]
            }
        };
        let deg1 = Math.trunc(input.latitude.degrees);
        let rest = Math.abs(input.latitude.degrees - deg1);
        let min1 = Math.floor(rest * 60);
        rest = rest * 60 - min1;
        let sec1 = (rest * 60).toFixed(3);
        let deg2 = Math.trunc(input.longitude.degrees);
        rest = Math.abs(input.longitude.degrees - deg2);
        let min2 = Math.floor(rest * 60);
        rest = rest * 60 - min2;
        let sec2 = (rest * 60).toFixed(3);
        let output = {
            latitude: {
                degrees: Math.abs(deg1),
                minutes: min1,
                seconds: sec1,
                direction: Coordinates.calculateDirection(input.latitude.degrees, Coordinates.LATITUDE)
            },
            longitude: {
                degrees: Math.abs(deg2),
                minutes: min2,
                seconds: sec2,
                direction: Coordinates.calculateDirection(input.longitude.degrees, Coordinates.LONGITUDE)
            }
        }

        let ret = `${output.latitude.degrees}° `;
        ret += `${output.latitude.minutes}′ `;
        ret += `${output.latitude.seconds}″ `;
        ret += `${output.latitude.direction}, `;
        ret += `${output.longitude.degrees}° `;
        ret += `${output.longitude.minutes}′ `;
        ret += `${output.longitude.seconds}″ `;
        ret += `${output.longitude.direction}`;
        return ret;
    }

    static DMStoDD(string)
    {
        string = Coordinates.cleanString(string);
        const data = string.split(" ");
        const input = {
            latitude: {
                degrees: parseInt(data[0]),
                minutes: parseInt(data[1]),
                seconds: parseFloat(data[2]),
                direction: data[3]
            },
            longitude: {
                degrees: parseInt(data[4]),
                minutes: parseInt(data[5]),
                seconds: parseFloat(data[6]),
                direction: data[7]
            }
        };
        const decimal = {
            latitude: parseFloat((input.latitude.minutes / 60 + input.latitude.seconds / 3600).toFixed(7)),
            longitude: parseFloat((input.longitude.minutes / 60 + input.longitude.seconds / 3600).toFixed(7))
        };
        let output = {
            latitude: {
                degrees: input.latitude.degrees + decimal.latitude
            },
            longitude: {
                degrees: input.longitude.degrees + decimal.longitude
            }
        };
        if (input.latitude.direction == "S") {
            output.latitude.degrees *= -1;
        }
        if (input.longitude.direction == "W") {
            output.longitude.degrees *= -1;
        }
        string = `${output.latitude.degrees}°, `;
        string += `${output.longitude.degrees}°`;

        return string;
    }

    static DMtoDMS(string)
    {
        string = Coordinates.cleanString(string);
        const data = string.split(" ");
        const input = {
            latitude: {
                degrees: parseInt(data[0]),
                minutes: parseFloat(data[1]),
                direction: data[2]
            },
            longitude: {
                degrees: parseInt(data[3]),
                minutes: parseFloat(data[4]),
                direction: data[5]
            }
        };
        let output = {
            latitude: {
                degrees: input.latitude.degrees,
                minutes: Math.floor(input.latitude.minutes),
                seconds: 0,
                direction: input.latitude.direction
            },
            longitude: {
                degrees: input.longitude.degrees,
                minutes: Math.floor(input.longitude.minutes),
                seconds: 0,
                direction: input.longitude.direction
            }
        };
        // calculate seconds
        let seconds = parseFloat(((input.latitude.minutes - output.latitude.minutes) * 60).toFixed(3));
        output.latitude.seconds = seconds;
        seconds = parseFloat(((input.longitude.minutes - output.longitude.minutes) * 60).toFixed(3));
        output.longitude.seconds = seconds;
        // calculate output string
        string = `${output.latitude.degrees}° `;
        string += `${output.latitude.minutes}′ `;
        string += `${output.latitude.seconds}″ `;
        string += `${output.latitude.direction}, `;
        string += `${output.longitude.degrees}° `;
        string += `${output.longitude.minutes}′ `;
        string += `${output.longitude.seconds}″ `;
        string += `${output.longitude.direction}`;
        return string;
    }

    static DMStoDM(string)
    {
        string = Coordinates.cleanString(string);
        const data = string.split(" ");
        const input = {
            latitude: {
                degrees: parseInt(data[0]),
                minutes: parseInt(data[1]),
                seconds: parseFloat(data[2]),
                direction: data[3]
            },
            longitude: {
                degrees: parseInt(data[4]),
                minutes: parseInt(data[5]),
                seconds: parseFloat(data[6]),
                direction: data[7]
            }
        };
        let output = {
            latitude: {
                degrees: input.latitude.degrees,
                minutes: parseFloat((input.latitude.minutes + input.latitude.seconds / 60).toFixed(7)),
                direction: input.latitude.direction
            },
            longitude: {
                degrees: input.longitude.degrees,
                minutes: parseFloat((input.longitude.minutes + input.longitude.seconds / 60).toFixed(7)),
                direction: input.longitude.direction
            }
        };
        string = `${output.latitude.degrees}° `;
        string += `${output.latitude.minutes}′ `;
        string += `${output.latitude.direction}, `;
        string += `${output.longitude.degrees}° `;
        string += `${output.longitude.minutes}′ `;
        string += `${output.longitude.direction}`;
        return string;
    }

    static DDtoDM(string)
    {
        string = Coordinates.DDtoDMS(string);
        return Coordinates.DMStoDM(string);
    }

    static DMtoDD(string)
    {
        string = Coordinates.DMtoDMS(string);
        return Coordinates.DMStoDD(string);
    }

    static cleanString(string)
    {
        string = string.trim();
        string = string.replace(/[^0-9. -NSEW]/g, " "); // zostaw tylko podane znaki
        string = string.replace(/[\,\"\']/g, " ");      // usuń przecinki, pojedyncze i podwójne cudzysłowia
        string = string.replace(/ +/g, " ");            // zamień podwójne spacje na spacje
        string = string.trim();
        return string;
    }

    /**
     * Oblicza półkulę (N|S lub W|E)
     * w zależności od podanego stopnia (degrees)
     * i wartości (LATITUDE|LONGITUDE).
     */
    static calculateDirection(degrees, value)
    {
        let plus, minus;
        switch (value) {
            case Coordinates.LATITUDE:
                plus = "N";
                minus = "S";
                break;
            case Coordinates.LONGITUDE:
                plus = "E";
                minus = "W";
                break;
        }
        if (degrees > 0) {
            return plus;
        } else if(degrees < 0) {
            return minus;
        } else {
            return "";
        }
    }
}
