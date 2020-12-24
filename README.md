# Getform Test Assignment

Foobar is a Python library for dealing with word pluralization.

## Information

As indicated in the assignment, I have configured the SQS but I haven't used it. There are two queued jobs:
1. SendEmailJob - (Commented in OrderController on the line 47)
2. WebHookJob - Used in OrderController on the line 50. 

```bash
To use, please send download, and run the server. 
```

## Usage

1. To create a new customer (Post)
2. To create a new order (+ customer id on the url) (Post)
3. To get Orders of a Customer (+ customer id on the url) (Get)
```bash
http://127.0.0.1:8000/api/customers/create
http://127.0.0.1:8000/api/orders/create/1
http://127.0.0.1:8000/api/orders/1/
```

Please check uploaded Postman file for the requests.
 

## Webhook.site
This is the unique url: 
```bash
https://webhook.site/#!/1baceb48-7102-4206-96e4-01609f53da70/1d25b0a9-8d3a-49e1-9769-11e1ac1df082/1
```
