# Template
#### To setup the template read *Setup guide* (Its really easy)
<br>

This is a php backend website template that redirects all requests to `index.php` allowing for custom url's and 404 pages.

A few perks are:

- Easy way to create new pages and load custom css and js files on them.
- Has SEO build into it
- A clean way of dealing with forms and redirects
- Always include header and footer on a every page



### Must-reads:
#### I highly recommend you read these BEFORE you start working with the template
- [Setup guide > Required values (Important!)](https://github.com/Sander-Brilman/php-website-template#setup-guide--required-values-important)
- [How to use > links on the webpage (Important!)](https://github.com/Sander-Brilman/php-website-template#setup-guide--required-values-important)
- [How to use > Security features. (Useful!)](https://github.com/Sander-Brilman/php-website-template#how-to-use--security-features-useful)
- [Default files & settings (Important!)](https://github.com/Sander-Brilman/php-website-template#setup-guide--required-values-important)
<br>
<br>
<br>

**note:** This template is constantly changing & improving. Beware of changes in the code when downloading it again.

I try to keep the documentation updated with the new changes.


# Setup guide:

To make the template work you need to fill the variables in the `config.php` file. 


## **Setup guide > Required values (Important!)**

Inside the `config.php` file there is a variable called `$site_domain` set this value to The domain of the website. (like *example.com*)

**If the website is inside a folder like `example.com/my-website/` follow this:**

Set the `$site_folder` variable inside `config.php` to the folder with a `/` at the start & end. (like this `/my-website/`)

**Why?** This is to make sure the `$url_array` variable is set correctly. Without it `$url_array[0]` would always be */my-website/*.



## **Setup guide > Optional values**

These variables are optional but are recommended you declare them as it improves SEO.
All these variables can be found inside `config.php`.


- **$debug_ips:** All ip addresses in this array can view dumps and run ip checks in the code.

- **$display_name:** The name of the company or organization
- **$site_domain:** Read the **!Important** paragraph above on how to set this.

- **$theme_color:** A css color notation of the website theme color

- **$default_search_title:** The default title that will show up in search results if there is no title set for that page.
- **$default_website_description:** The default website description that will show up in search results if there is no description set for that page.

- **$locate** set this value to a value of `language_TERRITORY` format. (*nl_NL* or *en_US* for example, [see the complete list](https://www.science.co.il/language/Locale-codes.php))


## **Setup guide > DataBase variables**

If you want to use a database you can fill in these variables at the end of the file.
```php
    $host       = '';
    $db_name    = '';
    $user       = '';
    $password   = '';

    $db = new PDO('mysql:host='.$host.';dbname='.$db_name, $user, $password);
```


## **Setup guide > Other optional settings**

A list of optional settings you can change outside the `config.php` file.

- **favicon.ico:** Replace this with your own website logo
- **robots.txt:** make sure that you configure your robots.txt when the website is finished. (Set to allow all by default)




# **How to use**

This template is pretty easy to use once you know the trick ;)


## How to use > The `$url_array` variable.

Set the current url split into a array on the `/`. Everything after the domain name will be included in this array

For example. If the url is `https://example.com/account/login` the $url_array will be:
```php
array(2) {
  [0] =>  "account"
  [1] =>  "login"
}  
```

**note:** Url parameters and `#` will automatically be filtered from the array.




## How to use > links on the webpage (Important!)

**If your website is inside a folder like `example.com/my-website/` read this.**

To set links to a different webpage you can use the `url` function.<br>
The `url` function sets a absolute path to the page you want.

All you have to do is give the page/path as a parameter.<br>
So taking the example above, if you write `url('account/login')` it will return `https://example.com/my-website/account/login`

**Why use this?** Using relative paths in links can give wrong url's. See the table below.<br>

**note:** The current url in this example is `https://example.com/my-website/shop/item-x` and you want to set a link to `https://example.com/my-website/account/login`

<br>
<br>

|Html notation|Result|correct|
| --- | --- | --- |
| `<a href="account/login">Link</a>` | `https://example.com/my-website/shop/account/login` | **no** |
| `<a href="/account/login">Link</a>` | `https://example.com/account/login` | **no**
| `<a href="<?= url('account/login') ?>">Link</a>` | `https://example.com/my-website/account/login` | **yes!**



## How to use > Set pages in page_builder

To make url's load certain pages you can use `page_builder.php` inside the `assets/php/` folder.

You can create pages inside the `get_page_info` function. Inside the switch case you can define pages based upon url's.<br>
The switch case will use the first item after the `/` of the url. 
So with the url *https://example.com/my-page* the switch case will use `my-page`.

To create a page you simply add a case. (Make sure you don't forget the `break;`)
```php
case 'my-page':
    break;
```

To load a php page on that url you simply add the name of the php file to the `$php` variable.<br>
Using the `.php` file extension is optional
```php
case 'my-page':
    $php[] = 'file_name';
    break;
```

It will automatically include the `file_name.php` file from the `/pages/` folder.
If you want to load a block you can add `/blocks/` to the beginning of the file name. (like this `/blocks/file_name`)

Inside the `/pages/file_name.php` you can put your html and php code. <br>
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

You can include as many files as you want.<br>
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
If you want to load a CSS or JavaScript file on every page you can include them manually inside the `<head>` element inside `index.php`



## How to use > Title and Metatags in pages

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
To turn this off set the second parameter to `false`.<br><br>
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
        'assets/img/my-logo.jpg',
        'Image alt',
    );
    break;
```
**Note:** Enter the image part from the root. This will automatically be converted to a full url.

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

And that is how easy it can be :)

## How to use > Canonical urls

You can also define canonical urls inside `page_builder.php`. By default its set to the same page **without** url parameters.<br>

So `example.com/my-page?section=2` will by default have a canonical url to `example.com/my-page`.

To manually set a canonical url use the `$canonical_url` variable and the `generate_canonical_url` function (just like the meta tags & title)

```php
case 'my-page':
    $php[] = 'file_name';
    $css[] = 'basic_style';
    $js[] = 'my_script';

    $title = generate_title('Hello World!');
    $canonical_url = generate_canonical_url('my-original-page');
    break;
```

**Note:** `generate_canonical_url` by default uses the `url` function. To turn that off set the second parameter to `false`. Like this:
```php
$canonical_url = generate_canonical_url('https://examle.com/my-original-page', false);
```



## How to use > Set redirects

To set redirects you can use the `/assets/php/redirects.php` file.
Here you can set conditions for your redirects.
This file is run after the `$url_array` variable is defined, So you can use the url values inside your conditions.

```php
if ($url_array[0] == 'search' && !isset($_GET['order'])) {
    redirect('redirect_url_from_root');
}
```

Use the redirect function to redirect to the new url.
This function uses the php `header` function and executes a `exit;` after it.


## How to use > Form processing

Since <ins>all</ins> the requests run through `/assets/php/process_form.php` you can put all your form processing inside this file.<br>

To clear the post after you are done processing use the `redirect` function.<br>

If you want the user to remain on the same page set the last parameter of the `redirect` function to `true`. This will redirect the user to the same page clearing the post request.

```php
redirect('', true, false);
```

**Note:** I recommend using the `create_form_id` & `check_form_id` functions to identify your forms and prevent Cross Site Request Forgery. (Read below on how to use)


## How to use > Security features. (Useful!)
This template currently has 2 easy-to-use security features implemented.
All these features are optional to use.

### Security features > `safe_echo`.
The `safe_echo` function that works like `echo` but runs everything through the `htmlspecialchars` php function making it safe (and easy) to safely print user input.

### Security features > Cross Site Request Forgery.
To deal with Cross Site Request Forgery there are 2 functions defined in `assets/php/functions.php`, `create_form_id` & `check_form_id`

To secure your form processing pick a name for your form ('delete-form' for example)<br>

When creating the submit button set both `name` and the `value` attribute on your submit button.

- Set the `name` attribute to the picked name ('delete-form' in this case)
- Set the `value` attribute to the return value of the `create_form_id` function with the picked name as parameter

Like this:
```html
<form method="post">
    <button name="delete-form" value="<?= create_form_id('delete-form') ?>"></button>
</form>
```

When processing the form all you have to do is use `check_form_id` with the picked name as parameter inside as a condition.

Like this:
```php
if (check_form_id('delete-form')) {
    // form processing goes here
}
```


# **Default files & settings (Important!)**
Files & settings that are defined by default. Keeping/Removing them is optional and will not break the template

- Jquery and bootstraps are included with CDN. Inside `index.php` `<head>` element.
- A Font awesome icon stylesheet is included and can be found in `assets/css/icons.css`. The link element is inside the `index.php` file inside `<head>` element

- The file `assets/php/debug_functions.php` contains useful debugging functions:
    - **dump:** A custom `var_dump` with ip check.
    - **check_debug_ip:** Checks if current user is listed as a debug ip.
    - **start_timer:** Returns a value that can be used for timing the processing time
    - **end_timer:** Takes the `start_timer` value and returns ago it was (in milliseconds)

- The `pages/blocks/header.php` and `pages/blocks/footer` are included inside `index.php`
- All url's that do not have pages assigned to them in `assets/php/page_builder.php` will load the `pages/404.php` file.