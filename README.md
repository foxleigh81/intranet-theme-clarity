[![Build Status](https://travis-ci.org/ministryofjustice/mojintranet-theme.svg?branch=rebuildmaster)](https://travis-ci.org/ministryofjustice/mojintranet-theme)

# moji-theme-clarity

A WP theme for the Ministry of Justice Intranet

## Installation

### Prerequesites

**Completed Docker install** his theme is designed to work with a preconfigured docker instance, please speak to someone on the intranet team if you need guidance on how to set that up. These instructions are for installing this theme only.
**Wordpress configured to use the theme** This theme needs to be set to 'active' in the wordpress admin in order for you to be able to see it.

- Steps
  - Once the theme has been cloned, CD into the root of the theme.
  - Copy .envexample and rename it to .env, edit the file as per the comments.
  - type `npm install`.
  - `npm start` and you're good to go. This will set up a development environment for you and will automatically sync files to the docker instance.

## Coding guidelines

See [Coding Standards](clarity_toolkit_coding_standards.md).

### Stylus

The CSS is created using the stylus preprocessor and uses standard SASS syntax (the official docs show python syntax but it's not used here to reduce the learning curve for those used to SASS), there are a few minor differences between SASS and Stylus, they are available to read in the [official stylus documentation](http://stylus-lang.com/).

### Jeet

Jeet is used for the grid, it is a classless semantic grid and avoids the horrible bootstrap-like practice of putting classes like `.col-lg-12 .col-md-12 .col-sm-12` all over the page. Instead it appears in the css as a fractional width.

e.g.

```stylus
.l-primary-column {
  column(1/2)
}
```

This specifies that the primary column should span 1/2 the page. [The official documentation is available to read here.](http://jeet.gs)

### Rupture

Rupture is a great way to write media queries, it uses a simplified syntax to make responsive layouts fast and easy to code.

e.g.

```stylus
.l-primary-column {
  column(1)
  +above(m) {
    column(1/2)
  }
}
```

This alters the primary column to say that by default, it spans the full width of the page until it reaches the 'm' breakpoint (specified in the '_variables' file) and then after that it changes to a half, column.

[The official documentation is available to read here.](http://jescalan.github.io/rupture/)

### JS

The JavaScript is written using ES6 but it compiles to standard ES5 using the Babel Transpiler. This will happen automatically provided that the 'gulp' task is running.

## File locations

All source files (other than templates) exist in the /src directory. There will be very few reasons you will need to edit anything outside of this directory.

### Templates

Page templates themselves are php files located in the root of the project are are usually prefixed with 'page_'.

### Globals

The /src/globals folder is where you will find all global assets, this includes global styles, images, fonts, javascript and the views for the global_header and global_footer.

### Components

The /src/components folder is where you will find most of the code for the site. Each component should have at least one of the following files:

view.php - The component-specific view (PHP) for the component
style.styl - The component-specific CSS file for the compoennt
script.js - The component-specific javascript for the component

Each component, even if it is just a container for another component should also contain a component.json file formatting like so:

```json
    {
      "name" : "Article Item",
      "version" : "1.0.0",
      "creator" : {
        "name" : "Alex Foxleigh",
        "github_username" : "foxleigh81"
      },
      "description" : "A single article item",
      "standard_or_universal" : "universal",
      "parents" : "",
      "children" : "No Child components",
      "notes" : {
        "backend" : "",
        "frontend" : ""
      },
      "changelog" : [
        {
          "date" : "07/02/17",
          "author" : "Alex Foxleigh",
          "description" : "Quick fix of coding error ('missing quotation mark)"
        }
      ]
    }
```

There are two types of components, a standard component and a universal component. A universal component has the ability to be placed anywhere on the site and it will reconfigure itself to fit the parent container. A standard component should still be reusable but these are components which are designed for a limited number of specific places. Standard components should have their available parent components or layouts specified in the components.json file

Note: Do not label a component as universal unless you have thoroughly tested it.

### To make a new component

Although you can create a new component manually. The preferred (and easier) way is to use the 'ctgen' package. To use it first make sure it is installed globally `npm install -g ctgen` and then simply type `ctgen` when in the root of the project folder. It will ask you a few questions and then automatically generate your component for you. It will even update the component register.

Once the component is generated, you will find it in /src/components/c-[your module name here], you will then be able to add your own files and content.
