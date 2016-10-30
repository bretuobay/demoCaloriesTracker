## Synopsis

This is a demo app for tracking calories

## Installation
```
   git clone https://github.com/bretuobay/demoCaloriesTracker.git
   
```

Create mysql database : demoapp and import the sql file in sql folder and import it.

```
login with user/Email : demo

password : pass
```

## Motivation

Originally written for and interview, the core has been rewritten to use modern PHP namespaces and OOP patterns to make it reusable.

## Contributors

Festus Yeboah

##Known Issues:

Date formatting is a problem 12/12/2016 & 2016-12-12, dates retrived must be formatted for presentation.
Move DB name to config to make it constant
escape post and get params to prevent sql injection
improve security and navigation

## License

MIT
