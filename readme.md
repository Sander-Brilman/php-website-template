# Template

A basic php backend website template.

- Redirects all requests to **index.php** allowing for custom url's and 404 pages.
- Has SEO functions build into it
- Always include header and footer on a page
- Easy way to make new pages and load custom stylesheets.

**note:** This template is constantly changing & improving. Beware of changes in the code when downloading it again.


# Setup guide:

To make the template work you need to fill the variables in the **config.php** file. 


## **!Important**

Inside the **config.php** file there is a variable called `$site_domain` set this value to The domain of the website. (like this *example.com*)
dont forget to add extension like *.com*. The *www* is automatically added.


#### If the website is inside a folder like *example.com/my-website/* follow this guide:

- Add the website path to the `$site_domain` variable inside **config.php**. (like this *example.com/my-website/*)

- Inside **index.php** there is a string replace with
`$url_array = str_replace('/your_project_path/', '', $url_array);`
Replace the */your_project_path/* with the path to your website.
(taking the example above it would be `$url_array = str_replace('/my-website/', '', $url_array);`).

**why?** This is to make sure the `$url_array` variable is set correctly. Without it `$url_array[0]` would always be */my-website/*.



## **Optional variables**

These variables are optional but are reccomended you declare them.
All these variables can be found inside **config.php**.


- **$debug_ips:** All ip adresses in this array can view dumps and run ip checks in the code.

- **$display_name:** The name of the company or organisation
- **$site_domain:** Read the **!Important** paragraph above on how to set this.

- **$theme_color:** A css color notation of the website theme color
- **$site_url:** Automatically set. No need to change this

- **$default_search_title:** The default title that will show up in search results if there is no title set for that page.
- **$default_website_description:** The default website description that will show up in search results if there is no description set for that page.



## **DataBase variables**

If you want to use a database you can fill in these variables at the end of the file.
```php
    $host       = '';
    $db_name    = '';
    $user       = '';
    $password   = '';

    $db = new PDO('mysql:host='.$host.';dbname='.$db_name, $user, $password);
```


## **Optional settings**

A list of optional settings you can change outside the **config.php** file.

- **assets/php/page_builder.php:** set the `og:locale` meta tag to the correct country value. (*nl_NL* for example)
[See the complete list](https://www.science.co.il/language/Locale-codes.php)
- **index.php:** Set the lang tag in the `<html>` element
- **favicon.ico:** Replace this with your own website logo
- **robots.txt:** make sure that you configure your robots.txt when the website is finished.




# **How to use**

This template is pretty easy to use once you know the trick ;)



## Set pages in **page_builder.php**

To make url's load certain pages you can use **page_builder.php** inside the **assets/php/** folder.

You can create pages inside the `get_page_info` function. Inside the switch case you can define pages based upon url's.
The switch case will use the first item after the `/` of the url. 
So with the url *https://example.com/my-page* the switch case will use *my-page*.

To create a page you simply add a case. (Make sure you dont forget the `break;`)
```php
case 'my-page':
    break;
```

To load a php page on that url you simply add the name of the php file to the `$php` variable.
you dont have to use the `.php` file extention but it wont break if you include it.
```php
case 'my-page':
    $php[] = 'file_name';
    break;
```

It will automatically include the **file_name.php** file from the `/pages/` folder.
If you want to load a block you can add `/blocks/` to the beginning of the file name. (like this `/blocks/file_name`)

Inside the **/pages/file_name.php** you can put your html and php code. 
**note:** The php file is loaded directly inside the `<body>` element.

To load CSS of JavaScript files you can use the `$css` or `$js` variables and use them the same way. 
The CSS and JavaScript files will be fetched from the `/assets/` folder. (`/assets/css/` for css and `/assets/js/` for JavaScript)
```php
case 'my-page':
    $php[] = 'file_name';
    $css[] = 'my_style';
    $js[] = 'my_script';
    break;
```

You can include as many files as you want.
**note:** Files will be loaded in order in witch they were added.
```php
case 'my-page':
    $php[] = 'file_name';
    
    $css[] = 'basic_style';
    $css[] = 'my_style';
    $css[] = 'header_style';

    $js[] = 'my_script';
    $js[] = 'mobile_menu';
    break;
```
If you want to load a CSS or JavaScript file on every page you can include them manualy inside the `<head>` element inside **index.php**



## Title and Metatags in **page_builder.php**

To set a title for the page you can use the `$title` variable.
You can set it manually like 

```php
case 'my-page':
    $php[] = 'file_name';
    $css[] = 'basic_style';
    $js[] = 'my_script';
    
    $title = '<title>Hello World</title>';
    break;
```

Or you can use the `generate_title` function.

```php
case 'my-page':
    $php[] = 'file_name';
    $css[] = 'basic_style';
    $js[] = 'my_script';

    $title = generate_title('Hello World!');
    break;
```
**note:** When using the `generate_title` function a vertical line (`|`) and the defined display title will be added to the title by default.
To turn this off set the second parameter to `false`.
`$title = generate_title('Hello World!', false);`


To define the meta tags for that page you can use the `generate_meta_tags` function.
```php
case 'my-page':
    $php[] = 'file_name';
    $css[] = 'basic_style';
    $js[] = 'my_script';

    $title = generate_title('Hello World!');
    $meta_tags = generate_meta_tags(
        'SEO title',
        'description',
        url('image_path.jpg'),
        'Image alt',
    );
    break;
```
**note:** use the `url` funtion for the image path to get a absolute path to your image.

If you dont want this page to be indexed simply set `$no_index` to `true`;
```php
case 'my-page':
    $php[] = 'file_name';
    $css[] = 'basic_style';
    $js[] = 'my_script';

    $title = generate_title('Hello World!');
    $no_index = true;
    break;
```

And that is all there is to it :)


## Redirects

To set redirects you can use the **/assets/php/redirects.php** file.
Here you can set condidions for your redirects.
This file is run after the `$url_array` variable is defined, So you can check for the correct url.

```php
if ($url_array[0] == 'search' && !isset($_GET['order'])) {
    redirect('redirect_url_from_root');
}
```

Use the redirect function to redirect to the new url.
This function uses the php `header` function and executes a `exit;` after it.


## Form processing

Since all the requests run through the **index.php** you can put all your form processing inside **/assets/php/process_form.php**
Setting a `action` attribute inside your form is only useful for sending the user to a different page.



# **Good to know**

- Jquery and bootstrap are automatically included with CDN inside **index.php** you can remove them if you do not want them
- I made a file (**assets/php/debug_functions.php**) with useful debugging functions. Including a useful functions like:
    - **dump:** A custom `var_dump` with ip check.
    - **check_debug_ip:** Checks if current user is listed as a debug ip.
    - **start_timer:** Returns a value that can be used for timing the processing time
    - **end_timer:** Takes the `start_timer` value and calculates the difference between them
- The header and footer are included by default inside **index.php**
- I already setup the basics for the 404 page. All you have to do is put your own html inside the **/pages/404.php** file.