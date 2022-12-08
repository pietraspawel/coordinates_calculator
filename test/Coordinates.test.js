const Coordinates = require("../js/Coordinates");

test("cleanString", () => {
    expect(Coordinates.cleanString("   50° 45′ 57.259″ N, 16° 16′ 57.153″ E  ")).toBe("50 45 57.259 N 16 16 57.153 E");
});

test("whatFormat", () => {
    expect(Coordinates.whatFormat("50° 45′ 57.259″ N, 16° 16′ 57.153″ E")).toBe(Coordinates.DMS);
    expect(Coordinates.whatFormat("22° 54′ 39.649″ S, 43° 12′ 33.742″ W")).toBe(Coordinates.DMS);
    expect(Coordinates.whatFormat("50 45 57.259 N 16 16 57.153 E")).toBe(Coordinates.DMS);
    expect(Coordinates.whatFormat("22 54 39.649 S 43 12 33.742 W")).toBe(Coordinates.DMS);
    expect(Coordinates.whatFormat(" 50  ° 45  ′ 57.259  ″ N  , 16°  16 ′  57.153 ″  E ")).toBe(Coordinates.DMS);
    expect(Coordinates.whatFormat("  22 °  54 ′  39.649 ″  S ,  43° 12  ′ 33.742  ″ W  ")).toBe(Coordinates.DMS);
    expect(Coordinates.whatFormat(" 50.7659053  °, 16.2825425 °   ")).toBe(Coordinates.DD);
    expect(Coordinates.whatFormat("  -22.9110136 °   ,  -43.2093728   ° ")).toBe(Coordinates.DD);
    expect(Coordinates.whatFormat("50.7659053°, 16.2825425°")).toBe(Coordinates.DD);
    expect(Coordinates.whatFormat("-22.9110136°, -43.2093728°")).toBe(Coordinates.DD);
    expect(Coordinates.whatFormat("50.7659054 16.2825424")).toBe(Coordinates.DD);
    expect(Coordinates.whatFormat("-33.8698439 151.2082847")).toBe(Coordinates.DD);
    expect(Coordinates.whatFormat("50° 45.9543167′ N, 16° 16.95255′ E")).toBe(Coordinates.DM);
    expect(Coordinates.whatFormat("22° 54.6608167′ S, 43° 12.5623667′ W")).toBe(Coordinates.DM);
    expect(Coordinates.whatFormat(" 50  ° 45.9543167 ′   N ,  16 °   16.95255  ′ E  ")).toBe(Coordinates.DM);
    expect(Coordinates.whatFormat("  22 °  54.6608167  ′ S  , 43  ° 12.5623667 ′ W ")).toBe(Coordinates.DM);
    expect(Coordinates.whatFormat("50 45.954324 N 16 16.952544 E")).toBe(Coordinates.DM);
    expect(Coordinates.whatFormat("22 54.6608167 S 43 12.5623667 W")).toBe(Coordinates.DM);
    expect(Coordinates.whatFormat("50°45′57.259″N,16°16′57.153″E")).toBe(Coordinates.DMS);
    expect(Coordinates.whatFormat("22°54′39.649″S,43°12′33.742″W")).toBe(Coordinates.DMS);
    expect(Coordinates.whatFormat("50°48 16.4 'N 16°17\" 01.3  E  ")).toBe(Coordinates.DMS);
});

test("DDtoDMS", () => {
    expect(Coordinates.DDtoDMS("50.7659054°, 16.2825424°")).toBe("50° 45′ 57.259″ N, 16° 16′ 57.153″ E");
    expect(Coordinates.DDtoDMS("-33.8698439°,  151.2082848°")).toBe("33° 52′ 11.438″ S, 151° 12′ 29.825″ E");
    expect(Coordinates.DDtoDMS("42.3315509 -83.0466403")).toBe("42° 19′ 53.583″ N, 83° 2′ 47.905″ W");
    expect(Coordinates.DDtoDMS("-22.9110137 -43.2093727")).toBe("22° 54′ 39.649″ S, 43° 12′ 33.742″ W");
});

test("DMStoDD", () => {
    expect(Coordinates.DMStoDD("50° 45′ 57.259″ N, 16° 16′ 57.153″ E")).toBe("50.7659053°, 16.2825425°");
    expect(Coordinates.DMStoDD("33° 52′ 11.438″ S 151° 12′ 29.825″ E")).toBe("-33.8698439°, 151.2082847°");
    expect(Coordinates.DMStoDD("42° 19′ 53.583″ N, 83° 2′ 47.905″ W")).toBe("42.3315508°, -83.0466403°");
    expect(Coordinates.DMStoDD("22° 54′ 39.649″ S, 43° 12′ 33.742″ W")).toBe("-22.9110136°, -43.2093728°");
});

