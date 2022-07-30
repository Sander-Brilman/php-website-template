# Setup guide:

To make the template work you would need to fill the variables in the **config.php** file. 

To Load pages based upon the url use the **assets/php/page_builder.php** file.

To set links within your website use the `url` function.



# **Dont Forget**

A list of things to cofigure

1. **assets/php/page_builder.php:** set the `og:locale` meta tag to the correct country value. (*nl_NL* for example) [See the complete list](https://www.science.co.il/language/Locale-codes.php)
2. **index.php:** Set the lang tag in the `<html>` element
3. **favicon.ico:** Replace this with your own website logo
4. **robots.txt:** make sure that you configure your robots.txt when the website is finished.
5. **index.php:** If you are working on localhost set the replace string inside the if statement to the path to your project. 
So if you have a url with *localhost/websites/example/* set the string to */websites/example/* (Dont forget the */* at the end!)

this is to make sure the url is build correctly. Without it (taking the example above) $url_array[0] would always be *websites*.




## **Variables**

A guide on how to fill the variables listed in config.php


- **$debug_ips:** ip adresses in this array can view dumps and run ip checks in the code.
- **$display_name:** The name of the company or organisation
- **$site_domain:** The domain of the website, like *example.com*. dont forget to add extension like *.com*, the *www* is automatically added.
If the website is inside a folder like *example.com/my-website/* add that path to the domain.
- **$site_url:** Automatically set. (so dont change it)
- **$theme_color:** A css color notation of the website theme color
- **$default_search_title:** The default title that will show up in search results if there is no title set for that page.
- **$default_website_description:** The default website description that will show up in search results if there is no description set for that page.


## **DataBase variables**

If you do not use a database (yet) you can comment out these lines in config.php
```
    $host       = '';
    $db_name    = '';
    $user       = '';
    $password   = '';

    $db = new PDO('mysql:host='.$host.';dbname='.$db_name, $user, $password);
```

