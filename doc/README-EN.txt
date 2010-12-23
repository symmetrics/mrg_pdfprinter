* DOCUMENTATION

** INSTALLATION
Extract content of this archive to your Magento directory.
It might be necessary to clear/refresh the Magento cache. The 
directory media/pdfprinter must be writable by the webserver!

** USAGE
This module converts on-the-fly any CMS files to PDF files.
The PDF fiels are accessible via the following URL:
[magento-root]/pdfprinter/print/index/identifier/[cms-identifier]
where the [cms-identifier] corresponds to the URL key of CMS pages, so 
for example http://127.0.0.1/pdfprinter/print/index/identifier/agb
At the same time, formatting and settings are taken into account according to HTML
and CSS from template.
For the reasons of performance, the generated PDF files are cached in media 
directory. The file names contain the last change date of the CMS page.

** FUNCTIONALITY
*** A: Generates PDF files from CMS pages on the fly. At the same time,
	    block calls should be parsed. This can be checked for 
	    example in combination with the imprint module:
	    block type="imprint/field" value="street".
*** B: Takes settings (CSS) in body.phtml template into consideration.
*** C: Caches generated PDF files, streams them upon the next call. 
	    When changing a CMS page the change date is saved.
	    This change date is converted to UNIX timestamp
	    and added to the file name.
*** D: Multi-store environments are taken into consideration.
        Depending on an active shop, the corresponding pages are loaded.

** TECHNICAL
There is a specifal controller that generates the PDF files with the 
help of a model and a helper. For this the DomPDF library is used.
The text is first embedded to pdfprinter/body.phtml template,
in order to enable for example margin via CSS.
Via migrations script a pdfprinter order is created in media-directory.
There the generated PDF files are "cached" with appropriate timespamp (change date).
Frontcache directory for DOM Pdf is created per migrations file as 
var/lib/Symmetrics/dompdf/fonts and must also be writable by webserver.

** PROBLEMS
The content of the media/pdfprinter/ directory must be deleted manually,
when body.phtml is updated.
Besides always more PDF files are accumulated in this directory,
that are never automatically deleted.

* TESTCASES

** BASIC
*** A: Call a corresponding URL and check if PDF file looks
		as expected. Ispecially if the umlauts are displayed correctly.
*** B: Change the body.phtml template and check if the PDF files
	    change respectively (*BY ALL MEANS pay attention to section PROBLEMS*)
*** C: Check content of the media/pdfprinter/ directory and open the PDF files. 
		The content of the fiels should always be actual and 
	 	correspond to the latest changes of the CMS pages.
*** D: Create several shops with own CMS pages and the same identifieres.
	    Then call the same URL in frontend in different shops.
	    The page assigned to the store should be returned.
	    If page does not exist in the store, you should be redirected
	    to no-route page.