test("DMtoDMS", () => {
    expect(Coordinates.DMtoDMS("50° 45.954324′ N, 16° 16.952544′ E")).toBe("50° 45′ 57.259″ N, 16° 16′ 57.153″ E");
    expect(Coordinates.DMtoDMS("33° 52.1906333′ S, 151° 12.4970833′ E")).toBe("33° 52′ 11.438″ S, 151° 12′ 29.825″ E");
    expect(Coordinates.DMtoDMS("42° 19.89305′ N, 83° 2.7984167′ W")).toBe("42° 19′ 53.583″ N, 83° 2′ 47.905″ W");
    expect(Coordinates.DMtoDMS("22° 54.6608167′ S, 43° 12.5623667′ W")).toBe("22° 54′ 39.649″ S, 43° 12′ 33.742″ W");
});

test("DMStoDM", () => {
    expect(Coordinates.DMStoDM("50° 45′ 57.259″ N, 16° 16′ 57.153″ E")).toBe("50° 45.9543167′ N, 16° 16.95255′ E");
    expect(Coordinates.DMStoDM("33° 52′ 11.438″ S 151° 12′ 29.825″ E")).toBe("33° 52.1906333′ S, 151° 12.4970833′ E");
    expect(Coordinates.DMStoDM("42° 19′ 53.583″ N, 83° 2′ 47.905″ W")).toBe("42° 19.89305′ N, 83° 2.7984167′ W");
    expect(Coordinates.DMStoDM("22° 54′ 39.649″ S, 43° 12′ 33.742″ W")).toBe("22° 54.6608167′ S, 43° 12.5623667′ W");
});

test("DDtoDM", () => {
    expect(Coordinates.DDtoDM("50.7659054°, 16.2825424°")).toBe("50° 45.9543167′ N, 16° 16.95255′ E");
    expect(Coordinates.DDtoDM("-33.8698439°, 151.2082847°")).toBe("33° 52.1906333′ S, 151° 12.4970833′ E");
    expect(Coordinates.DDtoDM("42.3315508°, -83.0466403°")).toBe("42° 19.89305′ N, 83° 2.7984167′ W");
    expect(Coordinates.DDtoDM("-22.9110136°, -43.2093728°")).toBe("22° 54.6608167′ S, 43° 12.5623667′ W");
});

test("DMtoDD", () => {
    expect(Coordinates.DMtoDD("50° 45.9543167′ N, 16° 16.95255′ E")).toBe("50.7659053°, 16.2825425°");
    expect(Coordinates.DMtoDD("33° 52.1906333′ S, 151° 12.4970833′ E")).toBe("-33.8698439°, 151.2082847°");
    expect(Coordinates.DMtoDD("42° 19.89305′ N, 83° 2.7984167′ W")).toBe("42.3315508°, -83.0466403°");
    expect(Coordinates.DMtoDD("22° 54.6608167′ S, 43° 12.5623667′ W")).toBe("-22.9110136°, -43.2093728°");
});

