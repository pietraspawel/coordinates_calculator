# Coordinates calculator

Przelicza współrzędne geograficzne pomiędzy różnymi formatami zapisu. Są to:

- DMS (stopnie, minuty, sekundy)
- DD (stopnie)
- DM (stopnie, minuty)

## Ogólne zasady zapisu

Wartości mogą być zapisane jako *liczby całkowite* a najmniejsza jednostka może być zapisana jako *ułamek dziesiętny*.

Dla wartości zapisanych w postaci *ułamka dziesiętnego* separatorem jest *kropka*.  
Przykład: `1.234`

*Przecinek* oddziela *szerokość geograficzną* od *długości geograficznej*, przy czym jest opcjonalny (można te wartości oddzielić po prostu spacją).  
Najpierw musi być podana *szerokość geograficzna*, a następnie *długość*.  
Muszą być podane obydwie wartości: *szerokość* i *długość*.
*Szerokość geograficzna* może być poprzedzona symbolem *φ*, ale nie jest to konieczne.
*Długość geograficzna* może być poprzedzona symbolem *λ*, ale nie jest to konieczne.
Przykłady:  
```
φ 50 46 17.076 N, λ 16 17 3.552 E
50 46 17.076 N, 16 17 3.552 E
50 46 17.076 N,16 17 3.552 E
50 46 17.076 N 16 17 3.552 E
```

Każda wartość składa się ze *stopni*, *minut* i *sekund* oraz *określenie półkuli*, przy czym *stopnie* i *określenie półkuli* jest obowiązkowe, *minuty* i *sekundy* są opcjonalne.  
Wartości muszą być podane w tej kolejności: *stopnie* *minuty* *sekundy* *określenie półkuli*.
Separatorem wartości jest *spacja*.
Przykłady:  
```
50 46 17.076 N
16 17 3.552 E
```

*Stopnie* mogą być podane jako liczba całkowita lub ułamek dziesiętny (tylko dla zapisu *DD*).  
Można dodać znak stopni (°), lecz jest on opcjonalny.
Przykłady:  
```
50
50°
```

*Minuty* mogą być podane jako liczba całkowita lub ułamek dziesiętny (tylko dla zapisu *DM*).
Można dodać znak minut, lecz jest on opcjonalny.
Oficjalnym znakiem minuty jest prim (′), ale równie dobrze może być apostrof ('). Znak podany po wartości jest nieistotny dla aplikacji.
Przykłady:  
```
46
46′
46'
```

*Sekundy* mogą być podane jako liczba całkowita lub ułamek dziesiętny (tylko dla zapisu *DMS*).
Można dodać znak sekund, lecz jest on opcjonalny.
Oficjalnym znakiem sekundy jest bis (″), ale równie dobrze może być cudzysłów ("). Znak podany po wartości jest nieistotny dla aplikacji.
Przykłady:  
```
3.552″
3.552"
3.552
```

*Określenie półkuli* to jedna z liter *N*, *S* (dla *szerokości geograficznej*) lub *E*, *W* (dla *długości geograficznej*).
Zapis *+* i *-* NIE jest wspierany.

### DMS (stopnie, minuty, sekundy)

Stopnie i minuty jako liczby całkowite.  
Sekundy jako liczby ułamkowe dziesiętne.

Przykłady:  
```
50° 46′ 17.076″ N, 16° 17′ 3.552″ E
50 46 17.076 N 16 17 3.552 E
```

### DM (stopnie, minuty)

Stopnie jako liczby całkowite.  
Minuty jako liczby ułamkowe dziesiętne.

Przykłady:  
```
50° 46.2846′ N, 16° 17.0592′ E
50 46.2846 N 16 17.0592
```

### DD (stopnie)

Stopnie jako liczby ułamkowe dziesiętne.

Przykłady:  
```
50.77141°, 16.28432°
50.77141 16.28432
```