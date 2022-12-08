<?php

namespace pietras;

use PHPUnit\Framework\TestCase;

class CoordinatesTest extends TestCase
{
    public function testConverstionDDtoDMS()
    {
        $this->assertEquals(
            "50° 45′ 57.259″ N, 16° 16′ 57.153″ E",
            Coordinates::DDtoDMS("50.7659054°, 16.2825424°")
        );
        $this->assertEquals(
            "33° 52′ 11.438″ S, 151° 12′ 29.825″ E",
            Coordinates::DDtoDMS("-33.8698439°,  151.2082848°")
        );
        $this->assertEquals(
            "42° 19′ 53.583″ N, 83° 2′ 47.905″ W",
            Coordinates::DDtoDMS("42.3315509 -83.0466403")
        );
        $this->assertEquals(
            "22° 54′ 39.649″ S, 43° 12′ 33.742″ W",
            Coordinates::DDtoDMS("-22.9110137 -43.2093727")
        );
    }

    public function testConversionDDtoDM()
    {
        $this->assertEquals(
            "50° 45.9543167′ N, 16° 16.95255′ E",
            Coordinates::DDtoDM("50.7659054°, 16.2825424°")
        );
        $this->assertEquals(
            "33° 52.1906333′ S, 151° 12.4970833′ E",
            Coordinates::DDtoDM("-33.8698439°, 151.2082847°")
        );
        $this->assertEquals(
            "42° 19.89305′ N, 83° 2.7984167′ W",
            Coordinates::DDtoDM("42.3315508°, -83.0466403°")
        );
        $this->assertEquals(
            "22° 54.6608167′ S, 43° 12.5623667′ W",
            Coordinates::DDtoDM("-22.9110136°, -43.2093728°")
        );
    }

    public function testConversionDMStoDD()
    {
        $this->assertEquals(
            "50.7659053°, 16.2825425°",
            Coordinates::DMStoDD("50° 45′ 57.259″ N, 16° 16′ 57.153″ E")
        );
        $this->assertEquals(
            "-33.8698439°, 151.2082847°",
            Coordinates::DMStoDD("33° 52′ 11.438″ S 151° 12′ 29.825″ E")
        );
        $this->assertEquals(
            "42.3315508°, -83.0466403°",
            Coordinates::DMStoDD("42° 19′ 53.583″ N, 83° 2′ 47.905″ W")
        );
        $this->assertEquals(
            "-22.9110136°, -43.2093728°",
            Coordinates::DMStoDD("22° 54′ 39.649″ S, 43° 12′ 33.742″ W")
        );
    }

    public function testConversionDMtoDD()
    {
        $this->assertEquals(
            "50.7659053°, 16.2825425°",
            Coordinates::DMtoDD("50° 45.9543167′ N, 16° 16.95255′ E")
        );
        $this->assertEquals(
            "-33.8698439°, 151.2082847°",
            Coordinates::DMtoDD("33° 52.1906333′ S, 151° 12.4970833′ E")
        );
        $this->assertEquals(
            "42.3315508°, -83.0466403°",
            Coordinates::DMtoDD("42° 19.89305′ N, 83° 2.7984167′ W")
        );
        $this->assertEquals(
            "-22.9110136°, -43.2093728°",
            Coordinates::DMtoDD("22° 54.6608167′ S, 43° 12.5623667′ W")
        );
    }

    public function testConversionDMtoDMS()
    {
        $this->assertEquals(
            "50° 45′ 57.259″ N, 16° 16′ 57.153″ E",
            Coordinates::DMtoDMS("50° 45.954324′ N, 16° 16.952544′ E")
        );
        $this->assertEquals(
            "33° 52′ 11.438″ S, 151° 12′ 29.825″ E",
            Coordinates::DMtoDMS("33° 52.1906333′ S, 151° 12.4970833′ E")
        );
        $this->assertEquals(
            "42° 19′ 53.583″ N, 83° 2′ 47.905″ W",
            Coordinates::DMtoDMS("42° 19.89305′ N, 83° 2.7984167′ W")
        );
        $this->assertEquals(
            "22° 54′ 39.649″ S, 43° 12′ 33.742″ W",
            Coordinates::DMtoDMS("22° 54.6608167′ S, 43° 12.5623667′ W")
        );
    }

    public function testConversionDMStoDM()
    {
        $this->assertEquals(
            "50° 45.9543167′ N, 16° 16.95255′ E",
            Coordinates::DMStoDM("50° 45′ 57.259″ N, 16° 16′ 57.153″ E")
        );
        $this->assertEquals(
            "33° 52.1906333′ S, 151° 12.4970833′ E",
            Coordinates::DMStoDM("33° 52′ 11.438″ S 151° 12′ 29.825″ E")
        );
        $this->assertEquals(
            "42° 19.89305′ N, 83° 2.7984167′ W",
            Coordinates::DMStoDM("42° 19′ 53.583″ N, 83° 2′ 47.905″ W")
        );
        $this->assertEquals(
            "22° 54.6608167′ S, 43° 12.5623667′ W",
            Coordinates::DMStoDM("22° 54′ 39.649″ S, 43° 12′ 33.742″ W")
        );
    }

