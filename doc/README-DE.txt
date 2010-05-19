* DOCUMENTATION

** INSTALLATION
Extrahieren Sie den Inhalt dieses Archivs in Ihr Magento Verzeichnis.
Ggf. ist das Leeren/Auffrischen des Magento-Caches notwendig. Das 
Verzeichniss media/pdfprinter muss vom Webserver beschreibbar sein!

** USAGE
Dieses Modul wandelt beliebige CMS Seiten on-the-fly in PDF Dateien um.
Die PDF Dateien sind über folgende URL erreichbar:
[magento-root]/pdfprinter/print/index/identifier/[cms-identifier]
Wobei der [cms-identifier] dem URL-Key der CMS Seiten entspricht, also z.B. 
http://127.0.0.1/pdfprinter/print/index/identifier/agb
Dabei werden Formatierungen und Einstellungen gemäß HTML und CSS aus einem
Template berücksichtigt.
Aus Performancegründen werden die generierten PDF Dateien im Media 
Verzeichnis gecached. Die Dateinamen enthalten das lezte Änderungsdatum der 
CMS Seite.

** FUNCTIONALITY
*** A: Generiert aus CMS Seiten on-the-fly PDF Dateien. Dabei sollten
        Block Aufrufe geparsed werden. Man kann dies z.B. in Kombination
        mit dem Imprint Modul testen:
        {{block type="symmetrics_impressum/impressum" value="shopname"}}.
*** B: Berücksichtigt dabei Einstellungen (CSS) in body.phtml Template
*** C: Cached generierte PDF Dateien, streamt sie beim nächsten Aufruf.
        Beim Ändern einer CMS Seite wird ein Änderungsdatum gespeichert.
        Dieses Änderungsdatum wird in einen UNIX Timestamp umgewandelt
        und im Dateinamen eingefügt.
*** D: Es werden Mutli-Store Umgebungen beachtet.
        Je nach aktivem Shop werden die entsprechenden CMS Seiten geladen.

** TECHNICAL
Es gibt einen eigenen Controller, der mithilfe eines Models und eines
Helpers die PDF Dateien generiert. Hierfür wird die DomPDF Bibliothek
verwendet.
Der Text wird vorher in das pdfprinter/body.phtml Template eingebettet,
um via CSS z.B. einen Seitenrand zu ermöglichen.
Via Migrationsskript wird ein Order pdfprinter im Media-Verzeichnis angelegt.
Dort werden die generierten PDF Dateien mit passendem Timestamp 
(Änderungsdatum) "gecached".
Fontcache Verzeichniss für DOM Pdf wird per Migrationsdatei als 
var/lib/Symmetrics/dompdf/fonts angelegt und muss auch vom Webserver 
beschreibbar sein.

** PROBLEMS
Der Inhalt des media/pdfprinter/ Verzeichnisses muss manuell gelöscht werden, 
wenn body.phtml angepasst wird.
Außerdem sammeln sich in diesem Verzeichnis immer mehr PDF Dateien an, die 
nie automatisch gelöscht werden.

* TESTCASES

** BASIC
*** A: Rufen Sie eine entsprechende URL auf und prüfen Sie, ob die PDF Datei 
        wie erwartet aussieht. Inbesondere ob Umlaute richtig dargestellt 
        werden.
*** B: Ändern Sie das body.phtml Template und prüfen Sie, ob die PDF Dateien 
        sich entsprechend verändern (* UNBEDINGT den Abschnitt PROBLEMS 
        beachten *)
*** C: Prüfen Sie den Inhalt des media/pdfprinter/ Verzeichnisses und rufen 
        Sie die PDF Dateien auf. Die Inhalte der Dateien müssen immer aktuell 
        sein und den letzten Änderungen der CMS-Seiten entsprechen.
*** D: Legen Sie mehrere Shops mit jeweils eigenen CMS Seiten und den gleichen
        identifieren an. Rufen Sie dann im Frontend die gleiche URL in
        verschiedenen Stores auf.
        Es sollte die dem Store zugeordnete Seite zurückgegeben werden.
        Bei einer im Store nicht existierenden Seite sollten Sie auf die
        no-route Seite weitergeleitet werden.