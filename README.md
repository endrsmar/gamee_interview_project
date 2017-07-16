This project was created by Martin Endršt as part of interview process at GAMEE.
Following assumptions were made during development:
- Framework with HTTP method based routing is being used (getByIdAction is only accessible via GET method)
- Framework with dependency injection (DI) is being used
- There is no cache expiration needed
- Used framework handles response outputting automatically based on return value from action
- API is public, no authentication and no throttling is required

config/classmap.neon is just a demonstration of using a configuration file and DI to swap between XML and MySql data source and swapping between different caching methods. This example was made following Nette config file syntax.
