# Comment Statistics

Evaluates if the overall mood of the comments provided to the API are positive or negative in Spanish.

You must configure the `OPENAI_API_KEY` ENV var inside the docker-compose.yml

Request example:

POST {docker-url}:8080/comment
```json
{
  "comments": [
    "No te lo tomes a mal, pero no te veo dando el perfil para infiltrarte en una banda criminal...",
    "Pelamingas",
    "Eres un crack!",
    "Eres un Mamabicho"
  ]
}
```

Json Response example: 
```json
{
	"statusCode": 200,
	"data": {
		"statistics": 50
	}
}
```

To run the application in development, you can run these commands 

```bash
cd [my-app-name]
composer start
```

Or you can use `docker-compose` to run the app with `docker`, so you can run these commands:
```bash
cd [my-app-name]
docker-compose up -d
```
After that, open `http://localhost:8080` in your browser.

Run this command in the application directory to run the test suite

```bash
composer test
```

That's it! Now go build something cool.
