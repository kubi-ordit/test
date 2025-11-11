# Importáló feladat (CLI, Symfony)

Ebben a feladatban egy **már előre bekonfigurált** Symfony CLI projektben kell egy egyszerű, de jól struktúrálható **adatimportáló logikát** megírni.  
A cél nem a Symfony ismeretének tesztelése, hanem az, hogy lássuk, hogyan oldasz meg OOP szemléletben egy feldatot.

## Kiindulási állapot

- A projekt elindítható `docker compose`-zal. Van hozzá egy segéd `./up` bash script, ami WSL-ben vagy Linuxon futtatható.
- A gyökérben található egy `import_data/` mappa.
- Ebben a mappában **6 fájl** van:
    - 3 darab **CSV**
    - 3 darab **JSON**
- A fájlok kétféle logikát követnek (lásd lejjebb).
- Az `./exec sf <command>` bash script-el futtathatóak a symfony cli commandok.
- A `./down` bash script-el leállítható a container.
- A `./run` az összes fájl importot futtatja egymás után 

A projektben már előkészítettünk egy Symfony parancsot, amit így lehet hívni:

```bash
./exec sf app:import --type=per_item ./import_data/with_price_per_item.csv
./exec sf app:import --type=total ./import_data/with_total.json
```

Emellett van egy `./run` nevű segéd script is, ami sorban meghívja az összes fájlra az import parancsot. A command jelenleg csak azt ellenőrzi, hogy:

1) megadtad-e a --type paramétert,
2) létezik-e a megadott fájl.
3) Minden további feldolgozás a te feladatod.

---

## A feldolgozandó fájlok típusa

A feladatban kétféle adatstruktúrával kell tudni dolgozni.

1) “per_item” típus
    - struktúra
      - product name
      - price per item
      - quantity 

2) “total” típus

    - struktúra
      - product name 
      - price total

A parancs meghívásakor a --type kapcsoló jelzi, hogy melyik logika érvényes az adott importnál (pl. --type=per_item vagy --type=total). A megoldásodban kezelned kell mindkét típust.

---

## Formátumok (CSV és JSON)

- Az import_data/ mappában lévő fájlok CSV vagy JSON formátumúak.
- A megoldásnak fel kell ismernie a fájl típusát (pl. kiterjesztés alapján) és ennek megfelelően kell beolvasnia.
- A CSV fájlokban az első sor header, de az oszlopok sorrendje nem fix.
- A JSON fájlok esetén egy sor egy json array, az array kulcsok nevei egyeznek a csv header nevekkel.

---

## Feladat

1) Olvasd be a megadott fájlt (CSV vagy JSON).
2) A beolvasott sorokat a megadott tipus szerint dolgozd fel
3) A fájlban szereplő termékek ismétlődhetnek.
Azonos terméknév esetén az értékeket össze kell adni és a végén ismétlődés nélkül kell megjeleníteni.
4) A végén ki kell írni a konzolba:
   - az összes, ismétlődés nélküli terméket a kiszámolt/összeadott végösszeggel (price total),
   - valamint annak a terméknek a nevét és összegét, amelynek a végösszege a legnagyobb.
5) A megoldásnak könnyen bővíthetőnek kell lennie, hozzá lehessen adni új fájl formátumokat vagy adat struktúra tipusokat és kimeneti formátumokat.   
