* DOCUMENTATION

** INSTALLATION
Extrahieren Sie den Inhalt dieses Archivs in Ihr Magento Verzeichnis.
Die Verzeichnisse lib/Symmetrics/dompdf/lib/fonts/ und media/pdfprinter
müssen vom Webserver beschreibbar sein!

** USAGE
Dieses Modul wandelt beliebige CMS Seiten on-the-fly in PDF Dateien um.
Die PDF Dateien sind über folgende URL erreichbar
[magento-root]/pdfprinter/print/index/identifier/[cms-identifier]
Wobei der [cms-identifier] dem URL-Key der CMS Seiten entspricht, also z.B. 
http://127.0.0.1//pdfprinter/print/index/identifier/agb
Dabei werden Formatierungen und Einstellungen gemäß HTML und CSS aus einem
Template berücksichtigt.
Aus Performancegründen werden die generierten PDF Dateien im Media Verzeichnis
gecached.

** FUNCTIONALITY
*** A: Generiert aus CMS Seiten on-the-fly PDF Dateien
*** B: Berücksichtigt dabei Einstellungen (CSS) in body.phtml Template
*** C: Cached generierte PDF Dateien, streamt sie beim nächsten Aufruf.
        Beim Ändern einer CMS Seite wird ein Änderungsdatum gespeichert.
        Dieses Änderungsdatum wird in einen UNIX Timestamp umgewandelt
        und im Dateinamen eingefügt.

** TECHNICAL
Es gibt einen eigenen Controller, der mithilfe eines Models und eines
Helpers die PDF Dateien generiert. Hierfür wird die DomPDF Bibliothek
verwendet.
Der Text wird vorher in das pdfprinter/body.phtml Template eingebettet,
um via CSS z.B. einen Seitenrand zu ermöglichen.
Via Migrationsskript wird ein Order pdfprinter im Media-Verzeichnis angelegt.
Dort werden die generierten PDF Dateien mit passendem Timestamp (Änderungsdatum)
"gecached".

** PROBLEMS
Der Inhalt des media/pdfprinter/ Verzeichnisses muss manuell gelöscht werden, wenn
body.phtml angepasst wird.
Außerdem sammeln sich in diesem Verzeichnis immer mehr PDF Dateien an, die nie
automatisch gelöscht werden.


* TESTCASES

** BASIC
*** A: Rufen Sie eine entsprechende URL auf und prüfen Sie, ob die PDF Datei wie 
        erwartet aussieht. Inbesondere ob Umlaute richtig dargestellt werden.
*** B: Ändern Sie das body.phtml Template und prüfen Sie, ob die PDF Dateien sich
        entsprechend verändern (* UNBEDINGT den Abschnitt PROBLEMS beachten *)
*** C: Prüfen Sie den Inhalt des media/pdfprinter/ Verzeichnisses und rufen Sie
        die PDF Dateien auf.