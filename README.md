# mass_check
Mass verification of accounts for validity
---
Массовая проверка валидности аккаунтов

Установка: просто загружаем скрипт в папку на хостинг/сервер/локалку и переходим по адресу http://адрес_сайта.ру/check.php \n

P.S. Чтобы сохранить валидные аккаунты в отдельный файл раскоментируйте в файле acc_check.php строку:

16: //$gen  = rand(); // Генерируем случайное число

17: //$name = 'live_'.$gen.'.txt'; // Генерируем случайное имя для файла

24:  cekAkunFb($potong[0], $potong[1], $name); // чтобы писать в файл добавить $name

25:  //echo 'Скачать файл с живыми акками: <a href=\"'.$name.'\" >Скачать<\/a><br>'; 

31: function cekAkunFb($email, $passwd, $name) { // чтобы писать в файл добавить $name

56:  //file_put_contents($name, $empas.PHP_EOL);
