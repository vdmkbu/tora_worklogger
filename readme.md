клонируем репозиторий  
```shell script
git clone git@github.com:vdmkbu/tora_worklogger.git .
```

поднимаем docker  
```shell script
make docker-build
```

копируем настройки  
```shell script
cp .env.example .env
```

инициализируем приложение (устанавливаем пакеты, запускаем миграции и добавляем тестовые данные)
```shell script
make init
```

открываем 
```
http://localhost:8082
```

логинимся
```
admin@admin.loc:admin
```  

