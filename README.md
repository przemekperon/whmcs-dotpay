DotPay.pl Payment Gateway dla WHMCS v1.0
Autor: Przemek Peron <huan@huan.pl>
Website: http://www.huan.pl

----------------------------------------

Skrypt jest rozpowszechniany na licencji Creative Commons Attribution 3.0
Brzmienie licencji: http://creativecommons.org/licenses/by/3.0/pl/


INSTRUKCJA INSTALACJI:
----------------------

1. Wgranie plikow na serwer

Kopiujemy pliki do instalacji WHMCS do katalogu /modules/gateways:

dotpay.php --> /modules/gateways/dotpay.php
callback/dotpay.php --> /modules/gateways/callback/dotpay.php

2. Aktywacja modulu w WHMCS

Nalezy zalogowac sie do administracji WHMCS i w dziale "Setup / Payment Gateways",
wybrac gateway "DotPay.pl" i aktywowac go.

Nastepnie w konfiguracji modulu DotPay.pl wystarczy juz tylko wprowadzic swoj login
z serwisu DotPay w polu "Login ID"

PAMIETAJ: nalezy zalogowac sie do serwisu dotpay.pl i w Ustawieniach w opcji
"Parametry URLC" aktywowac opcje "Zezwol na przyjecie parametru URLC z zewnatrz"

3. Gotowe


DODATKOWE INFORMACJE
--------------------


Skrypt zostal napisany z mysla o polskich uzytkownikach, wiec nie umieszczalem
w nim obslugi innych walut. Testowany byl z WHMCS v4.0 - v4.3, a czy bedzie dzialac
na wersji, ktora wlasnie posiadasz? Bardzo mozliwe, ale nie daje zadnych gwarancji ;)

