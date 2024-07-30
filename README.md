# App
## Models
### Archive
### History
## Controllers
### ArchiveController
### HistoryController
Работа с представлением главной страницы ```route::/``` осуществляется в методе ```index()```. Взаимодействие происходит с ```Hisory::``` моделью, где хранится до 100 записей для быстрого доступа. 
Данные пуллятся из ```Archive::``` модели
## Events & Listeners
### Update Event & Listener
Данное событие и его слушатель вызываются при приёме данных с *автоматической* МК отправке по ```url:.../sending?..```. Адрес задействует ```HistoryController->setOrUpdateData()``` метод.  
