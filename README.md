
# rollun-service-formulas

`rollun-service-formulas` - REST Микросервис для вычисления и валидации формул.
Формула для вычисление ожидается в поле expression.
Результат возвращается в payload
##Примеры
**простая формула**

Запрос
```bash
curl 'http://rollun.local/api/webhook/formula' -X POST -H 'content-type: application/json' --data-binary '{"expression": "1 + 2"}'
```
Ответ 
```json5
{
  //.....
	"payload": {
        "result": 3,
        "valid": true,
        "error": null
      },
  //......
}
```

**сложнее**
```bash
curl 'http://rollun.local/api/webhook/formula' -X POST -H 'content-type: application/json' --data-binary '{"expression": "1 + 2 - (1 - 2 * -1.2 + (1)) / 1 ? 3 : 4"}'
```
```json5
{
  //.....
	"payload": {
        "result": 3,
        "valid": true,
        "error": null
      },
  //......
}
```
**невалидное выражение**
```bash
curl 'http://rollun.local/api/webhook/formula' -X POST -H 'content-type: application/json' --data-binary '{"expression": "1 + 2 - (1 - 2 - * 1.2 + (1))  1 ? 3 : 4"}'
```
```json5
{
  //.....
	"payload": {
        "result": null,
        "valid": false,
        "error": "Unexpected token \"operator\" of value \"*\" around position 18 for expression `1 + 2 - (1 - 2 - * 1.2 + (1))  1 ? 3 : 4`."
      },

  //......
}
```