# Rigby

## Isn't adding a framework to an unframework... kinda... stupid.

You make an excellent point, imaginary man asking that question in my brain.  I have used Flourish professionally for about a year now, it is without a doubt the finest collection of web centric classes available for PHP.  That being said, I found myself repeating the same patterns for every application, and what was worse I saw in the message boards newcomers that were confused as to how best to use Flourish.  

I decided to write Rigby out of some selfishness and some selflessness, like all good open source.  I was tired of making an improvement in one project and trying to port it to another, or returning to a project 6 months later and realizing that I don't have access to some super cool new abstraction I recently wrote.  I realized what I needed was a holding area for all those good ideas to live that could easily be shared amongst all my projects, and so Rigby was born.

I also thought that if I found things like Environment Specific Configurations, centralized routing, and common project structure useful, so might other people.  

## Features

Rigby tries to remain true to the Flourish philosophy, it provides a bare bones template for a website, but you are more than welcome to use and abuse Rigby in any way you see fit, and it shouldn't be too difficult to change anything.

Rigby adds 3 major components to Flourish:
  1.  Pretty RESTful Routing
  2.  Common Project Structure
  3.  Another set of helpful classes

### Pretty RESTful Routing

Look guys, it's 2011, sending someone to http://example.com/index.php?page=something&client=someone&project=somehow isn't going to fly anymore.  It's a lot nicer to be able to send someone to, http://example.com/something/someone/somehow/  I mean that just looks pretty and cool.  But how can you, a mere web mortal, perform this kind of sorcery.

#### .htaccess and MOD_REWRITE

MOD_REWRITE is crazy cool stuff, but it is also crazy complicated.  Here's the quote from the official page <http://httpd.apache.org/docs/1.3/mod/mod_rewrite.html> by Brian Moore.

 > Despite the tons of examples and docs, mod_rewrite is voodoo. Damned cool voodoo, but still voodoo.

MOD_REWRITE is complicated stuff and getting it right can be tricky, especially as a project grows and new routes are added.  So we are going to stay away from that.

#### Rails / Sinatra style mapping

Rails and Sinatra both employ the idea of a mapping file that allows you a nicer cleaner syntax to perform your centralized routing.  Because of the coolness of Ruby (and PHP 5.3) Sinatra can do awesome stuff like this:

    get '/hi' do
      "Hello World!"
    end
    
I mean that's sweet, it just passed a functional closure to a route, and it's plainly clear what's going on.  It's really, really cool.  The only problem is that PHP just recently got with the program and got closures, anyone running something less than PHP 5.3 (a lot of people still) have to use uglier workarounds.

#### The Rigby Way

So how does Rigby do this.  One of the cool things about PHP has always been a straightforward mapping between directory structure and url structure, Rigby leverages this.  Basically you just need to follow a certain directory structure and Rigby pretty urls will work automatically, but there are cool added bonuses.

##### Rest, HTTP Verbs, and all kinds of cool stuff.

Rigby has a pretty RESTful router, this allows you to be all Web 3.14159 without having to do a bunch of tedious work.  Let's take an example and build off of it.  First the Directory Structure.

    PROJECT_ROOT/
      users/
        posts/
          index.php
          view.php
          comments/
            index.php
            view.php

This is some sort of fictitious multi-user blogging application.  Let's say the following request is made `GET http://example.com/users/matt/posts/`

The Router is going to break the url into parts, (`users`, `matt`, `posts`) it's going to start in the project's root and look for a directory named, `users` and it finds it.  Then it looks in that directory for a file or directory named `matt` but it finds nothing, `matt` must be an argument associated with `users`, `$_GET['users'] = 'matt';`.  Then it looks at `posts` and finds the directory.  Since the request was a `GET` request it looks for a file named `index.php` and passes execution to it.

It may seem kind of complicated but the rules are pretty easy to understand, and the router natively supports almost all the features you would need for RESTful management of any entity.  

    GET  /entity/            =>  index.php
    GET  /entity/$id/        =>  view.php
    GET  /entity/$id/new/    =>  new.php
    GET  /entity/$id/edit/   =>  edit.php
    GET  /entity/$id/delete/ =>  delete.php
    
    POST /entity/            =>  post.php
    POST /entity/$id/        =>  process.php
    POST /entity/$id/new/    =>  create.php
    POST /entity/$id/edit/   =>  update.php
    POST /entity/$id/delete/ =>  destroy.php
    
This allows for a clean separation of your `GET` and `POST` behaviors, without any messy `if($_SERVER['REQUEST_METHOD'] == 'POST') { //They posted the form }` logic mucking up the works.  The RESTful router encourages the proper organization of actions and the auto-injection of url variables into the $_GET array allows access with familiar Flourish classes, like fRequest.

The Router allows you to write code and layout your project in a logical way, safe in the knowledge that your urls will be pretty and a RESTful API will be simple to create down the road.

### Common Project Structure

There are some things that are just common to every website, and there's really no need to go reinventing the wheel every single time.  By using a common structure, Rigby can give you cool features like resource resolution and class autoloading.  Let's take a look at the default structure for a Rigby Application:

    PROJECT_ROOT
      .htaccess  (This sets up the MOD_REWRITEs necessary to make the router work)
      index.php  (Holder landing page, so you know Rigby is running properly)
      error/     (Comes with a few defaults, but feel free to add more HTTP Error Codes)
        403.php  (If the router detects service into the protected directory, you end up here)
        404.php  (If the router can't find something, sends you here)
      protected/ (This is where code goes, the router will not serve this directory)
        config/  (Environment Specific Configuration system)
          common.config.php
          environment.config.php
          environments/
            development.config.php
            maintenance.config.php
            production.config.php
            test.config.php
        database/ (You can put SQLite databases in here)
        lib/
          classes/  (This is where your classes go)
          flourish/ (Here you will find Flourishy goodness)
          rigby/
            init.php  (Rigby Bootstrap)
            route.php (Main entry point for Rigby)
            foundation/
              All the Rigby Classes are in here
        scripts/
          Various Command Line Utilities
        sql/
          You can store .sql files in here that relate to the project
      resources/
        css/
        images/
        js/
        sass/
        templates/

This standard structure allows for any kind of web project you can think of.

### Rigby Helper Classes

There are a few things that Flourish doesn't seem to want to help with, Rigby adds some extra classes in to help out.

#### ActiveRecord

Flourish provides a really great fActiveRecord, ActiveRecord is just a standard place to add extensions for your project, by default we add a `created_at` and `updated_at` to every record

#### fAJAX 

This is a helpful utility class that standardizes response from AJAX handlers.

#### fApplication

This is an information registry for Global data relating to the Application without polluting the Global namespace

#### fErrors

fErrors is a registry for errors, it's helpful when validating form input and ActiveRecord models.  The registry will persist on an Error response so you can display detailed error messages to your user

#### fIdentity

A clean interface for handling multiple Authorizable entity types, Users, Admins, etc.

#### fResponse

Response handler that standardizes responding from a POST handler.  Interacts with fErrors and fValues to provide error handling and sticky values.

#### fRigby

Core class for the Framework, our fCore

#### fRouter

The Router class, also a URL builder

#### fTransaction

Database Transaction class, allows you to `fTransaction::begin()`, `fTransaction::commit()`, and `fTransaction::rollback()`

#### fValues

fValues is a registry for values, it's helpful when fResponse responds with an error message.  Normally there is only one or two things wrong on a form, the rest of the inputs can be repopulated, the fValues class automates this and provides a simple API for accessing the data.

