### install
0. `docker-compose up`
0. open `localhost:8000` in browser

to enter REPL:
`docker-compose exec myapp bash`

### usage
```http request
POST http://localhost:8000/push
Content-Type: application/json

{
   "number": 64
}
```

```http request
GET http://localhost:8000/pop
Accept-Language: lv
```
change header value to "lv" to get response in Latvian
