

Хочу на сайте:
	Сортировку, фильтрацию, по:
		"ProductionYear"
		"Country"
		"Genre"
		"Actors"
		"Producer"
		"Scenario"
		"Director"
		"RatingIMDb"
	Поиск
	








Плагин предназначен для наполнения сайтов контентом.
	получает данные по каждому посту в массив $arr_date_from_json из json файла.
	постера для должны быть заранее загруженны в папку W:\domains\Prostofilm.localhost\wp-content\uploads\posters
	создаёт элементы таксономий. Информацию для этого информацию из полей массива $arr_date_from_json


При этом: 
	типы записей создаються в дочерней теме
	таксономии создаються в дочерней теме


!!!!!!!!!!  Обязательно должен быть поиск и фильтра






    Plugin Name: add_Post_films_3.0
    Description: Добавляет посты с постерами. При добавлении записи необходимо указать: Заголовок (название) записи. Тип записи.(?) Категория к которой относится пост (указываем ярлыки, имена или ID). Метки поста (указываем ярлыки, имена или ID). К каким таксам прикрепить запись (указываем ярлыки, имена или ID).



Заголовок
Поле с общей информацией
	Краткое описание плагина:
		предназначен для
		выполняет это так

Поле с информацией о текущем состоянии сайта:
	Существующие записи на сайте
		и их перечень
	Таксономий столько
		и их перечень
	Термов в каждой таксономии столько
		и их перечень
	Картинок столько

Нужна возможность удалять отдельные 
	записи 
	таксономии
	термины
	картинки
Отдельная кнопка очистить всё:
	нажатие на эту кнопку удаляет:
		все записи всех типов
		все таксономии
		все термины всех таксономий
		все картинки

Поле для выдора начальных данных
	Выбрать файл импорта, по умолчанию берёться предустановленный
	Поле для отображения масива полученного из файла импорта

Поле для результата:





