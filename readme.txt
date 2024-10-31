=== Post Rate ===
Contributors: Danijar Hafner
Donate link: http://danijar.org/
Tags: rating, rate, sterne, bewertung, review, post, article, artikel, rich snippets, google, microdata, rate posts, post rating, rate articles
Requires at least: 3.0
Tested up to: 3.4.2
Stable Tag: 2.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Dieses Plugin wird unter jedem einzelnen Artikel fünf Sterne einfügen. Besucher Ihrer Internetseite können die Artikel darüber bewerten.

== Description ==

Dieses Plugin wird unter jedem einzelnen Artikel fünf Sterne einfügen. Besucher Ihrer Internetseite können die Artikel darüber bewerten.

**Einfach aktivieren und fertig!**

* Das Plugin wird unter jedem Artikel fünf Sterne anzeigen.
* Der Besucher kann auf einen Stern klicken um den Artikel zu bewerten.
* Die Gesamtbewertung wird als Rich Snippet ausgegeben, sodass Google die Sterne in der Suche anzeigen kann.
* Die Animationen der Sterne sind komplett in CSS umgesetzt.
* Die Bewertung wird mit AJAX gesendet, deswegen wird Javascript benötigt.

**Das ist alles, was Sie brauchen!**

Sprache: Deutsch

== Installation ==

Sie haben zwei Möglichkeiten zur Installation.

**Automatische Installation (Empfohlen)**

1. Suchen und installieren Sie das Plugin unter `Plugins` auf der Wordpress Oberfläche.
1. Aktivieren Sie das Plugin über die Wordpress Oberfläche.

**Manuelle Installation**

1. Laden Sie das Plugin in Ihren Ordner `/wp-content/plugins/` hoch.
1. Aktivieren Sie das Plugin über die Wordpress Oberfläche.

== Frequently Asked Questions ==

= Kann ein Besucher jeden Artikel nur einmal bewerten? =

Nein derzeit werden die bewertenden Besucher noch nicht erfasst, sodass einer mehrfach abstimmen kann.
Das ist für zukünftige Versionen geplant.

= Wo werden die Bewertungen gespeichert? =

In den benutzerdefinierten Feldern `rating` und `raters` jedes Artikels.
Sie können sich die benutzerdefinierten Felder auf der Bearbeiten-Seite von Wordpress anzeigen lassen.

= Wie kann ich die Bewertungen wieder entfernen? =

Das Plugin kann die Bewertungen bei seiner Deinstallation selber alle entfernen. Der Code dazu ist
standardmäßig auskommentiert, damit die Bewertungen nicht versehentlich alle gelöscht werden können.
Zum Aktivieren im Wordpress-Editor das Plugin auswählen und in der Datei `postrate.php` beiden `//`
vor `register_deactivation_hook(...` entfernen und speichern.
Beim Deaktivieren des Plugins werden jetzt alle Bewertungsdaten unwiderrufbar gelöscht.

== Screenshots ==

1. Die Sterne werden am Ende jedes einzelnen Artikels eingefügt. So sehen Sie aus.

== Changelog ==

= Kommende Funktionen =
* Seite mit Einstellungen
* Einstellung für Farbe der Sterne
* Einstellung für Anzeigeort der Sterne (Artikel Einzelansicht, Artikel Auflistung*, Seiten)
* Einstellungen für Formulierungen
* Mikrodaten für Google angepassen
* Mehrsprachige Version

(\* etwa Startseite, Kategorien, Sucheseiten, und weitere)

= 2.0.0 =
* Erklärungstext bei Artikeln ohne Bewertung
* Testfunktion für Mikrodatan in der Google-Suche
* Bug behoben jQuery wird nun selber eingebunden

= 1.0.0 =
* Erste Veröffentlichung

== Upgrade Notice ==

= 2.0.0 =
Ein wichtiger Bug wurde behoben, wegen welchem einige Benutzer das Plugin nicht benutzen konnten. Außerdem gab es kleine Verbesserungen in der Funktion des Plugins.

= 1.0.0 =
Erste Veröffentlichung