test("minimal input", () => {
    expect(Coordinates.DDtoDMS("50.7659054 16.2825424")).toBe("50° 45′ 57.259″ N, 16° 16′ 57.153″ E");
    expect(Coordinates.DDtoDMS("-33.8698439 151.2082847")).toBe("33° 52′ 11.438″ S, 151° 12′ 29.825″ E");
    expect(Coordinates.DDtoDMS("42.3315508 -83.0466403")).toBe("42° 19′ 53.583″ N, 83° 2′ 47.905″ W");
    expect(Coordinates.DDtoDMS("-22.9110136 -43.2093728")).toBe("22° 54′ 39.649″ S, 43° 12′ 33.742″ W");
    expect(Coordinates.DMtoDMS("50 45.954324 N 16 16.952544 E")).toBe("50° 45′ 57.259″ N, 16° 16′ 57.153″ E");
    expect(Coordinates.DMtoDMS("33 52.1906333 S 151 12.4970833 E")).toBe("33° 52′ 11.438″ S, 151° 12′ 29.825″ E");
    expect(Coordinates.DMtoDMS("42 19.89305 N 83 2.7984167 W")).toBe("42° 19′ 53.583″ N, 83° 2′ 47.905″ W");
    expect(Coordinates.DMtoDMS("22 54.6608167 S 43 12.5623667 W")).toBe("22° 54′ 39.649″ S, 43° 12′ 33.742″ W");
    expect(Coordinates.DDtoDM("50.7659054 16.2825424")).toBe("50° 45.9543167′ N, 16° 16.95255′ E");
    expect(Coordinates.DDtoDM("-33.8698439 151.2082847")).toBe("33° 52.1906333′ S, 151° 12.4970833′ E");
    expect(Coordinates.DDtoDM("42.3315508 -83.0466403")).toBe("42° 19.89305′ N, 83° 2.7984167′ W");
    expect(Coordinates.DDtoDM("-22.9110136 -43.2093728")).toBe("22° 54.6608167′ S, 43° 12.5623667′ W");
    expect(Coordinates.DMStoDD("50 45 57.259 N 16 16 57.153 E")).toBe("50.7659053°, 16.2825425°");
    expect(Coordinates.DMStoDD("33 52 11.438 S 151 12 29.825 E")).toBe("-33.8698439°, 151.2082847°");
    expect(Coordinates.DMStoDD("42 19 53.583 N 83 2 47.905 W")).toBe("42.3315508°, -83.0466403°");
    expect(Coordinates.DMStoDD("22 54 39.649 S 43 12 33.742 W")).toBe("-22.9110136°, -43.2093728°");
    expect(Coordinates.DMtoDD("50 45.954324 N 16 16.952544 E")).toBe("50.7659053°, 16.2825425°");
    expect(Coordinates.DMtoDD("33 52.1906333 S 151 12.4970833 E")).toBe("-33.8698439°, 151.2082847°");
    expect(Coordinates.DMtoDD("42 19.89305 N 83 2.7984167 W")).toBe("42.3315508°, -83.0466403°");
    expect(Coordinates.DMtoDD("22 54.6608167 S 43 12.5623667 W")).toBe("-22.9110136°, -43.2093728°");
    expect(Coordinates.DMStoDM("50 45 57.259 N 16 16 57.153 E")).toBe("50° 45.9543167′ N, 16° 16.95255′ E");
    expect(Coordinates.DMStoDM("33 52 11.438 S 151 12 29.825 E")).toBe("33° 52.1906333′ S, 151° 12.4970833′ E");
    expect(Coordinates.DMStoDM("42 19 53.583 N 83 2 47.905 W")).toBe("42° 19.89305′ N, 83° 2.7984167′ W");
    expect(Coordinates.DMStoDM("22 54 39.649 S 43 12 33.742 W")).toBe("22° 54.6608167′ S, 43° 12.5623667′ W");
});

test("a lot of spaces", () => {
    expect(Coordinates.DDtoDMS(" 50.7659053  °, 16.2825425 °   ")).toBe("50° 45′ 57.259″ N, 16° 16′ 57.153″ E");
    expect(Coordinates.DDtoDMS("  -22.9110136 °   ,  -43.2093728   ° ")).toBe("22° 54′ 39.649″ S, 43° 12′ 33.742″ W");
    expect(Coordinates.DMtoDMS(" 50  ° 45.9543167 ′   N ,  16 °   16.95255  ′ E  ")).toBe("50° 45′ 57.259″ N, 16° 16′ 57.153″ E");
    expect(Coordinates.DMtoDMS("  22 °  54.6608167  ′ S  , 43  ° 12.5623667 ′ W ")).toBe("22° 54′ 39.649″ S, 43° 12′ 33.742″ W");
    expect(Coordinates.DDtoDM(" 50.7659053  °, 16.2825425 °   ")).toBe("50° 45.9543167′ N, 16° 16.95255′ E");
    expect(Coordinates.DDtoDM("  -22.9110136 °   ,  -43.2093728   ° ")).toBe("22° 54.6608167′ S, 43° 12.5623667′ W");
    expect(Coordinates.DMStoDD(" 50  ° 45  ′ 57.259  ″ N  , 16°  16 ′  57.153 ″  E ")).toBe("50.7659053°, 16.2825425°");
    expect(Coordinates.DMStoDD("  22 °  54 ′  39.649 ″  S ,  43° 12  ′ 33.742  ″ W  ")).toBe("-22.9110136°, -43.2093728°");
    expect(Coordinates.DMtoDD(" 50  ° 45.9543167 ′   N ,  16 °   16.95255  ′ E  ")).toBe("50.7659053°, 16.2825425°");
    expect(Coordinates.DMtoDD("  22 °  54.6608167  ′ S  , 43  ° 12.5623667 ′ W ")).toBe("-22.9110136°, -43.2093728°");
    expect(Coordinates.DMStoDM(" 50  ° 45  ′ 57.259  ″ N  , 16°  16 ′  57.153 ″  E ")).toBe("50° 45.9543167′ N, 16° 16.95255′ E");
    expect(Coordinates.DMStoDM("  22 °  54 ′  39.649 ″  S ,  43° 12  ′ 33.742  ″ W  ")).toBe("22° 54.6608167′ S, 43° 12.5623667′ W");
});