    public function testMinimalInput()
    {
        $this->assertEquals(
            "50° 45′ 57.259″ N, 16° 16′ 57.153″ E",
            Coordinates::DDtoDMS("50.7659054 16.2825424")
        );
        $this->assertEquals(
            "33° 52′ 11.438″ S, 151° 12′ 29.825″ E",
            Coordinates::DDtoDMS("-33.8698439 151.2082847")
        );
        $this->assertEquals(
            "42° 19′ 53.583″ N, 83° 2′ 47.905″ W",
            Coordinates::DDtoDMS("42.3315508 -83.0466403")
        );
        $this->assertEquals(
            "22° 54′ 39.649″ S, 43° 12′ 33.742″ W",
            Coordinates::DDtoDMS("-22.9110136 -43.2093728")
        );
        $this->assertEquals(
            "50° 45′ 57.259″ N, 16° 16′ 57.153″ E",
            Coordinates::DMtoDMS("50 45.954324 N 16 16.952544 E")
        );
        $this->assertEquals(
            "33° 52′ 11.438″ S, 151° 12′ 29.825″ E",
            Coordinates::DMtoDMS("33 52.1906333 S 151 12.4970833 E")
        );
        $this->assertEquals(
            "42° 19′ 53.583″ N, 83° 2′ 47.905″ W",
            Coordinates::DMtoDMS("42 19.89305 N 83 2.7984167 W")
        );
        $this->assertEquals(
            "22° 54′ 39.649″ S, 43° 12′ 33.742″ W",
            Coordinates::DMtoDMS("22 54.6608167 S 43 12.5623667 W")
        );
        $this->assertEquals(
            "50° 45.9543167′ N, 16° 16.95255′ E",
            Coordinates::DDtoDM("50.7659054 16.2825424")
        );
        $this->assertEquals(
            "33° 52.1906333′ S, 151° 12.4970833′ E",
            Coordinates::DDtoDM("-33.8698439 151.2082847")
        );
        $this->assertEquals(
            "42° 19.89305′ N, 83° 2.7984167′ W",
            Coordinates::DDtoDM("42.3315508 -83.0466403")
        );
        $this->assertEquals(
            "22° 54.6608167′ S, 43° 12.5623667′ W",
            Coordinates::DDtoDM("-22.9110136 -43.2093728")
        );
        $this->assertEquals(
            "50.7659053°, 16.2825425°",
            Coordinates::DMStoDD("50 45 57.259 N 16 16 57.153 E")
        );
        $this->assertEquals(
            "-33.8698439°, 151.2082847°",
            Coordinates::DMStoDD("33 52 11.438 S 151 12 29.825 E")
        );
        $this->assertEquals(
            "42.3315508°, -83.0466403°",
            Coordinates::DMStoDD("42 19 53.583 N 83 2 47.905 W")
        );
        $this->assertEquals(
            "-22.9110136°, -43.2093728°",
            Coordinates::DMStoDD("22 54 39.649 S 43 12 33.742 W")
        );
        $this->assertEquals(
            "50.7659053°, 16.2825425°",
            Coordinates::DMtoDD("50 45.954324 N 16 16.952544 E")
        );
        $this->assertEquals(
            "-33.8698439°, 151.2082847°",
            Coordinates::DMtoDD("33 52.1906333 S 151 12.4970833 E")
        );
        $this->assertEquals(
            "42.3315508°, -83.0466403°",
            Coordinates::DMtoDD("42 19.89305 N 83 2.7984167 W")
        );
        $this->assertEquals(
            "-22.9110136°, -43.2093728°",
            Coordinates::DMtoDD("22 54.6608167 S 43 12.5623667 W")
        );
        $this->assertEquals(
            "50° 45.9543167′ N, 16° 16.95255′ E",
            Coordinates::DMStoDM("50 45 57.259 N 16 16 57.153 E")
        );
        $this->assertEquals(
            "33° 52.1906333′ S, 151° 12.4970833′ E",
            Coordinates::DMStoDM("33 52 11.438 S 151 12 29.825 E")
        );
        $this->assertEquals(
            "42° 19.89305′ N, 83° 2.7984167′ W",
            Coordinates::DMStoDM("42 19 53.583 N 83 2 47.905 W")
        );
        $this->assertEquals(
            "22° 54.6608167′ S, 43° 12.5623667′ W",
            Coordinates::DMStoDM("22 54 39.649 S 43 12 33.742 W")
        );
    }

