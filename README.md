# covidcheckin
covidcheckin ist eine Webseite welche es Mitarbeiter:innen und Student:innen der Hochschule Heilbronn erleichtern soll. Hierfür können sich Nutzer:innen, welche eine Hochschul E-Mail Adresse haben, einen Account erstellen.  
Anschließend kann man über den CheckIn Slider den Status an die Coronastelle der Hochschule übermitteln. Es werden ausßerdem nützliche Infos auf der CheckIn Seite angezeigt, wie die AHA Regeln der Bundesregierung.

![CeckIn Site](https://github.com/crexodon/covidcheckin/blob/main/pictures/checkin.png)

## Installation
Eine ausführliche Installationsanleitung ist hier als [PDF](https://github.com/crexodon/covidcheckin/blob/main/covidcheckin_installation.pdf) verfügbar

## Laborprojekt
Dieses Projekt gehört zum Labor des Studiengang Software Engineering im 4. Semester. Darin wurden neben des Projektes auch Teamarbeit, SCRUM und das Arbeiten über Homeoffice gelernt und angewendet.  
Einige Stellen sind hardgecoded und müssen bei Installation geändert werden. Dies wird aber auch in der Installationsanleitung erklärt:
 - **./code/mysql.php** Diese php Datei beinhaltet die Zugangsdaten zur Datenbank
 - **./docker-compose.yml** Diese compose Datei beinhaltet die Anweisungen für das Jenkins um die Frontend Server zu erstellen