    public function testLotSpaces()
    {
        $this->assertEquals(
            "50° 45′ 57.259″ N, 16° 16′ 57.153″ E",
            Coordinates::DDtoDMS(" 50.7659053  °, 16.2825425 °   ")
        );
        $this->assertEquals(
            "22° 54′ 39.649″ S, 43° 12′ 33.742″ W",
            Coordinates::DDtoDMS("  -22.9110136 °   ,  -43.2093728   ° ")
        );
        $this->assertEquals(
            "50° 45′ 57.259″ N, 16° 16′ 57.153″ E",
            Coordinates::DMtoDMS(" 50  ° 45.9543167 ′   N ,  16 °   16.95255  ′ E  ")
        );
        $this->assertEquals(
            "22° 54′ 39.649″ S, 43° 12′ 33.742″ W",
            Coordinates::DMtoDMS("  22 °  54.6608167  ′ S  , 43  ° 12.5623667 ′ W ")
        );
        $this->assertEquals(
            "50° 45.9543167′ N, 16° 16.95255′ E",
            Coordinates::DDtoDM(" 50.7659053  °, 16.2825425 °   ")
        );
        $this->assertEquals(
            "22° 54.6608167′ S, 43° 12.5623667′ W",
            Coordinates::DDtoDM("  -22.9110136 °   ,  -43.2093728   ° ")
        );
        $this->assertEquals(
            "50.7659053°, 16.2825425°",
            Coordinates::DMStoDD(" 50  ° 45  ′ 57.259  ″ N  , 16°  16 ′  57.153 ″  E ")
        );
        $this->assertEquals(
            "-22.9110136°, -43.2093728°",
            Coordinates::DMStoDD("  22 °  54 ′  39.649 ″  S ,  43° 12  ′ 33.742  ″ W  ")
        );
        $this->assertEquals(
            "50.7659053°, 16.2825425°",
            Coordinates::DMtoDD(" 50  ° 45.9543167 ′   N ,  16 °   16.95255  ′ E  ")
        );
        $this->assertEquals(
            "-22.9110136°, -43.2093728°",
            Coordinates::DMtoDD("  22 °  54.6608167  ′ S  , 43  ° 12.5623667 ′ W ")
        );
        $this->assertEquals(
            "50° 45.9543167′ N, 16° 16.95255′ E",
            Coordinates::DMStoDM(" 50  ° 45  ′ 57.259  ″ N  , 16°  16 ′  57.153 ″  E ")
        );
        $this->assertEquals(
            "22° 54.6608167′ S, 43° 12.5623667′ W",
            Coordinates::DMStoDM("  22 °  54 ′  39.649 ″  S ,  43° 12  ′ 33.742  ″ W  ")
        );
    }

    public function testWhatFormat()
    {
        $this->assertEquals(Coordinates::DMS, Coordinates::whatFormat("50° 45′ 57.259″ N, 16° 16′ 57.153″ E"));
        $this->assertEquals(Coordinates::DMS, Coordinates::whatFormat("22° 54′ 39.649″ S, 43° 12′ 33.742″ W"));
        $this->assertEquals(Coordinates::DMS, Coordinates::whatFormat("50 45 57.259 N 16 16 57.153 E"));
        $this->assertEquals(Coordinates::DMS, Coordinates::whatFormat("22 54 39.649 S 43 12 33.742 W"));
        $this->assertEquals(
            Coordinates::DMS,
            Coordinates::whatFormat(" 50  ° 45  ′ 57.259  ″ N  , 16°  16 ′  57.153 ″  E ")
        );
        $this->assertEquals(
            Coordinates::DMS,
            Coordinates::whatFormat("  22 °  54 ′  39.649 ″  S ,  43° 12  ′ 33.742  ″ W  ")
        );
        $this->assertEquals(Coordinates::DD, Coordinates::whatFormat(" 50.7659053  °, 16.2825425 °   "));
        $this->assertEquals(Coordinates::DD, Coordinates::whatFormat("  -22.9110136 °   ,  -43.2093728   ° "));
        $this->assertEquals(Coordinates::DD, Coordinates::whatFormat("50.7659053°, 16.2825425°"));
        $this->assertEquals(Coordinates::DD, Coordinates::whatFormat("-22.9110136°, -43.2093728°"));
        $this->assertEquals(Coordinates::DD, Coordinates::whatFormat("50.7659054 16.2825424"));
        $this->assertEquals(Coordinates::DD, Coordinates::whatFormat("-33.8698439 151.2082847"));
        $this->assertEquals(Coordinates::DM, Coordinates::whatFormat("50° 45.9543167′ N, 16° 16.95255′ E"));
        $this->assertEquals(Coordinates::DM, Coordinates::whatFormat("22° 54.6608167′ S, 43° 12.5623667′ W"));
        $this->assertEquals(
            Coordinates::DM,
            Coordinates::whatFormat(" 50  ° 45.9543167 ′   N ,  16 °   16.95255  ′ E  ")
        );
        $this->assertEquals(
            Coordinates::DM,
            Coordinates::whatFormat("  22 °  54.6608167  ′ S  , 43  ° 12.5623667 ′ W ")
        );
        $this->assertEquals(Coordinates::DM, Coordinates::whatFormat("50 45.954324 N 16 16.952544 E"));
        $this->assertEquals(Coordinates::DM, Coordinates::whatFormat("22 54.6608167 S 43 12.5623667 W"));
        $this->assertEquals(Coordinates::DMS, Coordinates::whatFormat("50°45′57.259″N,16°16′57.153″E"));
        $this->assertEquals(Coordinates::DMS, Coordinates::whatFormat("22°54′39.649″S,43°12′33.742″W"));
        $this->assertEquals(Coordinates::DMS, Coordinates::whatFormat("50°48 16.4 'N 16°17\" 01.3  E  "));
    }

    public function testConstructor()
    {
        $object = new Coordinates("22° 54′ 39.649″ S, 43° 12′ 33.742″ W");
        $this->assertEquals([22, 54, 39.649, "S", 43, 12, 33.742, "W"], $object->getDMS());
        $this->assertEquals([-22.9110136, -43.2093728], $object->getDD());
        $this->assertEquals([22, 54.6608167, "S", 43, 12.5623667, "W"], $object->getDM());
        $object = new Coordinates("-22.9110136°, -43.2093728°");
        $this->assertEquals([22, 54, 39.649, "S", 43, 12, 33.742, "W"], $object->getDMS());
        $this->assertEquals([-22.9110136, -43.2093728], $object->getDD());
        $this->assertEquals([22, 54.6608167, "S", 43, 12.5623667, "W"], $object->getDM());
        $object = new Coordinates("22° 54.6608167′ S, 43° 12.5623667′ W");
        $this->assertEquals([22, 54, 39.649, "S", 43, 12, 33.742, "W"], $object->getDMS());
        $this->assertEquals([-22.9110136, -43.2093728], $object->getDD());
        $this->assertEquals([22, 54.6608167, "S", 43, 12.5623667, "W"], $object->getDM());
        $object = new Coordinates("  22 °  54.6608167  ′ S  , 43  ° 12.5623667 ′ W ");
        $this->assertEquals([22, 54, 39.649, "S", 43, 12, 33.742, "W"], $object->getDMS());
        $this->assertEquals([-22.9110136, -43.2093728], $object->getDD());
        $this->assertEquals([22, 54.6608167, "S", 43, 12.5623667, "W"], $object->getDM());
        $object = new Coordinates("  -22.9110136 °   ,  -43.2093728   ° ");
        $this->assertEquals([22, 54, 39.649, "S", 43, 12, 33.742, "W"], $object->getDMS());
        $this->assertEquals([-22.9110136, -43.2093728], $object->getDD());
        $this->assertEquals([22, 54.6608167, "S", 43, 12.5623667, "W"], $object->getDM());
        $object = new Coordinates("  22 °  54 ′  39.649 ″  S ,  43° 12  ′ 33.742  ″ W  ");
        $this->assertEquals([22, 54, 39.649, "S", 43, 12, 33.742, "W"], $object->getDMS());
        $this->assertEquals([-22.9110136, -43.2093728], $object->getDD());
        $this->assertEquals([22, 54.6608167, "S", 43, 12.5623667, "W"], $object->getDM());
        $object = new Coordinates("22 54 39.649 S 43 12 33.742 W");
        $this->assertEquals([22, 54, 39.649, "S", 43, 12, 33.742, "W"], $object->getDMS());
        $this->assertEquals([-22.9110136, -43.2093728], $object->getDD());
        $this->assertEquals([22, 54.6608167, "S", 43, 12.5623667, "W"], $object->getDM());
        $object = new Coordinates("-22.9110136 -43.2093728");
        $this->assertEquals([22, 54, 39.649, "S", 43, 12, 33.742, "W"], $object->getDMS());
        $this->assertEquals([-22.9110136, -43.2093728], $object->getDD());
        $this->assertEquals([22, 54.6608167, "S", 43, 12.5623667, "W"], $object->getDM());
        $object = new Coordinates("22 54.6608167 S 43 12.5623667 W");
        $this->assertEquals([22, 54, 39.649, "S", 43, 12, 33.742, "W"], $object->getDMS());
        $this->assertEquals([-22.9110136, -43.2093728], $object->getDD());
        $this->assertEquals([22, 54.6608167, "S", 43, 12.5623667, "W"], $object->getDM());
    }
}
